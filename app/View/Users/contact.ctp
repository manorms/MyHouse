<?php
    $this->Html->addCrumb( $pluralName, "/users" );
    $this->Html->addCrumb( 'user');
    $this->extend('/Common/form');
    $this->assign('title','Contáctanos' );
    $this->set('width', '600px') ;
    $this->start('body');
		echo '<div class="alert alert-info alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Anónimo!</strong> Recuerda que si deseas que tu comentario sea anónimo sólo deja los campos Nombre y Email vacios.
		</div>';
        echo $this->Form->input("Contactus.name", array(  'placeholder' => __('Nombre'), 'label' => __('Nombre'), 'class' => 'form-control' ) );
        echo $this->Form->input("Contactus.email", array(  'placeholder' => __('Email'), 'label' => __('Email'), 'class' => 'form-control' ) );
        echo $this->Form->input("Contactus.comments", array( 'required' => 'required','type' => 'textarea', 'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control') );
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Send') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
	$this->end();    
?>