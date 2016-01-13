<?php
$page = $this->request->data['page'];
$name = $this->request->data['name'];
$username = $this->request->data['username'];
$email = $this->request->data['email'];
$password = $this->request->data['password'];
?>
<div class=WordSection1>
	<p class=MsoNormal style='text-align:justify;line-height:normal;background:white'>
		<span style='font-size:12.0pt;font-family:"Arial","sans-serif";color:#222222'>
			Hola <b><?php echo $name; ?></b> por medio de este E-mail te mandamos un password de recuperación para el acceso a <a href="<?php echo URL_SYSTEM; ?>"><?php echo NAME_SYSTEM; ?></a>.
		</span>
	</p>
	<table class=MsoTableMediumList2Accent1 border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
		<tr>
			<td width=599 colspan=2 valign=top style='width:448.9pt;border:none;border-bottom:solid #4F81BD 3.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<b>
						<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222;background:white'>
							Tu información de registro:
						</span>
					</b>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>Username:</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>
						<?php echo $username; ?>
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
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'><b>Password:</b></span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border:none;border-right:solid #4F81BD 1.0pt;background:#D3DFEE;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222'>
						<?php echo $password; ?>
					</span>
				</p>
			</td>
		</tr>
		<tr>
			<td width=102 valign=top style='width:76.3pt;border:none;border-right:solid #4F81BD 1.0pt;background:white;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
					<span style='font-size:12.0pt;line-height:150%;font-family:"Arial","sans-serif";color:black'>&nbsp;</span>
				</p>
			</td>
			<td width=497 valign=top style='width:372.6pt;border-top:none;border-left:none;border-bottom:solid #4F81BD 1.0pt;border-right:solid #4F81BD 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;line-height:150%'>
					<span style='font-size:10.0pt;line-height:150%;font-family:"Arial","sans-serif";color:#222222;background:white'>
						Te recomendamos que actualices tu password por alguno que puedas recordar.
					</span>
				</p>
			</td>
		</tr>
	</table>
</div>
