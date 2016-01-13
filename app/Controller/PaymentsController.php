<?php
App::uses('AppController', 'Controller');

class PaymentsController extends AppController {

	public $components = array('GenPassword','GCMPush');
	
	public function add( $id = null)
	{
		$this->Payment->Loan->id = $id;
		if (!$this->Payment->Loan->exists()) throw new NotFoundException( __('Prestamo Invalido') );
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			$this->Payment->create();

			$this->request->data['Payment']['date'] = $this->Payment->dateFormatBeforeSave($this->request->data['Payment']['date']);
			//pr($this->Payment->find('first'));
			//pr($this->request->data);
			//die();
			//$this->Payment->unBindModel(array('belongsTo' => array('Lender')));
			//$this->Payment->unBindModel(array('belongsTo' => array('House')));
			
			if ( $this->Payment->save( $this->request->data) ) 
			{	
				// mandar notificacion via email
				$toSendEmail = $this->Payment->Loan->find("first", array('conditions' => array( 'Loan.id' => $id ) ));
				$this->request->data['Payment']['description'] = $this->request->data['Payment']['comments'];
				$toSendEmail['Loan']['lender_id'] = $toSendEmail['Lender']['id'];
				$toSendEmail['Loan']['borrower_id'] = $toSendEmail['Borrower']['id'];

				$namesTo = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $toSendEmail['Loan']['borrower_id'] ) ));
				$emailsTo = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => array($toSendEmail['Loan']['lender_id'], $toSendEmail['Loan']['borrower_id']),'Lender.notifications' => 1 ) ));
				$nameFrom = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $toSendEmail['Loan']['lender_id'] ) ));
				$vars =array(
					'page' => NAME_SYSTEM,
					'type' => 'Abono Registrado',
					'data' => $this->request->data['Payment'],
					'loan' => $toSendEmail['Loan'],
					'nameHouse' => 'No Aplica',
					'nameFrom' => implode('',$nameFrom),
					'namesTo' => implode(', ',$namesTo),
					'countTo' => 1,
				);
				$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo,$vars);
				$this->GCMPush->send($vars);
				// end mandar notificacion via email
				
			    $this->Session->setFlash(  __( 'Abono registrado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				//$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El Abono no se ha registrado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('controller' => 'loans', 'action' => 'view',$id));
		}
		else
		{
			
			$this->set( array (
							'loan' => $this->Payment->Loan->find('first', array('conditions' => array( 'Loan.id' => $id))),
						)
			);
		}
	}

	
	public function index( )
	{

		$this->set(
				 array(
					'myPayments' => $this->Payment->find('all', array ( 'conditions' => array( 'Payment.lender_id' => $this->Session->read('Auth.User.id'), 'Payment.active' => 1) ) ),
					'yourPayments' => $this->Payment->find('all', array ( 'conditions' => array( 'Payment.borrower_id' => $this->Session->read('Auth.User.id'),  'Payment.active' => 1) ) ),
				 )
			);
	}
	
	public function delete($id = null, $loanId) 
	{
		$this->Payment->id = $id;
		if (!$this->Payment->exists()) throw new NotFoundException( __('Abono invalido') );
		
		$this->Payment->query("UPDATE `payments` SET  `active` = 0 WHERE `id`=$id;");
		$this->request->data = $this->Payment->find('first',array('conditions' => array('Payment.id' => $id)));
		
		// mandar notificacion via email
		$toSendEmail = $this->Payment->Loan->find("first", array('conditions' => array( 'Loan.id' => $loanId ) ));
		$this->request->data['Payment']['description'] = $this->request->data['Payment']['comments'];
		$toSendEmail['Loan']['lender_id'] = $toSendEmail['Lender']['id'];
		$toSendEmail['Loan']['borrower_id'] = $toSendEmail['Borrower']['id'];

		$namesTo = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $toSendEmail['Loan']['borrower_id'] ) ));
		$emailsTo = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => array($toSendEmail['Loan']['lender_id'], $toSendEmail['Loan']['borrower_id']),'Lender.notifications' => 1 ) ));
		$nameFrom = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $toSendEmail['Loan']['lender_id'] ) ));
		$vars = array(
			'page' => NAME_SYSTEM,
			'type' => 'Abono Eliminado',
			'data' => $this->request->data['Payment'],
			'loan' => $toSendEmail['Loan'],
			'nameHouse' => 'No Aplica',
			'nameFrom' => implode('',$nameFrom),
			'namesTo' => implode(', ',$namesTo),
			'countTo' => 1,
		);
		$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo,$vars);
		$this->GCMPush->send($vars);
		// end mandar notificacion via email
		$this->Session->setFlash( __( 'El Abono ha sido eliminado.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
				
        $this->redirect(array('controller' => 'loans', 'action' => 'view',$loanId));		    
	}
}