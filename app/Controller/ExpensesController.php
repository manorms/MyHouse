<?php
App::uses('AppController', 'Controller');

class ExpensesController extends AppController {

	public $components = array('GenPassword');
	
	public function add()
	{

		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			$this->Expense->create();
			unset($this->request->data['Template']);
	
			$this->request->data['Expense']['date'] = $this->Expense->dateFormatBeforeSave($this->request->data['Expense']['date']);
			//pr($this->Expense->find('first'));
			//pr($this->request->data);
			//die();
			//$this->Expense->unBindModel(array('belongsTo' => array('Buyer')));
			//$this->Expense->unBindModel(array('belongsTo' => array('House')));
			
			if ( $this->Expense->saveAll( $this->request->data, array( 'deep' => true ) ) ) 
			{	
				// mandar notificacion via email
				foreach($this->request->data['Perro'] as $perro){
					$users_idTo[$perro['user_id']] = $perro['user_id'];
				}
				$namesTo = $this->Expense->Buyer->find('list', array('fields' => array('Buyer.id','Buyer.full_name'), 'conditions' => array('Buyer.id' => $users_idTo ) ));
				$users_idTo[$this->request->data['Expense']['user_id']] = $this->request->data['Expense']['user_id'];
				$emailsTo = $this->Expense->Buyer->find('list', array('fields' => array('Buyer.id','Buyer.email'), 'conditions' => array('Buyer.id' => $users_idTo,'Buyer.notifications' => 1 ) ));
				$nameFrom = $this->Expense->Buyer->find('list', array('fields' => array('Buyer.id','Buyer.full_name'), 'conditions' => array('Buyer.id' => $this->request->data['Expense']['user_id'] ) ));
				$houseName = $this->Expense->House->find('list', array('fields' => array('House.id','House.name'), 'conditions' => array('House.id' => $this->request->data['Expense']['house_id'] ) ));
				$vars =array(
					'page' => NAME_SYSTEM,
					'type' => 'Registro de Gasto',
					'data' => $this->request->data['Expense'],
					'nameHouse' => implode('',$houseName),
					'nameFrom' => implode('',$nameFrom),
					'namesTo' => implode(', ',$namesTo),
					'countTo' => count($namesTo),
				);
				$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo,$vars);
				// end mandar notificacion via email
				
			    $this->Session->setFlash(  __( 'Gasto almacenado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				//$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El Gasto no se ha almacenado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('action' => 'index'));
		}
		else
		{
			App::import('Model','Service');
			$mService = new Service();
			
			App::import('Model','House');
			$mHouse = new House();
			
			$users_id = $mHouse->query('SELECT user_id FROM houses_users WHERE house_id="'.$this->Session->read("Auth.User.House").'"');
			$users_id = Set::classicExtract($users_id, '{n}.houses_users.user_id');
			
			$this->set( array (
							'sessionHouse' => $this->Session->read("Auth.User.House"),
							'houses' => $this->Expense->House->find("list"),
							'users' => $this->Expense->Buyer->find('list', array('conditions' => array('Buyer.id' => $users_id, 'Buyer.active' => 1))),
							'sessionUser' => $this->Session->read("Auth.User"),
							'services' => $mService->find('list',array('conditions' => array( 'Service.active' => 1 ) )),
						)
			);
		}
	}

	
	public function index( )
	{
		$expenses_id = $this->Expense->query("SELECT expense_id FROM expenses_users WHERE user_id='".$this->Session->read("Auth.User.id")."'");
		$expenses_id = Set::classicExtract($expenses_id, '{n}.expenses_users.expense_id');
		$this->set(
				 array(
					'myExpenses' => $this->Expense->find('all', array ( 'conditions' => array( 'Expense.user_id' => $this->Session->read('Auth.User.id'), 'Expense.house_id' => $this->Session->read('Auth.User.House'), 'Expense.active' => 1) ) ),
					'yourExpenses' => $this->Expense->find('all', array ( 'conditions' => array( 'Expense.id' => $expenses_id, 'Expense.house_id' => $this->Session->read('Auth.User.House'), 'Expense.active' => 1) ) ),
				 )
			);
	}
	public function change_template(  )
	{
		App::import('Model','Service');
		$mService = new Service();
		$service = $mService->find('first', array( 'conditions' => array( 'Service.id' => $this->request->data['idService'] ) ) );
		echo json_encode($service['Service']);
		die();
	}
	
	public function delete($id = null) 
	{
		$this->Expense->id = $id;
		if (!$this->Expense->exists()) throw new NotFoundException( __('Gasto invalido') );
		
		$this->Expense->query("UPDATE `expenses` SET  `active` = 0 WHERE `id`=$id;");
		
		
		// mandar notificacion via email
		$this->request->data = $this->Expense->find("first", array('conditions' => array( 'Expense.id' => $id ) ));
		
		$this->request->data['Expense']['user_id'] = $this->request->data['Buyer']['id'];
		$this->request->data['Expense']['house_id'] = $this->request->data['House']['id'];

		foreach($this->request->data['Perro'] as $perro){
			$users_idTo[$perro['id']] = $perro['id'];
		}
		$namesTo = $this->Expense->Buyer->find('list', array('fields' => array('Buyer.id','Buyer.full_name'), 'conditions' => array('Buyer.id' => $users_idTo ) ));
		$users_idTo[$this->request->data['Expense']['user_id']] = $this->request->data['Expense']['user_id'];
		$emailsTo = $this->Expense->Buyer->find('list', array('fields' => array('Buyer.id','Buyer.email'), 'conditions' => array('Buyer.id' => $users_idTo,'Buyer.notifications' => 1 ) ));
		$nameFrom = $this->Expense->Buyer->find('list', array('fields' => array('Buyer.id','Buyer.full_name'), 'conditions' => array('Buyer.id' => $this->request->data['Expense']['user_id'] ) ));
		$houseName = $this->Expense->House->find('list', array('fields' => array('House.id','House.name'), 'conditions' => array('House.id' => $this->request->data['Expense']['house_id'] ) ));
		$vars =array(
			'page' => NAME_SYSTEM,
			'type' => 'Gasto Eliminado',
			'data' => $this->request->data['Expense'],
			'nameHouse' => implode('',$houseName),
			'nameFrom' => implode('',$nameFrom),
			'namesTo' => implode(', ',$namesTo),
			'countTo' => count($namesTo),
		);
		$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo,$vars);
		// end mandar notificacion via email
		$this->Session->setFlash( __( 'El Gasto ha sido eliminado.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
        $this->redirect(array('action' => 'index'));		    
	}
}