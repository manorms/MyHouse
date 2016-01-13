<h1 class="page-header">Gastos
							<div class="pull-right"><?php echo $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Nuevo',
									array('controller' => 'expenses', 'action' => 'add', 'full_base' => true),
									array( 'class' => 'btn btn-primary', 'escape' => false )
								); ?>
							</div>
</h1>

<?php
setlocale(LC_MONETARY, 'es_MX');
	echo "<table class='table table-hover table-condensed table-striped data-table2'>";
		echo "<caption><h3>Mis Gastos</h3></caption>";
		echo "<thead>";
			echo "<tr>";
				echo "<th style='width:50px;'>Opc</th>";
				echo "<th>#</th>";
				echo "<th>Fecha</th>";
				echo "<th>Descripción</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Total</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$total = 0.00;
		foreach($myExpenses as $expense)
		{
			$total += $expense['Expense']['amount'];
			echo "<tr>";
				echo "<td style='text-align:right'>".$this->Form->postLink(
							'<span class="glyphicon glyphicon-trash"></span>', 
							array('action' => 'delete', Set::classicExtract($expense['Expense'], 'id')),
							array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
							__('¿Estas seguro de querer eliminar # %s?', Set::classicExtract($expense['Expense'], 'id'))
						)."</td>";
				echo "<td style='text-align:right'>{$expense['Expense']['id']}</td>";
				echo "<td style='text-align:right;white-space: nowrap;'>{$expense['Expense']['date']}</td>";
				echo "<td>{$expense['Expense']['description']}</td>";
				echo "<td>{$expense['Expense']['comments']}</td>";
				echo "<td style='text-align:right;white-space: nowrap;'>".(money_format("%.2n",$expense['Expense']['amount']))."</td>";
			echo "</tr>";
		}
		echo "<tbody>";
		echo "<tfoot>";
			echo "<tr>";
			echo "<td colspan=6 style='text-align:right;white-space: nowrap;'>";
				echo "<label>Total: " . (money_format("%.2n",$total)) ."</label>";
			echo "</td>";
			echo "</tr>";
		echo "</tfoot>";
	echo "</table>";
?>
<br />
<?php

	echo "<table class='table table-hover table-condensed table-striped data-table2'>";
		echo "<caption><h3>Mi parte de Gastos</h3></caption>";
		echo "<thead>";
			echo "<tr>";
				echo "<th>#</th>";
				echo "<th>Fecha</th>";
				echo "<th>Descripción</th>";
				echo "<th>Pagó</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Usuarios</th>";
				echo "<th>Total</th>";
				echo "<th>Mi Parte</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$total2 = 0.00;
		$myTotal = 0.00;
		foreach($yourExpenses as $expense)
		{
			$total2 += $expense['Expense']['amount'];
			$myTotal += ($expense['Expense']['amount']/count($expense['Perro']));
			echo "<tr>";
				echo "<td style='text-align:right'>{$expense['Expense']['id']}</td>";
				echo "<td style='text-align:right;white-space: nowrap;'>{$expense['Expense']['date']}</td>";
				echo "<td>{$expense['Expense']['description']}</td>";
				echo "<td>{$expense['Buyer']['full_name']}</td>";
				echo "<td>{$expense['Expense']['comments']}</td>";
				echo "<td style='text-align:right;white-space: nowrap;'>".count($expense['Perro'])."</td>";
				echo "<td style='text-align:right;white-space: nowrap;'>".(money_format("%.2n",$expense['Expense']['amount']))."</td>";
				echo "<td style='text-align:right;white-space: nowrap;'>".(money_format("%.2n",($expense['Expense']['amount']/count($expense['Perro']))))."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "<tfoot>";
			echo "<tr>";
			echo "<td colspan=7 style='text-align:right;white-space: nowrap;'>";
				echo "<label>Total: " . (money_format("%.2n",$total2)) . "</label>";
			echo "</td>";
			echo "<td style='text-align:right;white-space: nowrap;'>";
				echo "<label>Mi Total: " . (money_format("%.2n",$myTotal)) . "</label>";
			echo "</td>";
			echo "</tr>";
		echo "</tfoot>";
	echo "</table>";
?>
<br />
<center>
<div class="panel panel-primary" style="width:40%;font-size: 12pt;">
  <!-- Default panel contents -->
  <div class="panel-heading" style="text-align:left;">Resumen</div>

  <!-- Table -->
	<table class="table">
		<tr>
			<th>Mis Gastos</th>
			<td class="bg-success" style="text-align:right;white-space: nowrap;"><?php echo money_format("%.2n",$total); ?></td>
		</tr>
		<tr>
			<th>Mi Parte</th>
			<td class="bg-warning" style="text-align:right;white-space: nowrap;"><?php echo money_format("%.2n",$myTotal); ?></td>
		</tr>
		<tr>
			<th>Resultado</th>
			<th class="<?php echo (($total - $myTotal) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:right;white-space: nowrap;"><?php echo money_format("%.2n",($total - $myTotal)); ?></th>
		</tr>
	</table>
</div>
</center>
<script>
$(document).ready(function() {
    $('.data-table2').dataTable( {
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false
    } );
} );
</script>