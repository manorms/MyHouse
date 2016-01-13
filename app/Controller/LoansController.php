<?php
App::uses('AppController', 'Controller');

class LoansController extends AppController {

	public $components = array('GenPassword','GCMPush');
	
	public function add()
	{
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			$this->Loan->create();

			$this->request->data['Loan']['date'] = $this->Loan->dateFormatBeforeSave($this->request->data['Loan']['date']);
			//pr($this->Loan->find('first'));
			//pr($this->request->data);
			//die();
			//$this->Loan->unBindModel(array('belongsTo' => array('Lender')));
			//$this->Loan->unBindModel(array('belongsTo' => array('House')));
			
			if ( $this->Loan->save( $this->request->data) ) 
			{	
				// mandar notificacion via email
				$namesTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Loan']['borrower_id'] ) ));

				$emailsTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => array($this->request->data['Loan']['lender_id'], $this->request->data['Loan']['borrower_id']),'Lender.notifications' => 1 ) ));
				$nameFrom = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Loan']['lender_id'] ) ));
				$vars =array(
					'page' => NAME_SYSTEM,
					'type' => 'Registro de Prestamo',
					'data' => $this->request->data['Loan'],
					'loan' => $this->request->data['Loan'],
					'nameHouse' => 'No Aplica',
					'nameFrom' => implode('',$nameFrom),
					'namesTo' => implode(', ',$namesTo),
					'countTo' => 1,
				);
				$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo,$vars);
				
				$this->GCMPush->send($vars);
				
				// end mandar notificacion via email
				
			    $this->Session->setFlash(  __( 'Prestamo registrado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				//$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El Prestamo no se ha registrado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('action' => 'index'));
		}
		else
		{
			
			$this->set( array (
							'lenders' => $this->Loan->Lender->find('list', array('conditions' => array( 'Lender.active' => 1))),
							'borrowers' => $this->Loan->Lender->find('list', array('conditions' => array( 'Lender.active' => 1))),
							'sessionUser' => $this->Session->read("Auth.User"),
						)
			);
		}
	}

	public function state( )
	{
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {	
			// mandar notificacion via email
			//$namesTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Loan']['borrower_id'] ) ));

			$emailsTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => array($this->request->data['Loan']['lender_id'] ) )));
			$nameFrom = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Loan']['lender_id'] ) ));
			$vars =array(
				'page' => NAME_SYSTEM,
				'nameFrom' => implode('',$nameFrom),
				'arrays_t' => array(
								'myLoans' => $this->Loan->find('all', array ( 'conditions' => array( 'Loan.lender_id' => $this->request->data['Loan']['lender_id'], 'Loan.active' => 1) ) ),
								'yourLoans' => $this->Loan->find('all', array ( 'conditions' => array( 'Loan.borrower_id' => $this->request->data['Loan']['lender_id'], 'Loan.active' => 1) ) ),
			 	)
			);
			$this->GenPassword->sendPassword('loans_report','Solicitud estado de cuenta',$emailsTo,$vars);
			// end mandar notificacion via email
			
		    $this->Session->setFlash(  __( 'Estado de cuenta enviado al correo electrónico registrado.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
			));
			$this->redirect(array('action' => 'state'));		
		}
		else
		{
			
			$this->set( array (
							'lenders' => $this->Loan->Lender->find('list', array('conditions' => array( 'Lender.active' => 1))),
							'sessionUser' => $this->Session->read("Auth.User"),
						)
			);
		}

	}

	public function index( )
	{

		$this->set(
				 array(
					'myLoans' => $this->Loan->find('all', array ( 'conditions' => array( 'Loan.lender_id' => $this->Session->read('Auth.User.id'), 'Loan.active' => 1) ) ),
					'yourLoans' => $this->Loan->find('all', array ( 'conditions' => array( 'Loan.borrower_id' => $this->Session->read('Auth.User.id'),  'Loan.active' => 1) ) ),
				 )
			);
	}
	
	public function delete($id = null) 
	{
		$this->Loan->id = $id;
		if (!$this->Loan->exists()) throw new NotFoundException( __('Prestamo invalido') );
		
		$this->Loan->query("UPDATE `loans` SET  `active` = 0 WHERE `id`=$id;");
		
		
		// mandar notificacion via email
		$this->request->data = $this->Loan->find("first", array('conditions' => array( 'Loan.id' => $id ) ));
		
		$this->request->data['Loan']['lender_id'] = $this->request->data['Lender']['id'];
		$this->request->data['Loan']['borrower_id'] = $this->request->data['Borrower']['id'];

		$namesTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Loan']['borrower_id'] ) ));
		$emailsTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => array($this->request->data['Loan']['lender_id'], $this->request->data['Loan']['borrower_id']),'Lender.notifications' => 1 ) ));
		$nameFrom = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Loan']['lender_id'] ) ));
		$vars =array(
			'page' => NAME_SYSTEM,
			'type' => 'Prestamo Eliminado',
			'data' => $this->request->data['Loan'],
			'loan' => $this->request->data['Loan'],
			'nameHouse' => 'No Aplica',
			'nameFrom' => implode('',$nameFrom),
			'namesTo' => implode(', ',$namesTo),
			'countTo' => 1,
		);
		$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo,$vars);
		$this->GCMPush->send($vars);
		// end mandar notificacion via email
		$this->Session->setFlash( __( 'El Prestamo ha sido eliminado.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
        $this->redirect(array('action' => 'index'));		    
	}
	function view($id = null) 
	{
		$this->Loan->id = $id;
		if (!$this->Loan->exists()) throw new NotFoundException( __('Prestamo invalido') );
		//NOTA: validar en la visa Payment.active = 1
		$this->request->data = $this->Loan->find('first',array( 'conditions' => array('Loan.id' => $id,)));
		$this->request->data['sessionUser'] = $this->Session->read("Auth.User");
	}
}