<?php
    $this->extend('/Common/form');
    $this->assign('title','Cambio de Password' );
    $this->set('width', '600px') ;
    $this->start('body');
    		echo $this->JqueryValidation->input( 'User.old_password', array( 'type' => 'password','label' => __('Password'), 'value' => '', 'class' => 'form-control' ) );
    		echo $this->JqueryValidation->input( 'User.password', array( 'label' => __('Password Nuevo'), 'value' => '', 'class' => 'form-control' ) );
            echo $this->JqueryValidation->input( 'User.confirm_password', array( 'type' => 'password', 'label' => __('Repetir'), 'value' => '', 'class' => 'form-control' ) );
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Cambiar') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
	$this->end();    
?>