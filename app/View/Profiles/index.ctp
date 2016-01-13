<h1 class="page-header">Perfiles
							<div class="pull-right"><?php echo $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Nuevo',
									array('controller' => 'profiles', 'action' => 'add', 'full_base' => true),
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
				echo "<th>Comentarios</th>";
				echo "<th>Status</th>";
				echo "<th>Opciones</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach($this->request->data as $profile)
		{
			echo "<tr>";
				echo "<td>{$profile['Profile']['id']}</td>";
				echo "<td>{$profile['Profile']['name']}</td>";
				echo "<td>{$profile['Profile']['comments']}</td>";
				echo "<td >".(($profile['Profile']['active'])? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>" )."</td>";
				echo "<td>";
					echo '<div class="btn-group btn-group-xs pull-right">';
						echo $this->Html->link(
								'<span class="glyphicon glyphicon-pencil"></span>',
								array('controller' => 'profiles', 'action' => 'edit', 'full_base' => true,Set::classicExtract($profile['Profile'], 'id')),
								array( 'title' => 'Editar', 'class' => 'btn btn-primary btn-xs', 'escape' => false )
							);
						echo $this->Form->postLink(
								'<span class="glyphicon glyphicon-trash"></span>', 
								array('controller' => 'profiles', 'action' => 'delete', Set::classicExtract($profile['Profile'], 'id')),
								array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
								__('¿Estas seguro de querer eliminar el perfil # %s?', Set::classicExtract($profile['Profile'], 'id'))
							);
					echo '</div>';
				echo "</td>";
			echo "</tr>";
			//$profile['Profile'];
		}
		echo "<tbody>";
	echo "</table>";
?>