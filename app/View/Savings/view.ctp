<?php 
setlocale(LC_MONETARY, 'es_MX');
$bandera = ($this->request->data['User']['id'] == $this->request->data['sessionUser']['id'] || $this->request->data['sessionUser']['profile_id'] <= 1 ) ? true : false; 
?>
<h1 class="page-header">Detalle del Ahorro
							<div class="pull-right"><?php echo ( ($bandera) ? $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Registrar Deposito',
									array('controller' => 'deposits', 'action' => 'add',$this->request->data['Saving']['id'], 'full_base' => true),
									array( 'class' => 'btn btn-primary', 'escape' => false )
								) : ''); ?>
							</div>
</h1>
<dl class="dl-horizontal">
  <dt>Fecha:</dt>
  <dd><?php echo $this->request->data['Saving']['date']?></dd>
  <dt>De:</dt>
  <dd><?php echo $this->request->data['User']['full_name']?></dd>

  <dt>Comentarios:</dt>
  <dd><?php echo $this->request->data['Saving']['comments'];?></dd>
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
		foreach($this->request->data['Deposit'] as $deposit)
		{
			if($deposit['active'])
			{
				$total += $deposit['amount'];
				echo "<tr>";
					echo "<td style='text-align:right;'>".($bandera ? $this->Form->postLink(
								'<span class="glyphicon glyphicon-trash"></span>', 
								array('controller' => 'deposits','action' => 'delete', Set::classicExtract($deposit, 'id'), Set::classicExtract($this->request->data['Saving'], 'id')),
								array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
								__('¿Estas seguro de querer eliminar # %s?', Set::classicExtract($deposit, 'id'))
							):'')."</td>";
					echo "<td style='text-align:right'>{$deposit['id']}</td>";
					echo "<td style='text-align:right;white-space: nowrap;'>{$deposit['date']}</td>";
					echo "<td>{$deposit['comments']}</td>";
					echo "<td style='text-align:right;white-space: nowrap;'>".(money_format("%.2n",$deposit['amount']))."</td>";
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