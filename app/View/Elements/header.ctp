<div class="navbar navbar-inverse navbar-static-top navbar-fixed-top" role="navigation"><!--navbar-fixed-top-->
  <div class="container-fluid">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="<?php echo $this->Html->url( array('admin' => false, 'plugin' => false, "controller" => "users", "action" => "home" ) )  ?>"><?php echo NAME_SYSTEM; ?></a>
	</div>
	<div class="navbar-collapse collapse">

	  <ul class="nav navbar-nav navbar-right">
		<li>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">ACL Configuration <b class="caret"></b></a>
			<?php if($this->Session->read("Auth.User.profile_id") == 1){ ?>
			<ul class="dropdown-menu">
			  <li><a href="/acl/aros">Permissions</a></li>
			  <li><a href="/acl/acos">Actions</a></li>
			</ul>
			<?php } ?>
		</li>
		<li>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notificaciones <span class="badge">42</span> <b class="caret"></b></a>
			<ul class="dropdown-menu notifications"><!-- limit 10 notifications -->
			  <li><a href="javascript:void(0)"><p class="">Working...</p></a></li>
			  <li><a href="javascript:void(0)"><p class="">Maecenas sed diam eget risus varius blanditsed diam eget risus  risus varius blandit sit amet non magna.</p></a></li>
			  <li class="divider"></li>
			  <li><a href="javascript:void(0)"><p class="">Maecenas sed diam eget risus varius blanditsed diam eget risus  risus varius blandit sit amet non magna.</p></a></li>
			  <li class="divider"></li>
			  <li><a href="javascript:void(0)"><p class="">Maecenas sed diam eget risus varius blanditsed diam eget risus  risus varius blandit sit amet non magna.</p></a></li>
			  <li class="divider"></li>
			  <li><a href="javascript:void(0)"><p class="">Maecenas sed diam eget risus varius blanditsed diam eget risus  risus varius blandit sit amet non magna.</p></a></li>
			  <li class="divider"></li>
			  <li><a href="javascript:void(0)"><p class="">Maecenas sed diam eget risus varius blanditsed diam eget risus  risus varius blandit sit amet non magna.</p></a></li>
			  <li class="divider"></li>
			  <li><center><a href="<?php echo $this->Html->url( array( "controller" => "users", "action" => "home" ) ); ?>">More</a></center></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <b class="caret"></b></a>
			<ul class="dropdown-menu">
			  <li><a href="<?php echo $this->Html->url( array( 'plugin' => false,"controller" => "users", "action" => "change_password" ) ); ?>">Cambiar Password</a></li>
			  <li><a href="<?php echo $this->Html->url( array( 'plugin' => false,"controller" => "users", "action" => "edit2" ) ); ?>">Editar mis datos</a></li>
			  <li class="divider"></li>
			  <li><?php echo $this->Facebook->logout(array('label' => '<span class="glyphicon glyphicon-off"></span> Sign Off','redirect' => array('controller' => 'users', 'action' => 'logout'))); ?></li>
			</ul>
		</li>
	  </ul>
	  <form class="navbar-form navbar-right" role="search">
		<div class="form-group">
			<div class="input-group">
				<div id="chooseHouse" class="alert alert-danger <?php echo ($this->Session->read('Auth.User.House') != '' ? 'hide' : '');?>" style="margin-bottom:0px;padding:6px;float:left;border-radius: 4px 0px 0px 4px;">
				  <strong>Warning! Choose One &rarr;</strong>
				</div>
				<select type="text" class="form-control" placeholder="Search" id="slHouses" style="float:right">
					<option value="">--</option>
					<?php
						App::import('Model','House');
						$mHouse = new House();
						$houses_id = $mHouse->query('SELECT house_id FROM houses_users WHERE user_id="'.$this->Session->read("Auth.User.id").'"');
						$houses_id = Set::classicExtract($houses_id, '{n}.houses_users.house_id');
						$houses = $mHouse->find('list', array('conditions' => array('House.id' => $houses_id, 'House.active' => 1)));
						foreach($houses as $key => $house)
						{
							echo ($this->Session->read('Auth.User.House') == $key) ? "<option value='{$key}' selected>{$house}</opton>" : "<option value='{$key}'>{$house}</opton>";
						}
					?>
				</select>
			</div>
		</div>
	  </form>
	</div>
  </div>
</div>
<script>
	$("#slHouses").on('change', function (){
		$.ajax({
			url: '<?php echo $this->Html->url( array( "controller" => "houses", "action" => "change_house" ) )?>',
			type:'post',
			data: { idHouse: $('#slHouses').val() },
			beforeSend:function(request) {

			},
			complete:function(request, json) {
				location.reload();
				//$("#debug").html(request.responseText);
			}
		});
	});
</script>
