<?php
    $this->extend('/Common/form');
   
	$this->assign('title','Registrar Abono' );
    $this->start('body');
		echo '<div class="row">
			<div class="col-md-6">';
					echo $this->Form->input("Loan.lender", array( 'value' => $loan['Lender']['full_name'], 'disabled' => true, 'label' => __('De'), 'class' => 'form-control') );
					echo $this->Form->input("Loan.borrower", array( 'value' => $loan['Borrower']['full_name'], 'disabled' => true, 'label' => __('Para'), 'empty' => '--', 'class' => 'form-control') );
					echo $this->Form->input("Loan.description", array( 'value' => $loan['Loan']['description'], 'disabled' => true,  'label' => __('Descripción'), 'class' => 'form-control' ) );
					echo "<label for=''>Fecha:</label>";
					echo "<div class='form-group'>
						<div class='input-group date' id='datetimepickerDate'>".
							$this->Form->input("Loan.date", array( 'type' => 'text', 'value' => $loan['Loan']['date'], 'disabled' => true,  'label' => false, 'class' => 'form-control datepicker', 'data-format' => 'DD/MM/YYYY' )  )
							."<span class='input-group-addon'><span class='glyphicon glyphicon-date'></span>
							</span>
						</div>
					</div>";
					echo $this->Form->input("Loan.amount", array( 'type' => 'number', 'value' => $loan['Loan']['amount'], 'disabled' => true, 'label' => __('Cantidad'), 'class' => 'form-control' ) );
					$amountPayment = 0.00;
					foreach($loan['Payment'] as $payment)
					{
						$amountPayment += $payment['amount'];
					}
					echo $this->Form->input("Loan.total_dado", array( 'type' => 'number', 'value' => $amountPayment, 'label' => array('class' =>'control-label'), 'disabled' => true, 'div' => array('class' =>'has-success'), 'class' => 'form-control' ) );
					echo $this->Form->input("Loan.deuda_restante", array( 'type' => 'number', 'value' => $loan['Loan']['amount'] - $amountPayment, 'label' => array('class' =>'control-label'), 'div' => array('class' =>'has-error'), 'disabled' => true, 'class' => 'form-control' ) );
					echo $this->Form->input("Loan.comments", array( 'value' => $loan['Loan']['comments'], 'disabled' => true, 'label' => __('Comentarios'), 'class' => 'form-control' ) );
			echo '</div>';
			echo '<div class="col-md-6">';
					echo $this->JqueryValidation->input("Payment.loan_id", array('type' => 'hidden', 'value' => $loan['Loan']['id']) );
					echo $this->JqueryValidation->input("Payment.id", array() );
					echo "<label for=''>Fecha:</label>";
					echo "<div class='form-group'>
						<div class='input-group date' id='datetimepickerDate2'>".
							$this->JqueryValidation->input("Payment.date", array( 'type' => 'text', 'placeholder' => __('Fecha'), 'label' => false, 'class' => 'form-control datepicker', 'data-format' => 'DD/MM/YYYY', 'default' => date("d/m/Y") )  )
							."<span class='input-group-addon'><span class='glyphicon glyphicon-date'></span>
							</span>
						</div>
					</div>";
					echo $this->JqueryValidation->input("Payment.amount", array( 'type' => 'number', 'placeholder' => __('Monto'), 'label' => __('Monto'), 'class' => 'form-control' ) );
					echo $this->JqueryValidation->input("Payment.comments", array( 'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control' ) );
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
        echo $this->Form->button( __( 'Guardar') , array( 'type' => 'button', 'onClick' => 'if( parseFloat($(\'#PaymentAmount\').val()) > parseFloat($(\'#LoanDeudaRestante\').val()) ){ alert(\'El monto del abono debe de ser menor o igual a la deuda restanteen este prestamo, verifiquelo por favor.\'); $(\'#PaymentAmount\').focus(); }else{ $(\'#PaymentAddForm\').submit(); }', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
		echo $this->Html->script('moment2.min');
		echo $this->Html->script('bootstrap-datetimepicker.min', array( 'inline' => false ) );
		echo $this->Html->css('bootstrap-datetimepicker.min', array( 'inline' => false ) );
	$this->end();  

?>