<?php
setlocale(LC_MONETARY, 'es_MX');
?>
<div class=WordSection1>
	<p class=MsoNormal style='text-align:justify;line-height:normal;background:white'>
		<span style='font-size:12.0pt;font-family:"Arial","sans-serif";color:#222222'>
			<b>Notificación:</b>  <?php echo $this->request->data['type']; ?> en <a href="<?php echo URL_SYSTEM; ?>"><?php echo NAME_SYSTEM; ?></a>.
		</span>
	</p>
	<table class=MsoTableMediumList2Accent1 border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
		<tr>
			<td width=599 colspan=2 valign=top style='width:448.9pt;border:none;border-bottom:solid #4F81BD 3.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<b>
						<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222;background:white'>
							Información del <?php echo $this->request->data['type']; ?>:
						</span>
					</b>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Pagó:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<?php echo $this->request->data['nameFrom']; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:			150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>House:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<?php echo $this->request->data['nameHouse']; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:			150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Descripción:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<?php echo $this->request->data['data']['description']; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:			150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Fecha:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<?php echo $this->request->data['data']['date']; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Participantes:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222'>
						<?php echo $this->request->data['namesTo']; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Total:</span>
				</p>
			</td>
			<td width=497 valign=top style='text-align:right;width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222'>
						<b><?php
							echo money_format("%.2n",$this->request->data['data']['amount']);
						?></b>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Total por participante:</span>
				</p>
			</td>
			<td width=497 valign=top style='text-align:right;width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222'>
						<b><?php echo money_format("%.2n",($this->request->data['data']['amount'] / $this->request->data['countTo'])); ?></b>
					</span>
				</p>
			</td>
		</tr>
	</table>
</div>
