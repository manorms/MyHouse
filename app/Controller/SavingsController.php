<?php
App::uses('AppController', 'Controller');

class SavingsController extends AppController {

	public $components = array('GenPassword');
	
	public function add()
	{
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			
			$this->Saving->create();

			$this->request->data['Saving']['date'] = $this->Saving->dateFormatBeforeSave($this->request->data['Saving']['date']);
			$this->request->data['Saving']['active'] = 1;
			
			if ( $this->Saving->save( $this->request->data) ) 
			{	


				$emailsTo = $this->Saving->User->find('first', array('fields' => array('User.id','User.full_name','User.email'), 'conditions' => array('User.id' => $this->request->data['Saving']['user_id'],'User.notifications' => 1 ) ));
				
				if(count($emailsTo)){
					$this->request->data['Saving']['amount'] = 0;
					$this->request->data['Saving']['description'] = $this->request->data['Saving']['comments'];
					$vars =array(
						'page' => NAME_SYSTEM,
						'type' => 'Registro de Ahorro',
						'data' => $this->request->data['Saving'],
						'nameHouse' => 'No Aplica',
						'nameFrom' => 'System',
						'namesTo' => $emailsTo['User']['full_name'],
						'countTo' => 1,
					);
					$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo['User']['email'],$vars);
					// end mandar notificacion via email
				}
			    $this->Session->setFlash(  __( 'Ahorro registrado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				//$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El Ahorro no se ha registrado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('action' => 'index'));
		}
		else
		{
			
			$this->set( array (
							'users' => $this->Saving->User->find('list', array('conditions' => array( 'User.active' => 1))),
							'sessionUser' => $this->Session->read("Auth.User"),
						)
			);
		}
	}

	public function state( )
	{
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {	
			// mandar notificacion via email
			//$namesTo = $this->Saving->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Saving']['borrower_id'] ) ));

			$emailsTo = $this->Saving->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => array($this->request->data['Saving']['lender_id'] ) )));
			$nameFrom = $this->Saving->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Saving']['lender_id'] ) ));
			$vars =array(
				'page' => NAME_SYSTEM,
				'nameFrom' => implode('',$nameFrom),
				'arrays_t' => array(
								'mySavings' => $this->Saving->find('all', array ( 'conditions' => array( 'Saving.lender_id' => $this->request->data['Saving']['lender_id'], 'Saving.active' => 1) ) ),
								'yourSavings' => $this->Saving->find('all', array ( 'conditions' => array( 'Saving.borrower_id' => $this->request->data['Saving']['lender_id'], 'Saving.active' => 1) ) ),
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
							'lenders' => $this->Saving->Lender->find('list', array('conditions' => array( 'Lender.active' => 1))),
							'sessionUser' => $this->Session->read("Auth.User"),
						)
			);
		}

	}

	public function index( )
	{

		$this->set(
				 array(
					'savings' => $this->Saving->find('all', array ( 'conditions' => array( 'Saving.user_id' => $this->Session->read('Auth.User.id'), 'Saving.active' => 1) ) )
				 )
			);
	}
	
	public function delete($id = null) 
	{
		$this->Saving->id = $id;
		if (!$this->Saving->exists()) throw new NotFoundException( __('Prestamo invalido') );
		
		$this->Saving->query("UPDATE `savings` SET  `active` = 0 WHERE `id`=$id;");
		
		
		// mandar notificacion via email
		$this->request->data = $this->Saving->find("first", array('conditions' => array( 'Saving.id' => $id ) ));
		
		$this->request->data['Saving']['user_id'] = $this->request->data['User']['id'];

		$emailsTo = $this->Saving->User->find('first', array('fields' => array('User.id','User.email','User.full_name'), 'conditions' => array('User.id' => $this->request->data['Saving']['user_id'],'User.notifications' => 1 ) ));
		if(count($emailsTo)){	
			$this->request->data['Saving']['amount'] = 0;
			$this->request->data['Saving']['description'] = $this->request->data['Saving']['comments'];
			$vars =array(
				'page' => NAME_SYSTEM,
				'type' => 'Ahorro Eliminado',
				'data' => $this->request->data['Saving'],
				'nameHouse' => 'No Aplica',
				'nameFrom' => 'System',
				'namesTo' => $emailsTo['User']['full_name'],
				'countTo' => 1,
			);
			$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo['User']['email'],$vars);
		}
		// end mandar notificacion via email
		$this->Session->setFlash( __( 'El Ahorro ha sido eliminado.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
        $this->redirect(array('action' => 'index'));		    
	}
	function view($id = null) 
	{
		$this->Saving->id = $id;
		if (!$this->Saving->exists()) throw new NotFoundException( __('Ahorro invalido') );
		//NOTA: validar en la visa Payment.active = 1
		$this->request->data = $this->Saving->find('first',array( 'conditions' => array('Saving.id' => $id,)));
		$this->request->data['sessionUser'] = $this->Session->read("Auth.User");
	}
}