<?php
    $this->extend('/Common/form');
   
	$this->assign('title','Registrar Deposito a Ahorro' );
    $this->start('body');
		echo '<div class="row">
			<div class="col-md-6">';
					echo $this->Form->input("Saving.user", array( 'value' => $saving['User']['full_name'], 'disabled' => true, 'label' => __('De'), 'class' => 'form-control') );
					echo $this->Form->input("Saving.comments", array( 'value' => $saving['Saving']['comments'], 'disabled' => true,  'label' => __('Comentarios'), 'class' => 'form-control' ) );
					echo "<label for=''>Fecha:</label>";
					echo "<div class='form-group'>
						<div class='input-group date' id='datetimepickerDate'>".
							$this->Form->input("Saving.date", array( 'type' => 'text', 'value' => $saving['Saving']['date'], 'disabled' => true,  'label' => false, 'class' => 'form-control datepicker', 'data-format' => 'DD/MM/YYYY' )  )
							."<span class='input-group-addon'><span class='glyphicon glyphicon-date'></span>
							</span>
						</div>
					</div>";
					$amountDeposit = 0.00;
					foreach($saving['Deposit'] as $deposit)
					{
						$amountDeposit += $deposit['amount'];
					}
					echo $this->Form->input("Saving.total_depositado", array( 'type' => 'number', 'value' => $amountDeposit, 'label' => array('class' =>'control-label'), 'disabled' => true, 'div' => array('class' =>'has-success'), 'class' => 'form-control' ) );
			echo '</div>';
			echo '<div class="col-md-6">';
					echo $this->JqueryValidation->input("Deposit.saving_id", array('type' => 'hidden', 'value' => $saving['Saving']['id']) );
					echo $this->JqueryValidation->input("Deposit.id", array() );
					echo "<label for=''>Fecha:</label>";
					echo "<div class='form-group'>
						<div class='input-group date' id='datetimepickerDate2'>".
							$this->JqueryValidation->input("Deposit.date", array( 'type' => 'text', 'placeholder' => __('Fecha'), 'label' => false, 'class' => 'form-control datepicker', 'data-format' => 'DD/MM/YYYY', 'default' => date("d/m/Y") )  )
							."<span class='input-group-addon'><span class='glyphicon glyphicon-date'></span>
							</span>
						</div>
					</div>";
					echo $this->JqueryValidation->input("Deposit.amount", array( 'type' => 'number', 'placeholder' => __('Monto'), 'label' => __('Monto'), 'class' => 'form-control' ) );
					echo $this->JqueryValidation->input("Deposit.comments", array( 'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control' ) );
			echo '</div>';
	
		echo '</div>';
	?>
	<script>
	$(document).ready(function() {
		$('#datetimepickerDate').datetimepicker({pickTime: false});
		$('#datetimepickerDate2').datetimepicker({pickTime: false});
	});
	
	</script>
	<?php
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Guardar') , array( 'type' => 'button', 'onClick' => 'if( (parseFloat($(\'#DepositAmount\').val()) + parseFloat($(\'#SavingTotalDepositado\').val()) ) < 0.00 ){ alert(\'El monto del retiro debe de ser menor o igual al total del prestamo, verifiquelo por favor.\'); $(\'#DepositAmount\').focus(); }else{ $(\'#DepositAddForm\').submit(); }', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
		echo $this->Html->script('moment2.min');
		echo $this->Html->script('bootstrap-datetimepicker.min', array( 'inline' => false ) );
		echo $this->Html->css('bootstrap-datetimepicker.min', array( 'inline' => false ) );
	$this->end();  

?>