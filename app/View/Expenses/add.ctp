<?php
    $this->extend('/Common/form');
   
	if($sessionHouse != "")
	{
	$this->assign('title','Agregar Gasto' );
    $this->start('body');
		echo '<div class="row">
			<div class="col-md-6">
				<fieldset >
					<legend>Información del Gasto <div class="pull-right">Template: '.$this->Form->input("Template.service_id", array('empty' => '--', 'class' => 'custom-form-control', 'options' => $services, 'label' => false, 'div' => false)).'</div></legend>';
					echo $this->Form->input("Template.house_id", array( 'value' => $sessionHouse, 'class' => 'form-control', 'disabled' => 'disabled'  ) );
					echo $this->JqueryValidation->input("Expense.id", array() );
					echo $this->JqueryValidation->input("Expense.house_id", array( 'type' => 'hidden', 'value' => $sessionHouse  ) );
					echo $this->JqueryValidation->input("Expense.user_id", array( 'type' => ( ($sessionUser['profile_id'] > 1) ? 'hidden' : 'select'), 'value' => $sessionUser['id'], 'class' => 'form-control') );
					echo $this->JqueryValidation->input("Expense.description", array( 'placeholder' => __('Descripción'), 'label' => __('Descripción'), 'class' => 'form-control' ) );
					echo "<label for=''>Fecha:</label>";
					echo "<div class='form-group'>
						<div class='input-group date' id='datetimepickerDate'>".
							$this->JqueryValidation->input("Expense.date", array( 'type' => 'text', 'placeholder' => __('Fecha'), 'label' => false, 'class' => 'form-control datepicker', 'data-format' => 'DD/MM/YYYY', 'default' => date("d/m/Y") )  )
							."<span class='input-group-addon'><span class='glyphicon glyphicon-date'></span>
							</span>
						</div>
					</div>";
					echo $this->JqueryValidation->input("Expense.amount", array( 'type' => 'number', 'placeholder' => __('Total'), 'label' => __('Total'), 'class' => 'form-control' ) );
					echo $this->JqueryValidation->input("Expense.comments", array( 'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control' ) );
				echo '</fieldset>';
			echo '</div>';
			echo '<div class="col-md-6">
				<fieldset >
					<legend>Usuarios</legend>';
			?>
						<table class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th></th>
									<th>Name</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
			<?php
							foreach($users as $key => $user){
								echo '<tr>';
									echo '<td>'.$this->Form->checkbox("Perro.{$key}.user_id", array('hiddenField' => false, 'class' => 'usersC', 'value'=>$key)).'</td>';
									echo '<td><label style="font-weight:normal;" for="Perro'.$key.'UserId">'.$user.'</label></td>';
									echo '<td style="text-align:right;"><label id="User'.$key.'Amount" class="usersAmount">$ 0.00</label></td>';
								echo '</tr>';
							}
			?>				
							</tbody>
							<tfoot>
								<td colspan=3 style="text-align:right;"><label id="lAmount">Total: $ 0.00</label></td>
							</tfoot>
						</table>
			<?php
			echo '</div>';		
		echo '</div>';
	?>
	<script>
	$(document).ready(function() {
		function computeAmount()
		{
			$("label[class=usersAmount]").text("$ 0.00");
			$("#lAmount").text("$ 0.00");
			$("button[type=submit]").prop("disabled", true);
			var count = $('input[type=checkbox][class=usersC]:checked').size();
			if(count > 0 )
			{
				if(count > 0 && $.isNumeric($("#ExpenseAmount").val()) && $("#ExpenseAmount").val() > 0) $("button[type=submit]").prop("disabled", false);
				$("input[type=checkbox][class=usersC]:checked").each( 
					function() { 
						var amount = $("#ExpenseAmount").val();
						var userAmount = (amount / count).toFixed(2);
						$("#User" + $(this).val() + "Amount").text("$ " + userAmount);
						$("#ExpenseAmount").val( (userAmount * count).toFixed(2) );
						$("#lAmount").text("Total: $ " + (userAmount * count).toFixed(2) );
					} 
				);
			}
		};
	
		$("#ExpenseAmount").on("change", function(){
			computeAmount();
		});
		$(".usersC").on("change", function(){
			computeAmount();
		});

		$("#TemplateServiceId").on('change', function (){
			if($("#TemplateServiceId").val() > 0)
			{
				$.ajax({
					url: '<?php echo $this->Html->url( array( "controller" => "expenses", "action" => "change_template" ) )?>',
					type:'post',
					data: { idService: $('#TemplateServiceId').val() },
					beforeSend:function(request) {
						$("#gLoading").removeClass("hide");
					},
					complete:function(request, json) {
						//location.reload();
						var service = JSON.parse(request.responseText);
						$("#ExpenseDescription").val(service.name);
						$("#ExpenseAmount").val(service.amount);
						$("#ExpenseComments").val(service.comments);
						$("#gLoading").addClass("hide");
					}							
				});
			}
			else
			{
				$("#ExpenseDescription").val("");
				$("#ExpenseAmount").val("");
				$("#ExpenseComments").val("");
			}
		});
		$('#datetimepickerDate').datetimepicker({pickTime: false});
	});
	
	</script>
	<?php
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Guardar') , array( 'type' => 'submit', 'disabled' => true, 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
		echo $this->Html->script('moment2.min');
		echo $this->Html->script('bootstrap-datetimepicker.min', array( 'inline' => false ) );
		echo $this->Html->css('bootstrap-datetimepicker.min', array( 'inline' => false ) );
	$this->end();  
	}
?>