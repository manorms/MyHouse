<?php 
setlocale(LC_MONETARY, 'es_MX');
$bandera = ($this->request->data['Lender']['id'] == $this->request->data['sessionUser']['id'] || $this->request->data['sessionUser']['profile_id'] <= 1 ) ? true : false; 
?>
<h1 class="page-header">Detalle de prestamo
							<div class="pull-right"><?php echo ( ($bandera) ? $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Registrar Abono',
									array('controller' => 'payments', 'action' => 'add',$this->request->data['Loan']['id'], 'full_base' => true),
									array( 'class' => 'btn btn-primary', 'escape' => false )
								) : ''); ?>
							</div>
</h1>
<dl class="dl-horizontal">
  <dt>Descripción:</dt>
  <dd><?php echo $this->request->data['Loan']['description']?></dd>
  <dt>Fecha:</dt>
  <dd><?php echo $this->request->data['Loan']['date']?></dd>
  <dt>Prestamista:</dt>
  <dd><?php echo $this->request->data['Lender']['full_name']?></dd>
  <dt>Prestatario:</dt>
  <dd><?php echo $this->request->data['Borrower']['full_name']?></dd>
  <dt>Cantidad:</dt>
  <dd><?php echo money_format("%.2n",$this->request->data['Loan']['amount']);?></dd>
  <dt>Comentarios:</dt>
  <dd><?php echo $this->request->data['Loan']['comments'];?></dd>
</dl>

<?php
	echo "<table class='table table-hover table-condensed table-striped data-table2'>";
		echo "<caption><h3>Abonos</h3></caption>";
		echo "<thead>";
			echo "<tr>";
				echo "<th style='width:50px;'>Opc</th>";
				echo "<th>#</th>";
				echo "<th>Fecha</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Cantidad</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$total = 0.00;
		foreach($this->request->data['Payment'] as $payment)
		{
			if($payment['active'])
			{
				$total += $payment['amount'];
				echo "<tr>";
					echo "<td style='text-align:right;'>".($bandera ? $this->Form->postLink(
								'<span class="glyphicon glyphicon-trash"></span>', 
								array('controller' => 'payments','action' => 'delete', Set::classicExtract($payment, 'id'), Set::classicExtract($this->request->data['Loan'], 'id')),
								array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
								__('¿Estas seguro de querer eliminar # %s?', Set::classicExtract($payment, 'id'))
							):'')."</td>";
					echo "<td style='text-align:right'>{$payment['id']}</td>";
					echo "<td style='text-align:right;white-space: nowrap;'>{$payment['date']}</td>";
					echo "<td>{$payment['comments']}</td>";
					echo "<td style='text-align:right;white-space: nowrap;'>".(money_format("%.2n",$payment['amount']))."</td>";
				echo "</tr>";
			}
		}
		echo "<tbody>";
		echo "<tfoot>";
			echo "<tr>";
			echo "<td colspan=5 style='text-align:right;white-space: nowrap;'>";
				echo "<label>Total de abonos: " . (money_format("%.2n",$total)) ."</label>";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan=5 style='text-align:right;white-space: nowrap;'>";
				echo "<label>Total de adeudo: " . (money_format("%.2n",($this->request->data['Loan']['amount'] - $total))) ."</label>";
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
} );
</script>