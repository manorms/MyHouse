<?php

class RestUsersController extends AppController {
	 public $components = array('RequestHandler','GenPassword', 'GCMPush');
	 public $uses = array('User','Loan','Saving','Payment', 'Expense');
	public function beforeFilter()
	{
      $this->Auth->allow();
		//	$this->set(['twitterlogin' => $this->twitterlogin(),'googlelogin' => $this->googlelogin()]);
			//$this->isTwiiterLogged();
      parent::beforeFilter();
 }
	public function get_url_ext_signin(){
		$this->set(['twitterlogin' => $this->twitterlogin(),
		'_serialize' => array('twitterlogin')
								]);

	}
	public function oauth2(){
		@$email = $this->request->data['email'];
		@$network = $this->request->data['network'];
		$status = 0;
		$messaje = '';
		if($network == "Twitter"){
			$user = $this->User->find('first', array('fields' => array('User.username'), 'conditions' => array('User.twitter_id' => $email)));
			if(count($user)){
				//$this->Session->destroy();
				$message = 'Bienvenido.';
				$created_session = $this->forceLogin($user['User']['username'],$network);
				$logged = $this->networking_login($network);
				if(!$logged) $message = 'Lo sentimos, no pudimos acceder intenta de nuevo.';
				$status = ($created_session && $logged);
			}
			else{
				$status = 0;
				$message = 'Lo sentimos el usuario @'.$email.' obtenido desde '.$network.' no esta registrado en MyHouse (Accede desde otra opción y capturalo en editar mis datos)';
			}
		}
		else{
			$message = 'Bienvenido.';
			$created_session = $this->forceLogin($email,$network);
			$logged = $this->networking_login($network);
			if(!$created_session) $message = 'Lo sentimos, el E-mail '.$email.' obtenido desde '.$network.' no esta registrado en MyHouse.';
			if(!$logged) $message = 'Lo sentimos, no pudimos acceder intenta de nuevo.';
			$status = ($created_session && $logged);
		}
		if($status){
			if(isset($this->request->data['uuid']) && $this->request->data['uuid'] != '' && isset($this->request->data['device_id']) && $this->request->data['device_id']!=''){
				$this->User->query("DELETE FROM `devices_users` WHERE device_uuid='{$this->request->data['uuid']}' ");
				//$select = $this->User->query("SELECT * FROM `devices_users`WHERE user_id='{$this->Session->read('Auth.User.id')}' AND device_uuid='{$this->request->data['uuid']}' ");
				$this->User->query("INSERT INTO `devices_users` (user_id,device_id,device_uuid,created) values ('{$this->Session->read('Auth.User.id')}','{$this->request->data['device_id']}','{$this->request->data['uuid']}',NOW())");
			}
		}
		$this->set(array(
            'message' => $message,
            'status' => $status,
						'data' => $this->Session->read('Auth.User'),
            '_serialize' => array('message', 'status','data')
        ));

	}
	public function login() {
		$this->Auth->logout();
		$status = 0;
		$message = "";
		$date = date("Y-m-d H:i:s");

		if ($this->request->is('post')) {

			$this->request->data['User']['username'] = $this->request->data['username'];
			$this->request->data['User']['password'] = $this->request->data['password'];
			if ($this->Auth->login()) {
				if( $this->Session->read('Auth.User.active') == 1){
					//pr($this->Session->read('Auth.User'));
					$this->User->query("UPDATE `users` SET `session_counter`=`session_counter` + 1 WHERE `username`='{$this->request->data['User']['username']}'");
					if($this->request->data['device_id']!=''){

						$this->User->query("DELETE FROM `devices_users` WHERE device_uuid='{$this->request->data['uuid']}' ");

						//$select = $this->User->query("SELECT * FROM `devices_users`WHERE user_id='{$this->Session->read('Auth.User.id')}' AND device_uuid='{$this->request->data['uuid']}' ");
						$this->User->query("INSERT INTO `devices_users` (user_id,device_id,device_uuid,created) values ('{$this->Session->read('Auth.User.id')}','{$this->request->data['device_id']}','{$this->request->data['uuid']}','{$date}')");
					}
					$status = 1;
					$message="Bienvenido";
				}
				else {
					//$this->Session->destroy();
					$message = 'Tu cuenta ha sido desactivada.';
				}
			}
			else {
				$message = 'Cuenta invalida o incorrecta.';
			}
		}
		else $message = "Error en solicitud.";

		$this->set(array(
            'message' => $message,
            'status' => $status,
						'user_id' => $this->Session->read('Auth.User.id'),
            '_serialize' => array('message', 'status', 'user_id')
        ));
	}

	public function reset_password($username) {
		$username = base64_decode($username);
		$status = 0;
		$message = "";
			$user = $this->User->find('first',array('recursive'=>'-1','conditions' => array('username'=> $username ) ) );
			if(count($user)){
				$this->User->id = $user['User']['id'];
				$newPass = $this->GenPassword->genRandomPassword(13,4);
				if( $this->User->saveField('password',$newPass) ){
					$vars =array(
						'page' => NAME_SYSTEM,
						'name' => $user['User']['full_name'],
						'username' => $user['User']['username'],
						'email' => $user['User']['username'],
						'password' => $newPass,
						);
					$result = $this->GenPassword->sendPassword('reset_password','Reset Password',$user['User']['username'],$vars);
					$status = ($result[0]=='success');
					$message = str_replace("<br/>", " ", $result[1]);
				}else{
					$status = 0;
					$message = 'Se ha presentado algun error. Por favor intente de nuevo y de persistir comuniquese con su administrador.';
				}
			}
			else{
				$status = 0;
				$message = 'No se han encotrado registros con el E-mail capturado';
			}
			//$this->set(compact('contacts'));
/*
		$this->set(array(
            'message' => $message,
            'status' => $status,
			'data' => ['username' => $username,$user],
            '_serialize' => array('message', 'status', 'data')
        ));*/

		die(json_encode(['message' => $message,'status' => $status,'data' => ['username' => $username,$user]]));

	}

	public function logout($id) {
        //$this->Session->destroy();
        if ($this->request->is('post') || $this->request->is('put')) {
	        $this->User->query("DELETE FROM `devices_users` WHERE device_uuid='{$this->request->data['uuid']}' ");
	        $this->Session->destroy();
    	}
        $this->set(array(
            'message' => 'ok',
            'status' => 1,
			'data' => ['uuid' => $this->request->data['uuid']],
            '_serialize' => array('message', 'status', 'data')
        ));
	}
	public function set_notifications(){
		$status = 0;
		$message = "";
		if( true || $this->Session->read('Auth.User.id')!=""){
			if ($this->request->is('post') || $this->request->is('put')) {
				$user = $this->User->find('first',array('recursive'=>'-1','conditions' => array('id'=> $this->Session->read('Auth.User.id') ) ) );
				$this->User->id = $user['User']['id'];
				$value = $this->request->data['value']=='true';
				if($this->User->saveField($this->request->data['field'], $value)){
					$status = 1;
					$array = array('false' => 'Desactivas', 'true' => 'Activadas' );
					$message = 'Notificaciones('.(($this->request->data['field'] == 'notifications')? 'E-mail' : 'App').'): '.$array[$this->request->data['value']];
				}else{
					$status = 0;
					$message = 'Se ha presentado algun error. Por favor intente de nuevo y de persistir comuniquese con su administrador.';
				}

			}
		}
		else{
			$status = 0;
			$message = 'Por favor inicie sesión de nuevo.';
		}
		$this->set(array(
            'message' => $message,
            'status' => $status,
            '_serialize' => array('message', 'status')
        ));
        //die(json_encode(array('message' => $message, 'status' => $status)));
	}
	public function read_user(){
		$status = 0;
		$message = "";
		$user = array();
		if( $this->Session->read('Auth.User.id')!=""){
			$user = $this->Session->read('Auth.User');
			$status = 1;
			$message = 'Done';
		}
		else{
			$status = 0;
			$message = 'Por favor inicie sesión de nuevo.';
		}
		$this->set(array(
            'message' => $message,
            'status' => $status,
            'user' => $user,
            '_serialize' => array('message', 'status', 'user')
        ));
        //die(json_encode(array('message' => $message, 'status' => $status)));
	}
	private function calculateLoan($loans){
		$_loans = [];
		$total = 0.00;
		$count = 0;
		foreach($loans as $loan)
		{

			$flagShow = false;
			$totalPayment_p = 0.00;
			foreach($loan['Payment'] as $payment)
			{
				$totalPayment_p += $payment['amount'];
			}
			if(($loan['Loan']['amount']-$totalPayment_p) > 0){
				$_loans[$count]['id'] = Set::classicExtract($loan,"Loan.id");
				$_loans[$count]['description'] = Set::classicExtract($loan,"Loan.description");
				$_loans[$count]['amount'] = Set::classicExtract($loan,"Loan.amount");
				$_loans[$count]['lender'] = Set::classicExtract($loan,"Lender.full_name");
				$_loans[$count]['borrower'] = Set::classicExtract($loan,"Borrower.full_name");
				$_loans[$count]['owe'] = $loan['Loan']['amount']-$totalPayment_p;
				$count++;
			}

		}
		return $_loans;
	}



	public function add_loan()
	{
			$this->Loan->create();
			$message = "";
			$this->request->data['Loan'] = $this->request->data;
			$status = $this->Loan->save($this->request->data);
			if($status){
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
			}
			else
			{
				$message = "Error al almacenar el prestamo.";
			}
			die(json_encode(['message' => $message,'status' => count($status)>0,'data' => $status]));
			// $this->set(array(
	    //         'message' => $message,
	    //         'status' => $status,
	    //         'data' => json_encode($this->request->data),
	    //         '_serialize' => array('message', 'status', 'data')
	    //     ));
	}


	public function getLoans($user_id){
		$status = true;
		$myLoans = $this->Loan->find('all', array ( 'conditions' => array( 'Loan.lender_id' => $user_id, 'Loan.active' => 1) ) );
		$yourLoans = $this->Loan->find('all', array ( 'conditions' => array( 'Loan.borrower_id' => $user_id,  'Loan.active' => 1) ) );
		$myLoans = $this->calculateLoan($myLoans);
		$yourLoans = $this->calculateLoan($yourLoans);
		$loans = [
		 'myLoans' => $myLoans,
		 'yourLoans' => $yourLoans
	  ];
		$this->set(array(
            'message' => 'OK',
            'status' => $status,
            'data' => $loans,
            '_serialize' => array('message', 'status', 'data')
        ));
	}
	public function add_payment_test()
	{
			$id = 20;

		$payment = 99;
		pr($result);
		if($payment>$owe){
			die(json_encode(['message' => "No se puede pagar más de lo prestado.",'status' => false,'data' => $result]));
		}
		die('ok');
	}
	public function add_payment()
	{
		$id = $this->request->data['loan_id'];
		$result = $this->Payment->find('first',['fields' => ['SUM(Payment.amount) as payment_amount'], 'conditions' => ['loan_id' => $id, 'Payment.active' => 1]]);
		$result2 = $this->Loan->find('first',['fields' => ['Loan.amount'], 'conditions' => ['Loan.id' => $id]]);
		if($result[0]['payment_amount']=='') $result[0]['payment_amount'] = 0.00;
		$owe = $result2['Loan']['amount'] - $result[0]['payment_amount'];

		$payment = $this->request->data['amount'];
		if($payment>$owe){
			die(json_encode(['message' => "No se puede pagar más de lo prestado.",'status' => false,'data' => $result]));
		}

			$this->Payment->Loan->id = $id;
			$this->Payment->create();
			$message = "";

			$data['Payment'] = $this->request->data;
			$status = $this->Payment->save($data);
			if($status)
			{
				// mandar notificacion via email
				$toSendEmail = $this->Payment->Loan->find("first", array('conditions' => array( 'Loan.id' => $id ) ));
				$data['Payment']['description'] = $data['Payment']['comments'];
				$toSendEmail['Loan']['lender_id'] = $toSendEmail['Lender']['id'];
				$toSendEmail['Loan']['borrower_id'] = $toSendEmail['Borrower']['id'];

				$namesTo = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $toSendEmail['Loan']['borrower_id'] ) ));
				$emailsTo = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => array($toSendEmail['Loan']['lender_id'], $toSendEmail['Loan']['borrower_id']),'Lender.notifications' => 1 ) ));
				$nameFrom = $this->Payment->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $toSendEmail['Loan']['lender_id'] ) ));
				$vars = array(
					'page' => NAME_SYSTEM,
					'type' => 'Abono Registrado',
					'data' => $data['Payment'],
					'loan' => $toSendEmail['Loan'],
					'nameHouse' => 'No Aplica',
					'nameFrom' => implode('',$nameFrom),
					'namesTo' => implode(', ',$namesTo),
					'countTo' => 1,
				);
				$this->GenPassword->sendPassword('send_notification','Notifications',$emailsTo,$vars);
				$this->GCMPush->send($vars);
				// end mandar notificacion via email

			    $message = 'Abono registrado correctamente.';

				//$this->redirect(array('action' => 'index'));
			}
			else
			{
				$message = 'El Abono no se ha registrado, intente de nuevo';

			}
			die(json_encode(['message' => $message,'status' => count($status)>0,'data' => $status]));
			// $this->set(array(
	    //     'message' => 'OK',
	    //     'status' => $status,
	    //     'data' => $data['Payment'],
	    //     '_serialize' => array('message', 'status', 'data')
	    // ));

	}





		public function state( $user_id)
		{
				// mandar notificacion via email
				//$namesTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $this->request->data['Loan']['borrower_id'] ) ));

				$emailsTo = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.email'), 'conditions' => array('Lender.id' => $user_id )));
				$nameFrom = $this->Loan->Lender->find('list', array('fields' => array('Lender.id','Lender.full_name'), 'conditions' => array('Lender.id' => $user_id  ) ));
				$vars =array(
					'page' => NAME_SYSTEM,
					'nameFrom' => implode('',$nameFrom),
					'arrays_t' => array(
									'myLoans' => $this->Loan->find('all', array ( 'conditions' => array( 'Loan.lender_id' => $user_id, 'Loan.active' => 1) ) ),
									'yourLoans' => $this->Loan->find('all', array ( 'conditions' => array( 'Loan.borrower_id' => $user_id, 'Loan.active' => 1) ) ),
				 	)
				);
				$result = $this->GenPassword->sendPassword('loans_report','Solicitud estado de cuenta',$emailsTo,$vars);
				// end mandar notificacion via email


				$status = ($result[0]=='success');
				$message = str_replace("<br/>", " ", $result[1]);


				die(json_encode(['message' => $message,'status' => $status,'data' => ['username' => $emailsTo]]));

		}



		//Ahorros

	public function getSavings($user_id){
		$savings =  $this->Saving->find('all', array ( 'conditions' => array( 'Saving.user_id' => $user_id, 'Saving.active' => 1) ) );
		$status = true;
		$this->set(array(
            'message' => 'OK',
            'status' => $status,
            'data' => $savings,
            '_serialize' => array('message', 'status', 'data')
        ));
	}

private function selectHouse($user_id){
	$house = $this->User->query("SELECT house_id FROM houses_users INNER JOIN houses ON houses.id = house_id WHERE user_id='".$user_id."' AND houses.active=1 LIMIT 1");
  return Set::classicExtract($house, "0.houses_users.house_id");
	// pr(Set::classicExtract($house, "0.houses_users.house_id"));
	// die();
}


public function getExpenses($id){
	$message = "";
	$status = 0;


	$myExpenses = [];
	$total = [];
	$myTotal = 0.00;
	$yourExpenses = [];


	$house_id = $this->selectHouse($id);

	if($house_id){
		$fields = [
			'Expense.id','Expense.description','Expense.date','Expense.amount',
			'Buyer.name','Buyer.first_last_name'
		];
		$total = $this->User->query("SELECT SUM(amount) as total FROM expenses WHERE house_id='".$house_id."' AND user_id='".$id."' AND active=1");
		$expenses_id = $this->Expense->query("SELECT expense_id FROM expenses_users WHERE user_id='".$id."'");
		$expenses_id = Set::classicExtract($expenses_id, '{n}.expenses_users.expense_id');
		$this->Expense->recursive = 1;
		$yourExpenses = $this->Expense->find('all', array ( 'fields' => $fields, 'conditions' => array( 'Expense.id' => $expenses_id, 'Expense.house_id' => $house_id, 'Expense.active' => 1) ) );
		$myExpenses = $this->Expense->find('all', array ( 'fields' => $fields, 'conditions' => array( 'Expense.user_id' => $id, 'Expense.house_id' => $house_id, 'Expense.active' => 1) ) );

		foreach($yourExpenses as $expense)
		{
			$myTotal += ($expense['Expense']['amount']/count($expense['Perro']));
		}
		$message = "OK";
		$status = 1;
	}
	else{
		$message = "No cuentas con gastos compartidos, comunicate con tu administrador.";
		$status = 0;
	}

	$this->set(
		array(
			'data' => [
				'total' => Set::classicExtract($total,"0.0.total"),
				'myTotal' => $myTotal,
				'myExpenses' => $myExpenses,
				'yourExpenses' => $yourExpenses
			],
			'message' => $message,
			'status' => $status,
			'_serialize' => array('message', 'status', 'data')
	));

}









	public function sendNotification(){
		$apiKey = "AIzaSyCsA4KTzdw9A8MTHAEsWJe-fFQiDQtGQVQ"; //api key

		$devices = $this->User->query("SELECT device_id from `devices_users` WHERE user_id='1';");
		$devices = Set::classicExtract($devices,'{n}.devices_users.device_id');



		$gcpm = new GCMPushMessage2($apiKey);
		$gcpm->setDevices($devices);
		$to_send= [
			'title' => 'Test title 4',
			'message' => 'Testing 2',
			'style' => "inbox",
			'ledColor' => [0,200,40,50],
			//'image' => 'http://myhouse.alpha-soluciones.com/app/webroot/img/drawable-xxxhdpi/ic_stat_default.png',
      'summaryText' => "There are %n% notifications",
			// 'actions'=> [
			// 	[ 'icon'=> "emailGuests", 'title'=> "EMAIL GUESTS", 'callback'=> "app.emailGuests"],
			// 	[ 'icon'=> "snooze", 'title'=> "SNOOZE", 'callback'=> "app.snooze"],
			// ]
		];
		$response = $gcpm->send($to_send); //title of the message
		die($response);
	}



}
?>

<?php

class GCMPushMessage2 {
    var $url = 'https://android.googleapis.com/gcm/send';
    var $serverApiKey = "";
    var $devices = array();

    function GCMPushMessage2($apiKeyIn){
        $this->serverApiKey = $apiKeyIn;
    }
    function setDevices($deviceIds){

        if(is_array($deviceIds)){
            $this->devices = $deviceIds;
        } else {
            $this->devices = array($deviceIds);
        }

    }
    function send( $data = false){

        if(!is_array($this->devices) || count($this->devices) == 0){
            $this->error("No devices set");
        }

        if(strlen($this->serverApiKey) < 8){
            $this->error("Server API Key not set");
        }

        $fields = array(
            'registration_ids'  => $this->devices,
            'data'              => array( "message" => $data['message'] ),
        );

        if(is_array($data)){
            foreach ($data as $key => $value) {
                $fields['data'][$key] = $value;
            }
        }
				pr(json_encode($fields));
        $headers = array(
            'Authorization: key=' . $this->serverApiKey,
            'Content-Type: application/json'
        );
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, $this->url );

        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

    function error($msg){
        echo "Android send notification failed with error:";
        echo "\t" . $msg;
        exit(1);
    }
}


?>
