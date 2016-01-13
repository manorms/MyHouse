<?php
App::uses('AppController', 'Controller');

class HousesController extends AppController {

	public function add()
	{
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			$this->House->create();
			if ( $this->House->saveAll( $this->request->data, array( 'deep' => true ) ) ) 
			{			 
			    $this->Session->setFlash(  __( 'House almacenado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				//$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El House no se ha almacenado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('action' => 'index'));
		}
		$this->request->data = $this->House->User->find('list');
	}
	
	public function edit( $id = null )
	{	
		$this->House->id = $id;
		if ( !$this->House->exists() ) throw new NotFoundException( __('House Invalido') );
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' ) ) 
		{
			if(isset($this->request->data['User']))
			{
				foreach($this->request->data['User'] as $key => $user)
				{
					if(!isset($user['user_id']) || $user['user_id'] == ''){
						@$this->House->HousesUser->deleteAll(array('HousesUser.user_id' => $user['user_id'],'HousesUser.house_id' => $id), false);
						unset($this->request->data['User'][$key]);
					}
				}
			}
			else
			{
				@$this->House->HousesUser->deleteAll(array('HousesUser.house_id' => $id), false);
			}
			
			if ( $this->House->saveAll( $this->request->data, array( 'deep' => true )  ) ) 
			{
				$this->Session->setFlash(  __( 'House actualizado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));				
			} 
			else
			{
				$this->Session->setFlash(  __( 'El House no se ha actualizado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('action' => 'index'));
		} 
		else 
			$this->request->data = $this->House->read( null, $id );
		$this->set(
				 array(
					'users' => $this->House->User->find('list')
				 )
			);
	}
	
	public function index( )
	{
		$this->request->data = $this->House->find( 'all' );
	}
	public function change_house( )
	{
		$this->Session->write('Auth.User.House',$this->request->data["idHouse"]);
		$this->Session->delete('Message.flash');
		die();
	}
}