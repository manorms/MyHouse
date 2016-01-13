<h1 class="page-header">Servicios
							<div class="pull-right"><?php echo $this->Html->link(
									'<span class="glyphicon glyphicon-floppy-save"></span> Nuevo',
									array('controller' => 'services', 'action' => 'add', 'full_base' => true),
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
				echo "<th>Total</th>";
				echo "<th>Comentarios</th>";
				echo "<th>Status</th>";
				echo "<th>Opciones</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach($this->request->data as $service)
		{
			setlocale(LC_MONETARY, 'es_MX');
			echo "<tr>";
				echo "<td>{$service['Service']['id']}</td>";
				echo "<td>{$service['Service']['name']}</td>";
				echo "<td style='text-align: right;'>".(money_format("%.2n",$service['Service']['amount']))."</td>";
				echo "<td>{$service['Service']['comments']}</td>";
				echo "<td>".(($service['Service']['active'])? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>" )."</td>";
				echo "<td>";
					echo '<div class="btn-group btn-group-xs pull-right">';
						echo $this->Html->link(
								'<span class="glyphicon glyphicon-pencil"></span>',
								array('controller' => 'services', 'action' => 'edit', 'full_base' => true,Set::classicExtract($service['Service'], 'id')),
								array( 'title' => 'Editar', 'class' => 'btn btn-primary btn-xs', 'escape' => false )
							);
						echo $this->Form->postLink(
								'<span class="glyphicon glyphicon-trash"></span>', 
								array('controller' => 'services', 'action' => 'delete', Set::classicExtract($service['Service'], 'id')),
								array( 'title' => 'Eliminar', 'class' => 'btn btn-primary btn-xs', 'escape' => false ),
								__('¿Estas seguro de querer eliminar el servicio # %s?', Set::classicExtract($service['Service'], 'id'))
							);
					echo '</div>';
				echo "</td>";
			echo "</tr>";
			//$service['Service'];
		}
		echo "<tbody>";
	echo "</table>";
?>