<h1 class="page-header">Ahorros
							<div class="pull-right"><?php echo $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Nuevo',
									array('controller' => 'savings', 'action' => 'add', 'full_base' => true),
									array( 'class' => 'btn btn-primary', 'escape' => false )
								); ?>
							</div>
</h1>

<?php 
setlocale(LC_MONETARY, 'es_MX');
	echo "<table id='first-table' class='table table-hover table-condensed table-striped data-table2'>";
		echo "<caption><h3>Mis Ahorros</h3><a id='btn-table1' style='float:right;' class='btn btn-default'><span class='glyphicon glyphicon-chevron-down'></span> Show All</a></caption>";
		echo "<thead>";
			echo "<tr>";
				echo "<th style='width:50px;'>Opc</th>";
				echo "<th>#</th>";
				echo "<th>Fecha</th>";
				echo "<th>De</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Total</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		

		$totalDeposits = 0.00;
		foreach($savings as $saving)
		{
			$flagShow = false;
			$totalDeposit_p = 0.00;
			foreach($saving['Deposit'] as $deposit)
			{
				$totalDeposit_p += $deposit['amount'];
			}
			$flagShow = ($totalDeposit_p > 0);
			//$total += $loan['Loan']['amount'];
			echo "<tr class='".(!$flagShow ? "table1 hidden" : "")."'>";
				echo "<td style='text-align:right;min-width:82px;'><div class='btn-group'>".$this->Html->link(
							'<span class="glyphicon glyphicon-list-alt"></span>', 
							array('controller' => 'savings', 'action' => 'view', Set::classicExtract($saving['Saving'], 'id')),
							array( 'title' => 'Ver detalles', 'class' => 'btn btn-primary btn-xs', 'escape' => false )
						).$this->Html->link(
							'<span class="glyphicon glyphicon-edit"></span>', 
							array('controller' => 'deposits', 'action' => 'add', Set::classicExtract($saving['Saving'], 'id')),
							array( 'title' => 'Agregar deposito', 'class' => 'btn btn-primary btn-xs', 'escape' => false )
						).$this->Form->postLink(
							'<span class="glyphicon glyphicon-trash"></span>', 
							array('action' => 'delete', Set::classicExtract($saving['Saving'], 'id')),
							array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
							__('¿Estas seguro de querer eliminar # %s?', Set::classicExtract($saving['Saving'], 'id'))
						)."</div></td>";
				echo "<td style='text-align:right'>{$saving['Saving']['id']}</td>";
				echo "<td style='text-align:right;white-space: nowrap;'>{$saving['Saving']['date']}</td>";
				echo "<td>{$saving['User']['full_name']}</td>";
				echo "<td>{$saving['Saving']['comments']}</td>";
				
				$totalDeposit = 0.00;
				foreach($saving['Deposit'] as $deposit)
				{
					$totalDeposit += $deposit['amount'];
				}
				$totalDeposits += $totalDeposit;
				echo "<td style='text-align:right;white-space: nowrap;'>".(money_format("%.2n",$totalDeposit))."</td>";
			echo "</tr>";
		}
		echo "<tbody>";
		echo "<tfoot>";
			echo "<tr>";
			echo "<td colspan=6 style='text-align:right;white-space: nowrap;'>";
				echo "<label>Total: " . (money_format("%.2n",$totalDeposits)) ."</label>";
			echo "</td>";
			echo "</tr>";
		echo "</tfoot>";
	echo "</table>";
?>
<script>
$(document).ready(function() {
    $('.data-table2').dataTable( {
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false
    } );
	$('#btn-table1').on('click', function(){
		if($(".table1").hasClass("hidden")){
			$(".table1").removeClass("hidden");
			$('#btn-table1').html("<span class='glyphicon glyphicon-chevron-up'></span> Hide Paid");
		}
		else{
			$(".table1").addClass("hidden");
			$('#btn-table1').html("<span class='glyphicon glyphicon-chevron-down'></span> Show All");
		}
	});
	$('#btn-table2').on('click', function(){
		if($(".table2").hasClass("hidden")){
			$(".table2").removeClass("hidden");
			$('#btn-table2').html("<span class='glyphicon glyphicon-chevron-up'></span> Hide Paid");
		}
		else{
			$(".table2").addClass("hidden");
			$('#btn-table2').html("<span class='glyphicon glyphicon-chevron-down'></span> Show All");
		}
	});
} );
</script>