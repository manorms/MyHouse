<h1 class="page-header">Usuarios
							<div class="pull-right"><?php echo $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Nuevo',
									array('controller' => 'users', 'action' => 'add', 'full_base' => true),
									array( 'class' => 'btn btn-primary', 'escape' => false )
								); ?>
							</div>
</h1>
<?php	
	echo "<table class='table table-hover table-condensed table-striped data-table'>";
		echo "<thead>";
			echo "<tr>";
				echo "<th>#</th>";
				echo "<th>Nombre</th>";
				echo "<th>Perfil</th>";
				echo "<th>E-mail</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Status</th>";
				echo "<th>Opciones</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach($this->request->data as $user)
		{
			echo "<tr>";
				echo "<td>{$user['User']['id']}</td>";
				echo "<td>{$user['User']['full_name']}</td>";
				echo "<td>{$user['Profile']['name']}</td>";
				echo "<td>{$user['User']['email']}</td>";
				echo "<td>{$user['User']['comments']}</td>";
				echo "<td >".(($user['User']['active'])? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>" )."</td>";
				echo "<td>";
					echo '<div class="btn-group btn-group-xs pull-right">';
						echo $this->Html->link(
								'<span class="glyphicon glyphicon-pencil"></span>',
								array('controller' => 'users', 'action' => 'edit', 'full_base' => true,Set::classicExtract($user['User'], 'id')),
								array( 'title' => 'Editar', 'class' => 'btn btn-primary btn-xs', 'escape' => false )
							);
						echo $this->Form->postLink(
								'<span class="glyphicon glyphicon-trash"></span>', 
								array('action' => 'delete', Set::classicExtract($user['User'], 'id')),
								array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
								__('¿Estas seguro de querer eliminar # %s?', Set::classicExtract($user['User'], 'id'))
							);
					echo '</div>';
				echo "</td>";
			echo "</tr>";
			//$user['User'];
		}
		echo "<tbody>";
	echo "</table>";
	
?>