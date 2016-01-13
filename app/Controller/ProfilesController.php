<?php
App::uses('AppController', 'Controller');

class ProfilesController extends AppController {

	public function add()
	{
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			$this->Profile->create();
			if ( $this->Profile->save( $this->request->data ) ) 
			{			 
			    $this->Session->setFlash(  __( 'Perfil almacenado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El Perfil no se ha almacenado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}	
		}
	}
	
	public function edit( $id = null )
	{	
		$this->Profile->id = $id;
		if ( !$this->Profile->exists() ) throw new NotFoundException( __('Perfil Invalido') );
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' ) ) 
		{
			if ( $this->Profile->save( $this->request->data ) ) 
			{
				$this->Session->setFlash(  __( 'Perfil actualizado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));				
			} 
			else
			{
				$this->Session->setFlash(  __( 'El Perfil no se ha actualizado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('action' => 'index'));
		} 
		else 
			$this->request->data = $this->Profile->read( null, $id );
	}
	
	public function index( )
	{	
		$this->request->data = $this->Profile->find( 'all' );
	}
	public function delete($id = null) 
	{
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) throw new NotFoundException( __('Perfil invalido') );
		$this->Profile->query("UPDATE `profiles` SET  `active` = 0 WHERE `id`=$id;");
		$this->Session->setFlash( __( 'El Perfil ha sido eliminado.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
        $this->redirect(array('action' => 'index'));		    
	}
}