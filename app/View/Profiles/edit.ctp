<?php
    $this->Html->addCrumb( $pluralName, "/Profiles" );
    $this->Html->addCrumb( 'Edit Profile');
    $this->extend('/Common/form');
    $this->assign('title','Editar Perfil' );
    $this->set('width', '600px') ;
    $this->start('body');		
        echo $this->Form->input("Profile.name", array(  'placeholder' => __('Nombre'), 'label' => __('Nombre'), 'class' => 'form-control' ) );
        echo $this->Form->input("Profile.comments", array(  'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control') );
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Guardar') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
	$this->end();    
?>