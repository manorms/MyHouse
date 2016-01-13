<?php
    $this->extend('/Common/form');
   
	$this->assign('title','Registrar Prestamo' );
    $this->start('body');
		echo '<div class="row">
			<div class="col-md-12">';
					echo $this->JqueryValidation->input("Loan.id", array() );
					echo $this->JqueryValidation->input("Loan.lender_id", array( 'type' => ( ($sessionUser['profile_id'] > 1) ? 'hidden' : 'select'), 'label' => __('De'), 'value' => $sessionUser['id'], 'class' => 'form-control') );
					echo $this->JqueryValidation->input("Loan.borrower_id", array( 'label' => __('Para'), 'empty' => '--', 'class' => 'form-control') );
					echo $this->JqueryValidation->input("Loan.description", array( 'placeholder' => __('Descripción'), 'label' => __('Descripción'), 'class' => 'form-control' ) );
					echo "<label for=''>Fecha:</label>";
					echo "<div class='form-group'>
						<div class='input-group date' id='datetimepickerDate'>".
							$this->JqueryValidation->input("Loan.date", array( 'type' => 'text', 'placeholder' => __('Fecha'), 'label' => false, 'class' => 'form-control datepicker', 'data-format' => 'DD/MM/YYYY', 'default' => date("d/m/Y") )  )
							."<span class='input-group-addon'><span class='glyphicon glyphicon-date'></span>
							</span>
						</div>
					</div>";
					echo $this->JqueryValidation->input("Loan.amount", array( 'type' => 'number', 'placeholder' => __('Total'), 'label' => __('Total'), 'class' => 'form-control' ) );
					echo $this->JqueryValidation->input("Loan.comments", array( 'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control' ) );
			echo '</div>';
	
		echo '</div>';
	?>
	<script>
	$(document).ready(function() {
		$('#datetimepickerDate').datetimepicker({pickTime: false});
	});
	
	</script>
	<?php
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Guardar') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
		echo $this->Html->script('moment2.min');
		echo $this->Html->script('bootstrap-datetimepicker.min', array( 'inline' => false ) );
		echo $this->Html->css('bootstrap-datetimepicker.min', array( 'inline' => false ) );
	$this->end();  

?>