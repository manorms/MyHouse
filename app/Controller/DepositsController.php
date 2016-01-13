<?php
App::uses('AppController', 'Controller');

class DepositsController extends AppController {

	public $components = array('GenPassword');
	
	public function add( $id = null)
	{
		$this->Deposit->Saving->id = $id;
		if (!$this->Deposit->Saving->exists()) throw new NotFoundException( __('Prestamo Invalido') );
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			$this->Deposit->create();

			$this->request->data['Deposit']['date'] = $this->Deposit->dateFormatBeforeSave($this->request->data['Deposit']['date']);

			if ( $this->Deposit->save( $this->request->data) ) 
			{	
				// mandar notificacion via email
				$toSendEmail = $this->Deposit->Saving->find("first", array('conditions' => array( 'Saving.id' => $id ) ));
				$this->request->data['Deposit']['description'] = $this->request->data['Deposit']['comments'];
				$toSendEmail['Saving']['user_id'] = $toSendEmail['User']['id'];

		
				$emailsTo = $this->Deposit->Saving->User->find('first', array('fields' => array('User.id','User.email', 'User.full_name'), 'conditions' => array('User.id' => $toSendEmail['Saving']['user_id'],'User.notifications' => 1 ) ));
				if(count($emailsTo)){
					$vars =array(
						'page' => NAME_SYSTEM,
						'type' => 'Deposito a Ahorro Registrado',
						'data' => $this->request->data['Deposit'],
						'nameHouse' => 'No Aplica',
						'nameFrom' => 'System',
						'namesTo' => $emailsTo['User']['full_name'],
						'countTo' => 1,
					);
					$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo['User']['email'],$vars);
					// end mandar notificacion via email
				}
			    $this->Session->setFlash(  __( 'Deposito registrado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				//$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El Deposito no se ha registrado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('controller' => 'savings', 'action' => 'view',$id));
		}
		else
		{
			
			$this->set( array (
							'saving' => $this->Deposit->Saving->find('first', array('conditions' => array( 'Saving.id' => $id))),
						)
			);
		}
	}

	
	public function index( )
	{

		$this->set(
				 array(
					'myDeposits' => $this->Deposit->find('all', array ( 'conditions' => array( 'Deposit.lender_id' => $this->Session->read('Auth.User.id'), 'Deposit.active' => 1) ) ),
					'yourDeposits' => $this->Deposit->find('all', array ( 'conditions' => array( 'Deposit.borrower_id' => $this->Session->read('Auth.User.id'),  'Deposit.active' => 1) ) ),
				 )
			);
	}
	
	public function delete($id = null, $SavingId) 
	{
		$this->Deposit->id = $id;
		if (!$this->Deposit->exists()) throw new NotFoundException( __('Desposito invalido') );
		
		$this->Deposit->query("UPDATE `deposits` SET  `active` = 0 WHERE `id`=$id;");
		$this->request->data = $this->Deposit->find('first',array('conditions' => array('Deposit.id' => $id)));
		
		// mandar notificacion via email
		$toSendEmail = $this->Deposit->Saving->find("first", array('conditions' => array( 'Saving.id' => $SavingId ) ));
		$this->request->data['Deposit']['description'] = $this->request->data['Deposit']['comments'];
		$toSendEmail['Saving']['user_id'] = $toSendEmail['User']['id'];

		
		$emailsTo = $this->Deposit->Saving->User->find('list', array('fields' => array('User.id','User.email','User.full_name'), 'conditions' => array('User.id' => $toSendEmail['Saving']['user_id'],'User.notifications' => 1 ) ));
		
		if(count($emailsTo)){
			$vars = array(
				'page' => NAME_SYSTEM,
				'type' => 'Deposito a Ahorro Eliminado',
				'data' => $this->request->data['Deposit'],
				'nameHouse' => 'No Aplica',
				'nameFrom' => 'System',
				'namesTo' => $namesTo['User']['full_name'],
				'countTo' => 1,
			);
		}
		$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo['full_name']['email'],$vars);
		// end mandar notificacion via email
		$this->Session->setFlash( __( 'El Deposito a Ahorro ha sido eliminado.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
				
        $this->redirect(array('controller' => 'Savings', 'action' => 'view',$SavingId));		    
	}
}