<?php
App::uses('Facebook.Facebook', 'View/Helper');
class UsersController extends AppController {
	public $components = array('GenPassword');



	public function beforeFilter()
	{
      //$this->Auth->allow();
			 $this->set(['twitterlogin' => $this->twitterlogin(),
			 'googlelogin' => $this->googlelogin()
			 						]);

			$this->set([
			'googlelogin' => $this->googlelogin()
									]);
			//$this->isTwiiterLogged();
      parent::beforeFilter();
 }
	public function test(){
		$this->layout = 'mobile';
	}


	public function login() {
	/*
	$vars =array(
						'page' => NAME_SYSTEM,
						'name' => 'orlando',
						'username' => 'manor',
						'email' => 'manorms24@gmail.com',
						'password' => $this->GenPassword->genRandomPassword(12,4),
						);
	pr($vars);
	pr($this->GenPassword->sendPassword('send_password','Welcome to '.$vars['page'],'manorms24@gmail.com',$vars));*/
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if( $this->Session->read('Auth.User.active') == 1){
					$this->Session->write('Auth.User.last_activity', time());
					//pr($this->Session->read('Auth.User'));
					$this->Session->setFlash(  __( 'Bienvenido.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
					$this->User->query("UPDATE `users` SET `session_counter`=`session_counter` + 1 WHERE `username`='{$this->request->data['User']['username']}'");
					$this->redirect($this->Auth->redirect());
				}
				else {
					//$this->Session->destroy();
					$this->Session->setFlash(  __( 'Tu cuenta ha sido desactivada.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-warning'
					));
					$this->redirect($this->Auth->logout());
				}
			}
			else {
				$this->Session->setFlash(  __( 'Cuenta invalida o incorrecta.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
			}
		}
		else
		{
			if ($this->Auth->login())
			{
				$this->redirect($this->Auth->redirect());
			}
		}

	}

	public function index() {
		$this->User->recursive = 2;
		$this->request->data = $this->User->find( 'all' );

	}
	public function contact()
	{
		if ($this->request->is('post') || $this->request->is('put'))
		{
			$vars = array(
						'page' => NAME_SYSTEM,
						'name' => $this->request->data['Contactus']['name'],
						'date' => date("d/m/Y H:i:s"),
						'comments' => $this->request->data['Contactus']['comments'],
						'email' => $this->request->data['Contactus']['email']
					);
			$this->GenPassword->sendPassword('contactus','Message from Contac Us',array('myhousesystem@gmail.com','manorms24@gmail.com'),$vars);
			$this->Session->setFlash(  __( 'Agradecemos tu interes, tu comentario ha sido enviado y será tomado en concideración.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
			$this->redirect($this->Auth->redirect());
		}
	}
	public function home() {
		$total = $this->User->query("SELECT SUM(amount) as total FROM expenses WHERE house_id='".$this->Session->read("Auth.User.House")."' AND user_id='".$this->Session->read("Auth.User.id")."' AND active=1");
		App::import('Model','Expense');
		$mExpense = new Expense();
		$expenses_id = $mExpense->query("SELECT expense_id FROM expenses_users WHERE user_id='".$this->Session->read("Auth.User.id")."'");
		$expenses_id = Set::classicExtract($expenses_id, '{n}.expenses_users.expense_id');
		$yourExpenses = $mExpense->find('all', array ( 'conditions' => array( 'Expense.id' => $expenses_id, 'Expense.house_id' => $this->Session->read('Auth.User.House'), 'Expense.active' => 1) ) );
		$myTotal = 0.00;
		foreach($yourExpenses as $expense)
		{
			$myTotal += ($expense['Expense']['amount']/count($expense['Perro']));
		}
		$totalP = $this->User->query("SELECT SUM(amount) as total FROM loans WHERE lender_id='".$this->Session->read("Auth.User.id")."' AND active=1");
		$total2P = $this->User->query("SELECT SUM(amount) as total FROM loans WHERE borrower_id='".$this->Session->read("Auth.User.id")."' AND active=1");
		$totalPaymentsP = $this->User->query("SELECT SUM(payments.amount) as total FROM payments, loans WHERE loans.id=payments.loan_id AND loans.lender_id='".$this->Session->read("Auth.User.id")."' AND loans.active=1 AND payments.active=1");
		$totalPayments2P = $this->User->query("SELECT SUM(payments.amount) as total FROM payments, loans WHERE loans.id=payments.loan_id AND loans.borrower_id='".$this->Session->read("Auth.User.id")."' AND loans.active=1 AND payments.active=1");
		$this->set(
			array(
				'total' => $total[0][0]['total'],
				'myTotal' => $myTotal,
				'totalP' => $totalP['0']['0']['total'],
				'total2P' => $total2P['0']['0']['total'],
				'totalPaymentsP' => $totalPaymentsP['0']['0']['total'],
				'totalPayments2P' => $totalPayments2P['0']['0']['total'],
			)
		);
	}

	public function logout() {
        $this->Session->destroy();
				$this->Session->setFlash(  __( 'Adios, gracias por su visita.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-info'
					));
        $this->redirect($this->Auth->logout());
	}


    public function add() {
        if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['password']=$this->GenPassword->genRandomPassword(13,4);
            if ($this->User->save($this->request->data['User'])) {

				$vars =array(
						'page' => NAME_SYSTEM,
						'name' => $this->request->data['User']['name'],
						'username' => $this->request->data['User']['username'],
						'email' => $this->request->data['User']['email'],
						'password' => $this->request->data['User']['password'],
						);
				$this->GenPassword->sendPassword('send_password','Bienvenido a '.$vars['page'],$this->request->data['User']['email'],$vars);

				$this->Session->setFlash( __( 'El Usuario ha sido almacenado.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash( __( 'Error, por favor intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
			}
        }
		$profiles = $this->User->Profile->find('list');
		$this->set(compact('profiles'));
    }

    public function edit($id = null) {
        $this->User->id = $id;
		if (!$this->User->exists()) throw new NotFoundException( __('Invalid user') );
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->User->save($this->request->data['User']))
			{
				$this->Session->setFlash( __( 'El Usuario ha sido actualizado.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
				$this->redirect('index');
			}
			else
			{
				$this->Session->setFlash( __( 'Error, por favor intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
			}
		}
		else
		{
			$this->request->data = $this->User->read(null, $id);
		}
		$profiles = $this->User->Profile->find('list');
		$this->set(compact('profiles'));
    }
	public function edit2() {
        $this->User->id = $this->Session->read("Auth.User.id");
		if (!$this->User->exists()) throw new NotFoundException( __('Invalid user') );
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->User->save($this->request->data['User']))
			{
				$this->Session->setFlash( __( 'Datos actualizados.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
				$this->redirect('edit2');
			}
			else
			{
				$this->Session->setFlash( __( 'Error, por favor intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
			}
		}
		else
		{
			$this->request->data = $this->User->read(null, $this->User->id);
		}
    }

    public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) throw new NotFoundException( __('Invalid user') );
		$this->User->query("UPDATE `users` SET  `active` = 0 WHERE `id`=$id;");
		$this->Session->setFlash( __( 'El Usuario ha sido eliminado.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
        $this->redirect(array('action' => 'index'));
	}

	public function change_password() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$user = array();
			$user = $this->User->find('first', array('recursive'=>'-1','conditions' => array('id'=> $this->Session->read('Auth.User.id'),'password' => AuthComponent::password($this->request->data['User']['old_password']) ) ) );
			if(isset($user['User']['id'])){
				$user = array('id'=> $this->Session->read('Auth.User.id'), 'password' => $this->request->data['User']['password']);
				if ($this->User->save($user)) {
					$this->Session->setFlash( __('El password ha sido cambiado'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
					$this->redirect(array('action' => 'home'));
				}
				else {
					$this->Session->setFlash( __('Error al cambiar el password, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
				}
			}
			else {
				$this->Session->setFlash( __('Password incorrecto, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
		}
	}

	public function reset_password() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$user = $this->User->find('first',array('recursive'=>'-1','conditions' => array('username'=> $this->request->data['User']['username'] ) ) );
			if(count($user)){
				$this->User->id = $user['User']['id'];
				$newPass = $this->GenPassword->genRandomPassword(13,4);
				if( $this->User->saveField('password',$newPass) ){
					$vars =array(
						'page' => NAME_SYSTEM,
						'name' => $user['User']['full_name'],
						'username' => $user['User']['username'],
						'email' => $user['User']['email'],
						'password' => $newPass,
						);
					$result = $this->GenPassword->sendPassword('reset_password','Reset Password',$user['User']['email'],$vars);
					$this->Session->setFlash( $result[1], 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-'.$result[0]
					));
					$this->redirect('reset_password');
				}else{
					$this->Session->setFlash( __('Se ha presentado algun error. Por favor intente de nuevo y de persistir comuniquese con su administrador'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					));
				}
			}
			else{
				$this->Session->setFlash( __('No se han encotrado registros con el Username capturado'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				));
			}
			//$this->set(compact('contacts'));
		}

	}
}
?>
