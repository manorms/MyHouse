<?php $selected = $this->params['controller']; ?>
<ul class="nav nav-pills nav-stacked nav-sidebar">
	<li class="<?php echo ($this->params['action']=='home' || $this->params['action']=='login') ? 'active' : '';?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "users", "action" => "home" ) )  ?>"><span class="glyphicon glyphicon-home"></span> Home</a>
	</li>
	<li class="<?php echo ($selected=='profiles') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "profiles", "action" => "index" ) )  ?>"><span class="glyphicon glyphicon-th"></span> Perfiles</a>
	</li>
	<li class="<?php echo ($selected=='users' && $this->params['action']!='contact' && $this->params['action']!='reset_password' && $this->params['action']!='home' && $this->params['action']!='login') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "users", "action" => "index" ) )  ?>"><span class="glyphicon glyphicon-user"></span> Usuarios</a>
	</li>
	<li class="<?php echo ($selected=='houses') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "houses", "action" => "index" ) )  ?>"><span class="glyphicon glyphicon-tower"></span> Houses</a>
	</li>
	<li class="<?php echo ($selected=='services') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "services", "action" => "index" ) )  ?>"><span class="glyphicon glyphicon-list-alt"></span> Plantillas(Gastos)</a>
	</li>
	<li class="<?php echo ($selected=='expenses') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "expenses", "action" => "index" ) )  ?>"><span class="glyphicon glyphicon-barcode"></span> Gastos</a>
	</li>
	<li class="<?php echo ($selected=='loans' && $this->params['action']!='state') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "loans", "action" => "index" ) )  ?>"><span class="glyphicon glyphicon-credit-card"></span> Prestamos</a>
	</li>
	<li class="<?php echo ($selected=='loans' && $this->params['action']=='state') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "loans", "action" => "state" ) )  ?>"><span class="glyphicon glyphicon-list"></span> Estado de cuenta</a>
	</li>
	<li class="<?php echo ($selected=='savings') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "savings", "action" => "index" ) )  ?>"><span class="glyphicon glyphicon-usd"></span> Ahorros</a>
	</li>
	<li class="<?php echo ($selected=='users' && $this->params['action']=='contact') ? 'active' : ''; ?>">
		<a href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "users", "action" => "contact" ) )  ?>"><span class="glyphicon glyphicon-send"></span> Contáctanos</a>
	</li>
</ul>
