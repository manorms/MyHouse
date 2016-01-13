<?php
    $this->extend('/Common/form');
    $this->assign('title','Editar Servicio' );
    $this->start('body');		
        echo $this->Form->input("Service.name", array(  'placeholder' => __('Nombre'), 'label' => __('Nombre'), 'class' => 'form-control' ) );
        echo $this->Form->input("Service.amount", array(  'placeholder' => __('Total'), 'label' => __('Total'), 'class' => 'form-control' ) );
        echo $this->Form->input("Service.comments", array(  'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control') );
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Guardar') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
	$this->end();    
?>