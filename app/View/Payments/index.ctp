<h1 class="page-header">Presamos
							<div class="pull-right"><?php echo $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Nuevo',
									array('controller' => 'loans', 'action' => 'add', 'full_base' => true),
									array( 'class' => 'btn btn-primary', 'escape' => false )
								); ?>
							</div>
</h1>

<?php
setlocale(LC_MONETARY, 'es_MX');
	echo "<table class='table table-hover table-condensed table-striped data-table2'>";
		echo "<caption><h3>Presamos Dados</h3></caption>";
		echo "<thead>";
			echo "<tr>";
				echo "<th style='width:50px;'>Opc</th>";
				echo "<th>#</th>";
				echo "<th>Fecha</th>";
				echo "<th>Descripción</th>";
				echo "<th>Para</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Total</th>";
				echo "<th>Abono Total</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$total = 0.00;
		$totalPayments = 0.00;
		foreach($myLoans as $loan)
		{
			$total += $loan['Loan']['amount'];
			echo "<tr>";
				echo "<td style='text-align:right'>".$this->Form->postLink(
							'<span class="glyphicon glyphicon-trash"></span>', 
							array('action' => 'delete', Set::classicExtract($loan['Loan'], 'id')),
							array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
							__('¿Estas seguro de querer eliminar # %s?', Set::classicExtract($loan['Loan'], 'id'))
						)."</td>";
				echo "<td style='text-align:right'>{$loan['Loan']['id']}</td>";
				echo "<td style='text-align:right'>{$loan['Loan']['date']}</td>";
				echo "<td>{$loan['Loan']['description']}</td>";
				echo "<td>{$loan['Borrower']['full_name']}</td>";
				echo "<td>{$loan['Loan']['comments']}</td>";
				echo "<td style='text-align:right'>".(money_format("%.2n",$loan['Loan']['amount']))."</td>";
				$totalPayment = 0.00;
				foreach($loan['Payment'] as $payment)
				{
					$totalPayment += $payment['amount'];
				}
				$totalPayments += $totalPayment;
				echo "<td style='text-align:right'>".(money_format("%.2n",$totalPayment))."</td>";
			echo "</tr>";
		}
		echo "<tbody>";
		echo "<tfoot>";
			echo "<tr>";
			echo "<td colspan=7 style='text-align:right;'>";
				echo "<label>Total: " . (money_format("%.2n",$total)) ."</label>";
			echo "</td>";
			echo "<td style='text-align:right;'>";
				echo "<label>Total: " . (money_format("%.2n",$totalPayments)) ."</label>";
			echo "</td>";
			echo "</tr>";
		echo "</tfoot>";
	echo "</table>";
?>
<br />
<?php
	echo "<table class='table table-hover table-condensed table-striped data-table2'>";
		echo "<caption><h3>Presamos Recibidos</h3></caption>";
		echo "<thead>";
			echo "<tr>";
				echo "<th style='width:50px;'>Opc</th>";
				echo "<th>#</th>";
				echo "<th>Fecha</th>";
				echo "<th>Descripción</th>";
				echo "<th>De</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Total</th>";
				echo "<th>Abono Total</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$total2 = 0.00;
		$totalPayments2 = 0.00;
		foreach($yourLoans as $loan)
		{
			$total2 += $loan['Loan']['amount'];
			echo "<tr>";
				echo "<td style='text-align:right'>".$this->Form->postLink(
							'<span class="glyphicon glyphicon-trash"></span>', 
							array('action' => 'delete', Set::classicExtract($loan['Loan'], 'id')),
							array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
							__('¿Estas seguro de querer eliminar # %s?', Set::classicExtract($loan['Loan'], 'id'))
						)."</td>";
				echo "<td style='text-align:right'>{$loan['Loan']['id']}</td>";
				echo "<td style='text-align:right'>{$loan['Loan']['date']}</td>";
				echo "<td>{$loan['Loan']['description']}</td>";
				echo "<td>{$loan['Lender']['full_name']}</td>";
				echo "<td>{$loan['Loan']['comments']}</td>";
				echo "<td style='text-align:right'>".(money_format("%.2n",$loan['Loan']['amount']))."</td>";
				$totalPayment = 0.00;
				foreach($loan['Payment'] as $payment)
				{
					$totalPayment += $payment['amount'];
				}
				$totalPayments2 += $totalPayment;
				echo "<td style='text-align:right'>".(money_format("%.2n",$totalPayment))."</td>";
			echo "</tr>";
		}
		echo "<tbody>";
		echo "<tfoot>";
			echo "<tr>";
			echo "<td colspan=7 style='text-align:right;'>";
				echo "<label>Total: " . (money_format("%.2n",$total2)) ."</label>";
			echo "</td>";
			echo "<td style='text-align:right;'>";
				echo "<label>Total: " . (money_format("%.2n",$totalPayments2)) ."</label>";
			echo "</td>";
			echo "</tr>";
		echo "</tfoot>";
	echo "</table>";
?>
<br />
<center>
<div class="panel panel-primary" style="width:60%;font-size: 12pt;">
  <!-- Default panel contents -->
  <div class="panel-heading" style="text-align:left;">Resumen</div>

  <!-- Table -->
	<table class="table">
		<tr>
			<th>Presamos Dados</th>
			<td class="bg-success" style="text-align:right;"><?php echo money_format("%.2n",$total); ?></td>
			<th>Presamos Recibidos</th>
			<td class="bg-success" style="text-align:right;"><?php echo money_format("%.2n",$total2); ?></td>
		</tr>
		<tr>
			<th>Abonos Recibidos</th>
			<td class="bg-warning" style="text-align:right;"><?php echo money_format("%.2n",$totalPayments); ?></td>
			<th>Abonos Dados</th>
			<td class="bg-warning" style="text-align:right;"><?php echo money_format("%.2n",$totalPayments2); ?></td>
		</tr>
		<tr>
			<th>Me deben</th>
			<th class="<?php echo (($total - $totalPayments) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:right;"><?php echo money_format("%.2n",($total - $totalPayments)); ?></th>
			<th>Debo</th>
			<th class="<?php echo (($total2 - $totalPayments2) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:right;"><?php echo money_format("%.2n",($total2 - $totalPayments2)); ?></th>
		</tr>
		<tr>
			<th colspan=4  class="<?php echo (($total - $totalPayments) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:center;">Resultado : <?php echo money_format("%.2n",(($total - $totalPayments) - ($total2 - $totalPayments2))); ?></th>
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