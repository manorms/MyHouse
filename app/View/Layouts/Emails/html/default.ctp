<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $title_for_layout; ?></title>
	<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
	<meta name=Generator content="Microsoft Word 14 (filtered)">
	<style>
	<!--
	 /* Font Definitions */
	 @font-face
		{font-family:Calibri;
		panose-1:2 15 5 2 2 2 4 3 2 4;}
	 /* Style Definitions */
	 p.MsoNormal, li.MsoNormal, div.MsoNormal
		{margin-top:0cm;
		margin-right:0cm;
		margin-bottom:10.0pt;
		margin-left:0cm;
		line-height:115%;
		font-size:11.0pt;
		font-family:"Calibri","sans-serif";}
	a:link, span.MsoHyperlink
		{color:blue;
		text-decoration:underline;}
	a:visited, span.MsoHyperlinkFollowed
		{color:purple;
		text-decoration:underline;}
	p
		{margin-right:0cm;
		margin-left:0cm;
		font-size:12.0pt;
		font-family:"Times New Roman","serif";}
	.MsoChpDefault
		{font-family:"Calibri","sans-serif";}
	.MsoPapDefault
		{margin-bottom:10.0pt;
		line-height:115%;}
	@page WordSection1
		{size:612.0pt 792.0pt;
		margin:70.85pt 3.0cm 70.85pt 3.0cm;}
	div.WordSection1
		{page:WordSection1;}
	-->
	</style>
</head>
<body lang=ES-MX link=blue vlink=purple>
	<?php echo $this->Html->image("headerEmail.jpg",array('fullBase' => true, "style" => "margin-bottom:20px;")); ?>
	<?php echo $this->fetch('content'); ?>
	<br />
	<br />
	<?php echo $this->Html->image("footerEmail.jpg",array('fullBase' => true)); ?>
	<p class=MsoNormal align=right style='margin-top:3.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:right'>
		<span style='font-size:8.0pt;line-height:115%;font-family:"Arial","sans-serif";color:#222222; background:white'>E-mail enviado automáticamente por </span>
		<span style='font-size:8.0pt;line-height:115%;font-family:"Arial","sans-serif";color:#222222'>
			<a href="<?php echo URL_SYSTEM; ?>"><?php echo NAME_SYSTEM; ?></a>.
		</span>
	</p>
</body>
</html>
