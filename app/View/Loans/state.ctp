<?php
    $this->extend('/Common/form');
   
	$this->assign('title','Solicitud Estado de Cuenta (Prestamos)' );
    $this->start('body');
		echo '<div class="row">
			<div class="col-md-12">';
					echo $this->JqueryValidation->input("Loan.lender_id", array( 'type' => 'select', 'label' => __('Usuario'), 'value' => $sessionUser['id'], 'class' => 'form-control', 'disabled' => ($sessionUser['profile_id'] > 1) ));
					echo ($sessionUser['profile_id'] == 1) ? '' : $this->JqueryValidation->input("Loan.lender_id", array( 'type' => 'hidden', 'value' => $sessionUser['id'], 'class' => 'form-control' ));
			echo '</div>';
	
		echo '</div>';
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Enviar') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
	$this->end();  

?>