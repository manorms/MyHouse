<?php
    $this->extend('/Common/form');
    $this->assign('title','¿Olvido su Password?' );
    $this->set('width', '600px') ;
    $this->start('body');
	echo'
		<label for="">Username</label>
		<div class="input-group">
		  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>'.
		  $this->Form->input("User.username", array(  'placeholder' => __('Username'), 'label' => false, 'class' => 'form-control' ) )
		.'</div>';
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Solicitar Nuevo') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
	$this->end();    
?>