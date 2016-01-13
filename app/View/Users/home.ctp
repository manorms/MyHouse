<?php setlocale(LC_MONETARY, 'es_MX'); ?>

<h2 class="page-header">Gastos</h2>
<center>
<div class="panel panel-primary" style="width:40%;font-size: 12pt;">
  <!-- Default panel contents -->
  <div class="panel-heading" style="text-align:left;">Resumen Gastos</div>

  <!-- Table -->
	<table class="table">
		<tr>
			<th>Mis Gastos</th>
			<td class="bg-success" style="text-align:right;"><?php echo money_format("%.2n",$total); ?></td>
		</tr>
		<tr>
			<th>Mi Parte</th>
			<td class="bg-warning" style="text-align:right;"><?php echo money_format("%.2n",$myTotal); ?></td>
		</tr>
		<tr>
			<th>Resultado</th>
			<th class="<?php echo (($total - $myTotal) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:right;"><?php echo money_format("%.2n",($total - $myTotal)); ?></th>
		</tr>
	</table>
</div>
</center>
<h2 class="page-header">Prestamos</h2>
<center>
<div class="panel panel-primary" style="width:60%;font-size: 12pt;">
  <!-- Default panel contents -->
  <div class="panel-heading" style="text-align:left;">Resumen</div>

  <!-- Table -->
	<table class="table">
		<tr>
			<th>Presamos Dados</th>
			<td class="bg-success" style="text-align:right;"><?php echo money_format("%.2n",$totalP); ?></td>
			<th>Presamos Recibidos</th>
			<td class="bg-success" style="text-align:right;"><?php echo money_format("%.2n",$total2P); ?></td>
		</tr>
		<tr>
			<th>Abonos Recibidos</th>
			<td class="bg-warning" style="text-align:right;"><?php echo money_format("%.2n",$totalPaymentsP); ?></td>
			<th>Abonos Dados</th>
			<td class="bg-warning" style="text-align:right;"><?php echo money_format("%.2n",$totalPayments2P); ?></td>
		</tr>
		<tr>
			<th>Me deben</th>
			<th class="<?php echo (($totalP - $totalPaymentsP) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:right;"><?php echo money_format("%.2n",($totalP - $totalPaymentsP)); ?></th>
			<th>Debo</th>
			<th class="<?php echo (($total2P - $totalPayments2P) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:right;"><?php echo money_format("%.2n",($total2P - $totalPayments2P)); ?></th>
		</tr>
		<tr>
			<th colspan=4  class="<?php echo (((($totalP - $totalPaymentsP) - ($total2P - $totalPayments2P))) >=0 ) ? "bg-success" : "bg-danger" ; ?>" style="text-align:center;">Resultado : <?php echo money_format("%.2n",(($totalP - $totalPaymentsP) - ($total2P - $totalPayments2P))); ?></th>
		</tr>
	</table>
</div>
</center>
