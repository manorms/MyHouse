<div style='box-sizing: border-box;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 10pt;line-height: 1.42857;color: #333;'>
	<p class=MsoNormal style='text-align:justify;line-height:normal;background:white'>
		<span style='font-size:12.0pt;font-family:"Arial","sans-serif";color:#222222'>
			<b><?php echo $this->request->data['nameFrom']; ?></b>: Solicitud estado de cuenta <a href="<?php echo URL_SYSTEM; ?>"><?php echo NAME_SYSTEM; ?></a>.
		</span>
	</p>
<?php
setlocale(LC_MONETARY, 'es_MX');


$totales = array('myLoans' => array(0.00,0.00), 'yourLoans' => array(0.00,0.00));
foreach ($this->request->data['arrays_t'] as $key => $arrays) {
	$totales[$key] = array(0.00,0.00);
	echo (($key=='myLoans')?'':'<br/>')."<hr></hr><center><h1>".(($key=='myLoans')?'PRESTAMOS':'ADEUDOS')."</h1></center><hr></hr>";
	echo ( (count($arrays)) ? '' : '<center><h3>NO TIENES '.(($key=='myLoans')?'PRESTAMOS':'ADEUDOS').' REGISTRADOS</h3></center>' );
	foreach ($arrays as $key2 => $array) {
		echo '<h2 style="padding-bottom: 9px;margin: 40px 0px 20px;border-bottom: 1px solid #EEE;">'.(($key=='myLoans')?'Resumen de Prestamo '.($key2+1):'Resumen de Adeudo '.($key2+1)).'</h2>';



//$bandera = ($array['Lender']['id'] == $this->request->data['sessionUser']['id'] || $this->request->data['sessionUser']['profile_id'] <= 1 ) ? true : false;
?>
<table style="width: 100%; max-width: 100%; background-color: transparent;border-spacing: 0px;">
	<thead>
		<tr>
			<th style="padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;">Descripción</th>
			<th style="padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;">Fecha</th>
			<th style="padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;">Prestamista</th>
			<th style="padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;">Prestatario</th>
			<th style="padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;">Comentarios</th>
			<th style="padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;">Cantidad</th>
		</tr>
	</thead>
	<tbody>
		<tr style="background-color: #E2E4FF;">
			<td style="padding: 5px 10px 5px 10px;"><?php echo $array['Loan']['description']?></td>
			<td style="padding: 5px 10px 5px 10px;text-align:right;"><?php echo $array['Loan']['date']?></td>
			<td style="padding: 5px 10px 5px 10px;"><?php echo $array['Lender']['full_name']?></td>
			<td style="padding: 5px 10px 5px 10px;"><?php echo $array['Borrower']['full_name']?></td>
			<td style="padding: 5px 10px 5px 10px;"><?php echo $array['Loan']['comments'];?></td>
			<td style="padding: 5px 10px 5px 10px;text-align:right;white-space: nowrap;"><?php echo money_format("%.2n",$array['Loan']['amount']);?></td>
		</tr>
	</tbody>
</table>

<?php
	echo "<table  style='width: 100%; max-width: 100%; background-color: transparent;border-spacing: 0px;'>";
		echo "<caption><h3>Abonos</h3></caption>";
		echo "<thead>";
			echo "<tr>";
				echo "<th style='padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;'>Fecha</th>";
				echo "<th style='padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;'>Comentarios</th>";
				echo "<th style='padding: 3px 18px 3px 10px;border-bottom: 1px solid #000;font-weight: bold;'>Cantidad</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$total = 0.00;
		foreach($array['Payment'] as $payment)
		{
			if($payment['active'])
			{
				@$color = ($color == "#FFF")?"#F9F9F9":"#FFF";
				$total += $payment['amount'];
				echo "<tr style='background-color: ".$color.";'>";
					echo "<td style='vertical-align: top;border-top: 1px solid #DDD;padding: 5px 10px 5px 10px;text-align:right;white-space: nowrap;'>{$payment['date']}</td>";
					echo "<td style='vertical-align: top;border-top: 1px solid #DDD;padding: 5px 10px 5px 10px;'>{$payment['comments']}</td>";
					echo "<td style='vertical-align: top;border-top: 1px solid #DDD;padding: 5px 10px 5px 10px;text-align:right;white-space: nowrap;'>".(money_format("%.2n",$payment['amount']))."</td>";
				echo "</tr>";
			}
		}
		echo "<tbody>";
		echo "<tfoot>";
			echo "<tr>";
			echo "<td colspan=5 style='vertical-align: top;border-top: 1px solid #DDD;text-align:right;white-space: nowrap;padding: 5px 10px 5px 10px;'>";
				echo "<label>Total de abonos: <b>" . (money_format("%.2n",$total)) ."</b></label>";
				$totales[$key][0] += $total;
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan=5 style='vertical-align: top;border-top: 1px solid #DDD;text-align:right;white-space: nowrap;padding: 5px 10px 5px 10px;'>";
				echo "<label>Total de adeudo: <b>" . (money_format("%.2n",($array['Loan']['amount'] - $total))) ."</b></label>";
				$totales[$key][1] += ($array['Loan']['amount'] - $total);
			echo "</td>";
			echo "</tr>";
		echo "</tfoot>";
	echo "</table>";
}

}
	?>
	<br/><hr></hr><center><h1>RESUMEN GENERAL</h1></center><hr></hr>
<center>
<div style="font-size: 12pt;margin-bottom: 20px; border: 1px solid #428bca; border-radius: 4px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05); box-shadow: 0 1px 1px rgba(0, 0, 0, .05);">
  <!-- Default panel contents -->
  <div style="text-align:center; color: #fff; background-color: #428bca; border-color: #428bca;padding: 10px 15px; border-bottom: 1px solid transparent; border-top-left-radius: 3px; border-top-right-radius: 3px;">Resumen</div>

	<table class="table" style="margin-bottom: 0;width: 100%;max-width: 100%; background-color: transparent;border-spacing: 0; border-collapse: collapse;">
		<tr>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right;">Presamos Dados</th>
			<td style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right;"><?php echo money_format("%.2n",($totales['myLoans'][0]+$totales['myLoans'][1])); ?></td>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right;">Presamos Recibidos</th>
			<td style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right;"><?php echo money_format("%.2n",($totales['yourLoans'][0]+$totales['yourLoans'][1])); ?></td>
		</tr>
		<tr>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right; border-top: 1px solid #ddd; text-align:right;">Abonos Recibidos</th>
			<td style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right; border-top: 1px solid #ddd; text-align:right;"><?php echo money_format("%.2n",$totales['myLoans'][0]); ?></td>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right; border-top: 1px solid #ddd; text-align:right;">Abonos Dados</th>
			<td style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right; border-top: 1px solid #ddd; text-align:right;"><?php echo money_format("%.2n",$totales['yourLoans'][0]); ?></td>
		</tr>
		<tr>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right; border-top: 1px solid #ddd;">Me deben</th>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right; border-top: 1px solid #ddd;"><?php echo money_format("%.2n",$totales['myLoans'][1]); ?></th>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right; border-top: 1px solid #ddd;">Debo</th>
			<th style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right;text-align:right; border-top: 1px solid #ddd;"><?php echo money_format("%.2n",$totales['yourLoans'][1]); ?></th>
		</tr>
		<tr>
			<th colspan=4 style="padding: 8px; line-height: 1.428571429; vertical-align: top;text-align:right;text-align:center; border-top: 1px solid #ddd;">Resultado : <?php echo money_format("%.2n",($totales['myLoans'][1] - $totales['yourLoans'][1] )); ?></th>
		</tr>
	</table>
</div>
</center>

</div>
