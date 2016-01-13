<?php
    $this->Html->addCrumb( 'Users', "/Users" );
    $this->Html->addCrumb( 'Add User' );
    $this->extend('/Common/form');
    $this->assign('title', 'Editar Usuario');
	$this->set('formOptions', array( "enctype"=>"multipart/form-data" ) );
    $this->start('body');

?>
<div class="row">
	<div class="col-md-6">
		<fieldset >
			<legend>Información de Usuario</legend>
			<?php
    		echo $this->JqueryValidation->input( 'User.id' );
    		echo $this->JqueryValidation->input( 'User.username', array( 'label' => __('Username'), 'autocomplete' => 'off', 'class' => 'form-control' ) );
		    echo $this->JqueryValidation->input( 'User.email', array( 'label' => __('E-mail'), 'class' => 'form-control' ) );
		    echo $this->JqueryValidation->input( 'User.profile_id', array( 'label' => __('Perfil'), 'empty' => __('--'), 'class' => 'form-control' ) );
			//echo $this->JqueryValidation->input( 'User.session_counter', array('disabled' => 'disabled'));
			echo $this->JqueryValidation->input( 'User.session_time', array( 'label' => __('Tiempo de sesión(segundos)'), 'default'=>420,'style' => 'text-align:right', 'class' => 'form-control') );
		echo '</fieldset>';
	echo '</div>';
	echo '<div class="col-md-6">';
		echo '<fieldset>';
			echo '<legend>'.__('Información Personal').'</legend>';
			echo $this->JqueryValidation->input( 'User.name', array( 'label' => __('Nombre'), 'class' => 'form-control' ));
			echo $this->JqueryValidation->input( 'User.first_last_name', array( 'label' => __('Apellido Paterno'), 'class' => 'form-control' ));
			echo $this->JqueryValidation->input( 'User.second_last_name', array( 'label' => __('Apellido Materno'), 'class' => 'form-control' ));

		echo '</fieldset>';
	echo '</div>';
echo '</div>';
echo '<div class="row">';
	echo '<div class="col-md-12">';
		echo $this->JqueryValidation->input( 'User.comments', array( 'label' => __('Comentarios'), 'class' => 'form-control' ) );
		echo '<div class="pull-right">';
		//echo $this->JqueryValidation->input( 'User.active', array( 'label' => __('Activo'), 'class' => '', 'default' => 1) );
		echo '</div>';
	echo '</div>';
echo '</div>';
	$this->end();
	$this->start('footer');
	echo '<div style="display: inline-table;width: 100%;">';
	echo $this->Form->button( __( 'Guardar') , array( 'type' => 'submit', 'id' => 'btnSubmit', 'class' => 'btn btn-primary pull-right' ) );
	echo '</div>';
	$this->end();

?>
