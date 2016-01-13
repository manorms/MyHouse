<?php
    $this->Html->addCrumb( $pluralName, "/Houses" );
    $this->Html->addCrumb( 'Add House');
    $this->extend('/Common/form');
    $this->assign('title','Agregar House' );
    $this->set('width', '600px') ;
    $this->start('body');
		echo '<div class="row">
			<div class="col-md-6">
				<fieldset >
					<legend>Información de House</legend>';
					echo $this->Form->input("House.id");
					echo $this->Form->input("House.name", array(  'placeholder' => __('Nombre'), 'label' => __('Nombre'), 'class' => 'form-control' ) );
					echo $this->Form->input("House.comments", array(  'placeholder' => __('Comentarios'), 'label' => __('Comentarios'), 'class' => 'form-control') );
				echo '</fieldset>';
			echo '</div>';
			echo '<div class="col-md-6">
				<fieldset >
					<legend>Usuarios</legend>';
			?>
						<table class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th><input type="checkbox" class="checkAll" onclick="$('input[type=checkbox][class=usersC]').prop('checked',this.checked)" /> All</th>
									<th>Name</th>
								</tr>
							</thead>
							<tbody>
			<?php
							foreach($this->request->data as $key => $user){
								echo '<tr>';
									echo '<td>'.$this->Form->checkbox("User.{$key}.user_id", array('hiddenField' => false, 'class' => 'usersC', 'value'=>$key)).'</td>';
									echo '<td><label style="font-weight:normal;" for="User'.$key.'UserId">'.$user.'</label></td>';
								echo '</tr>';
							}
			?>				
							</tbody>
						</table>
			<?php
			echo '</div>';		
		echo '</div>';		
	$this->end();
	$this->start('footer');    
		echo '<div style="display: inline-table;width: 100%;">';
        echo $this->Form->button( __( 'Guardar') , array( 'type' => 'submit', 'class' => 'btn btn-primary pull-right' ) );
		echo '</div>';
	$this->end();    
?>