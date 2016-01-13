<?php
App::uses('AppController', 'Controller');

class ServicesController extends AppController {

	public function add()
	{
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' )) {
			$this->Service->create();
			if ( $this->Service->save( $this->request->data ) ) 
			{			 
			    $this->Session->setFlash(  __( 'Servicio almacenado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));
				$this->redirect(array('action' => 'index'));				
			}
			else 
			{
				$this->Session->setFlash(  __( 'El Servicio no se ha almacenado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}	
		}
	}
	
	public function edit( $id = null )
	{	
		$this->Service->id = $id;
		if ( !$this->Service->exists() ) throw new NotFoundException( __('Servicio Invalido') );
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' ) ) 
		{
			if ( $this->Service->save( $this->request->data ) ) 
			{
				$this->Session->setFlash(  __( 'Servicio actualizado correctamente.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
				));				
			} 
			else
			{
				$this->Session->setFlash(  __( 'El Servicio no se ha actualizado, intente de nuevo.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
			}
			$this->redirect(array('action' => 'index'));
		} 
		else 
			$this->request->data = $this->Service->read( null, $id );
	}
	
	public function index( )
	{	
		$this->request->data = $this->Service->find( 'all' );
	}
	public function delete($id = null) 
	{
		$this->Service->id = $id;
		if (!$this->Service->exists()) throw new NotFoundException( __('Servicio invalido') );
		$this->Service->query("UPDATE `services` SET  `active` = 0 WHERE `id`=$id;");
		$this->Session->setFlash( __( 'El Servicio ha sido eliminado.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					));
        $this->redirect(array('action' => 'index'));		    
	}
}