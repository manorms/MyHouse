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
    		echo $this->JqueryValidation->input( 'User.username', array( 'label' => __('Username (Para Sign in con Facebook/Google poner el E-mail de tu cuenta)'), 'autocomplete' => 'off', 'class' => 'form-control' ) );
		    echo $this->JqueryValidation->input( 'User.email', array( 'label' => __('E-mail'), 'class' => 'form-control' ) );
		    ?>
        <label for="UserTwitterId">Twitter</label>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">@</div>
            <?= $this->JqueryValidation->input( 'User.twitter_id', array( 'type'=>'text','label' => false,'div' => false, 'class' => 'form-control' ) );?>
          </div>
        </div>

        <?php
		    echo $this->JqueryValidation->input( 'User.notifications', array( 'label' => __('¿Recibir Notificaciones por E-mail?'), 'class' => '' ) );
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
	$this->end();
	$this->start('footer');
	echo '<div style="display: inline-table;width: 100%;">';
	echo $this->Form->button( __( 'Guardar') , array( 'type' => 'submit', 'id' => 'btnSubmit', 'class' => 'btn btn-primary pull-right' ) );
	echo '</div>';
	$this->end();

?>
