<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::import('Vendor', 'phpMailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
public $components = array(
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'scope' => array( 'User.active' => true ),
                    'fields' => array('username' => 'username')
                )
            ),
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
            'loginAction' => array( 'plugin' => false, 'controller' => 'users', 'action' => 'login' ),
			'authError' => "Lo sentimos, usted no tiene acceso para ver la página seleccionada.",
            'loginRedirect' => array( 'plugin' => false, 'controller' => 'users', 'action' => 'home' ),
            'logoutRedirect' => array( 'plugin' => false, 'controller' => 'users', 'action' => 'login' ),
			'flash' => array(
				'element' => 'alert',
				'key' => 'auth',
				'params' => array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				)
			)
        ),
    'Facebook.Connect' => array('model' => 'User'),
		'RequestHandler',
		'Session',
		'Acl',
		'Email'
    );
	public $helpers = array('Html', 'Form', 'Session', 'Js' => array('Jquery'), 'JqueryValidation','Facebook.Facebook' => array('locale' => 'es_MX'));


	public function beforeFilter() {
		$db = ConnectionManager::getDataSource('default');
		$db->fetchAll('SET SQL_BIG_SELECTS=1;');
		//$this->Auth->allow( );
		$this->Auth->allow( 'login', 'logout', 'reset_password', 'contact', 'set_notifications', 'read_user');
        if( $this->Session->check('Auth.User.session_time') && $this->Session->check('Auth.User.last_activity') && (time() - $this->Session->read('Auth.User.last_activity') > $this->Session->read('Auth.User.session_time'))) {
            $this->Session->setFlash(  __( 'Sesión cerrada por inactividad.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
            $this->Auth->logout();
            //die("<script>window.location.href='{$this->request->webroot}';</script>");
        }
        if ($this->Auth->login())
		{
			$this->Session->write('Auth.User.last_activity', time());
			/*if($this->Session->read('Auth.User.House')=="")
			{
				$chooseHouse = true;

			}
			else
			{
				$chooseHouse = ;
			}*/
		}
        //Configure::write('Config.language', $this->Session->read('Config.language'));


	}





  public function twitterlogin(){

  	define('CONSUMER_KEY', 'IlJ2ByYBvkJSvn7GSsf1dsZsP');
  	define('CONSUMER_SECRET', 'PGNXoirRulrLKUPMOoixM6d7jPlOU9CwN6frTU1TS3EhBaYebF');
  	define('OAUTH_CALLBACK', 'http://myhouse.alpha-soluciones.com/users');

  	App::import('Vendor', 'Twitter', array('file' => 'Twitter'.DS.'inc'.DS.'twitteroauth.php'));

  	$access_token = array();

  	if (isset($_REQUEST['oauth_token']) && $this->Session->read('Twitter.token')  !== $_REQUEST['oauth_token']) {

  		// if token is old, distroy any session and redirect user to index.php
  		//$this->Session->destroy();
  		header('Location: ' . filter_var(OAUTH_CALLBACK, FILTER_SANITIZE_URL));

  	}elseif(isset($_REQUEST['oauth_token']) && $this->Session->read('Twitter.token') == $_REQUEST['oauth_token']) {

  		// everything looks good, request access token
  		//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
  		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $this->Session->read('Twitter.token') , $this->Session->read('Twitter.token_secret'));
  		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
  		pr($access_token);
  		if($connection->http_code=='200')
  		{
  			//redirect user to twitter
  			//$this->Session->write('Twitter.status','verified');
  			//$this->Session->write('Twitter.request_vars',$access_token);
  			$user = $this->User->find('first', array('fields' => array('User.username'), 'conditions' => array('User.twitter_id' => $access_token['screen_name'])));
  			if(count($user)){
  				//$this->Session->destroy();
  				$this->forceLogin($user['User']['username'],'Twitter');
  				$this->networking_login('Twitter');
  			}
  			else{
  				//$this->Session->destroy();
  				$this->Session->setFlash(  __( 'Lo sentimos el usuario @'.$access_token['screen_name'].' obtenido desde Twitter no esta registrado en MyHouse (Accede desde otra opción y capturalo en editar mis datos).'), 'alert', array(
  						'plugin' => 'BoostCake',
  						'class' => 'alert-danger'
  					));
  			}
  			// unset no longer needed request tokens
  			$this->Session->delete('Twitter.token');
  			$this->Session->delete('Twitter.token_secret');
  			//pr($_SESSION);
  			header('Location: ' . filter_var(OAUTH_CALLBACK, FILTER_SANITIZE_URL));
  		}else{
  			die("error, try again later!");
  		}

  	}else{

  		if(isset($_GET["denied"]))
  		{
  			header('Location: ' . filter_var(OAUTH_CALLBACK, FILTER_SANITIZE_URL));
  			die();
  		}

  		//fresh authentication
  		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
  		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

  		//received token info from twitter
  		$this->Session->write('Twitter.token',$request_token['oauth_token']);
  		$this->Session->write('Twitter.token_secret',$request_token['oauth_token_secret']);

  		// any value other than 200 is failure, so continue only if http code is 200
  		$twitter_url = '';
  		if($connection->http_code=='200')
  		{
  			//redirect user to twitter
  			$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
  			//header('Location: ' . $twitter_url);
  		}else{
  			die("error connecting to twitter! try again later!");
  		}
  	}
  	return array ('AuthUrl' => $twitter_url,'defaults' => $this->Session->read('Twitter.defaults'), 'User' => $access_token);

  }
  public function googlelogin()
  {
  		########## Google Settings.. Client ID, Client Secret #############
  		$google_client_id = '655713364128-b4ul4nhvrbss589scr42g3r0pqg9vkk1.apps.googleusercontent.com';
  		$google_client_secret = 'NY_yyjQn8uRFYe1-k769SbnU';
  		$google_redirect_url = 'http://myhouse.alpha-soluciones.com/users/';
  		$google_developer_key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

  		//include google api files
  		//App::import('Lib', 'Google/src/Google_Client.php');
  		//App::import('Lib', 'Google/src/contrib/Google_Oauth2Service.php');
  		//require_once 'Lib/Google/src/Google_Client.php';
  		//require_once 'Lib/Google/src/contrib/Google_Oauth2Service.php';
  		App::import('Vendor', 'GoogleGoogle_Client', array('file' => 'Google'.DS.'src'.DS.'Google_Client.php'));
  		App::import('Vendor', 'GoogleGoogle_Oauth2Service', array('file' => 'Google'.DS.'src'.DS.'contrib'.DS.'Google_Oauth2Service.php'));

  		$gClient = new Google_Client();
  		$gClient->setApplicationName('MyHouse');
  		$gClient->setClientId($google_client_id);
  		$gClient->setClientSecret($google_client_secret);
  		$gClient->setRedirectUri($google_redirect_url);
  		$gClient->setDeveloperKey($google_developer_key);

  		$google_oauthV2 = new Google_Oauth2Service($gClient);

  		//If user wish to log out, we just unset Session variable
  		if (isset($_REQUEST['reset']))
  		{
  			$this->set('msg', 'Logout');
  			//unset($_SESSION['token']);
  			$this->Session->delete('Google.token');
  			$gClient->revokeToken();
  			header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
  		}

  		//Redirect user to google authentication page for code, if code is empty.
  		//Code is required to aquire Access Token from google
  		//Once we have access token, assign token to session variable
  		//and we can redirect user back to page and login.

  		if (isset($_REQUEST['code']))
  		{
  			$gClient->authenticate($_REQUEST['code']);
  			$this->Session->write('Google.token', $gClient->getAccessToken());
  			//$this->redirect(filter_var($google_redirect_url, FILTER_SANITIZE_URL), null, false);
  			//header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
  			$this->redirect($this->Auth->redirect());
  			return;
  		}

  	if ($this->Session->read('Google.token'))
  	{
  		$gClient->setAccessToken($this->Session->read('Google.token'));
  	}
  	$user = array();
  	$authUrl = '';
  	if ($gClient->getAccessToken())
  	{
  		//Get user details if user is logged in

  		$user = $google_oauthV2->userinfo->get();
  		$user_id = $user['id'];
  		$user['name'] = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
  		$user['email'] = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  		//$profile_url = filter_var($user['link'], FILTER_VALIDATE_URL);
  		//$profile_image_url = filter_var($user['picture'], FILTER_VALIDATE_URL);
  		//$personMarkup = "$email<div><img src='$profile_image_url?sz=50'></div>";
  		//$this->Session->destroy();
  		$this->Session->write('Google.token', $gClient->getAccessToken());
  		$this->forceLogin($user['email'],'Google');
  		$this->networking_login('Google');
  	}
  	else
  	{
  		//get google login url
  		$authUrl = $gClient->createAuthUrl();
  	}

  	return array ('AuthUrl' => $authUrl, 'User' => $user);

  }

  	public function forceLogin($userName,$netowork = '') {
    //  $this->_setDefaults();

      $this->User = ClassRegistry::init('User');
      //$this->User->recursive = 0;
      $user = $this->User->findByUsername($userName);

      if (!empty($user['User'])) {
          $this->Session->renew();
          //$user['User']['id'] = null;
          $user['User']['password'] = null;
          $this->Session->write(AuthComponent::$sessionKey, $user['User']);

  				return true;
      }
  		elseif($userName!='') {
  			//$this->Session->delete('Message.auth');
  			//$this->Session->destroy();
  			$this->Session->setFlash(  __( 'Lo sentimos el E-mail '.$userName.' obtenido desde '.$netowork.' no esta registrado en MyHouse.')."<a classs='btn' onclick=\"logout('/users/logout');\" > Click aquí para intentar con otra cuenta.</a>", 'alert', array(
  					'plugin' => 'BoostCake',
  					'class' => 'alert-danger'
  				));

  		}
  		return false;
    }

  	function beforeFacebookSave(){

  		  $logged = $this->forceLogin($this->Connect->user('email'),'Facebook');
  			$this->networking_login('Facebook');
  			$this->Session->delete('Message.auth');
  			return false; //Must return true or will not save.
  	}
  	public function networking_login($netowork){
  		if ($this->Auth->login()) {
  			$this->Session->write('Auth.User.last_activity', time());
  			//pr($this->Session->read('Auth.User'));
  			/*$this->Session->setFlash(  __( 'Bienvenido.'), 'alert', array(
  				'plugin' => 'BoostCake',
  				'class' => 'alert-success'
  			));*/
  			$this->User->query("UPDATE `users` SET `session_counter`=`session_counter` + 1 WHERE `username`='{$this->Session->read('Auth.User.username')}'");
        return true;
  		}
  		else{
          return false;
  		}
  	}
}
