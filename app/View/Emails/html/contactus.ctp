<?php
$name = $this->request->data['name'];
$date = $this->request->data['date'];
$email = $this->request->data['email'];
$comments = $this->request->data['comments'];
?>
<div class=WordSection1>
	<p class=MsoNormal style='text-align:justify;line-height:normal;background:white'>
		<span style='font-size:12.0pt;font-family:"Arial","sans-serif";color:#222222'>
			Message from Contact Us on <b><?php echo $name; ?></b><a href="<?php echo URL_SYSTEM; ?>"><?php echo NAME_SYSTEM; ?></a>.
		</span>
	</p>
	<table class=MsoTableMediumList2Accent1 border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
		<tr>
			<td width=599 colspan=2 valign=top style='width:448.9pt;border:none;border-bottom:solid #4F81BD 3.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<b>
						<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222;background:white'>
							Content:
						</span>
					</b>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:			150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Date:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<?php echo $date; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>By:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<?php echo $name; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:			150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>E-mail:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Comments:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222'>
						<b><?php echo $comments; ?></b>
					</span>
				</p>
			</td>
		</tr>
	</table>
</div>
