<!--<div class="container" <?php echo ($this->getVar('width')!='') ? 'style="width:'.$this->getVar('width').';"':''; ?> >-->
<?php
	$formOptions = array(
		'class' => 'jquery-validation',
		'role' => 'form',
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control'
		),
		
	);
	if( is_array( $this->getVar('formOptions') ) )$formOptions = array_merge( $formOptions, $this->getVar('formOptions') );
	echo @$this->Form->create($modelClass, $formOptions);
?>
	<h1 class="page-header"><?php  echo $this->fetch('title'); ?><div class="pull-right"><?php  echo $this->Html->image('loading_bar.gif', array('id' => 'gLoading','class'=> 'hide', 'style' => 'margin-right: -25px;margin-bottom: -16px; width: 230px;')); ?></div></h1>
	<?php echo $this->fetch('body') ?>
	<br/>
	<?php echo $this->fetch('footer') ?>
<?php
	echo $this->Form->end();
?>
<!--</div>-->