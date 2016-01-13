<?php //pr($twitterlogin); ?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="javascript:void(0)"><?php echo NAME_SYSTEM; ?></a>
		</div>
		<div class="navbar-collapse collapse">
		<?php echo $this->Form->create('User', array( 'id' => 'UserLoginForm', 'action' => '/login/', 'class' => 'navbar-form navbar-right jquery-validation', 'role' => 'form' ) ); ?>
			<table class="">
				<tr>
					<td style="vertical-align:top;" >
						<div class="form-group formLogin">
							<?php echo $this->JqueryValidation->input( 'User.username', array( 'label' => false, 'placeholder' => 'Username', 'class' => 'form-control' ) ); ?>
						</div>
					</td>
					<td style="vertical-align:top;">
						<div class="form-group formLogin">
						  <?php echo $this->JqueryValidation->input( 'User.password', array( 'label' => false, 'placeholder' => 'Password', 'class' => 'form-control' ) ); ?>
						</div>
					</td>
					<td style="vertical-align:top;">
						<!--<button type="submit" class="btn btn-success">Sign in</button>-->
						<!-- Split button -->
						<div class="btn-group">
						  <button type="submit" class="btn btn-success">Sign in</button>
						  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <span class="caret"></span>
						    <span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
						    <li><?php echo $this->Facebook->login(
																									array(
																										'redirect' => array('controller' => 'users', 'action' => 'home '),
																										'width' => '174',
																										'height'=>'25',
																										'scope' => 'email',
																										'label' => 	$this->Html->image('sign-in-with-facebook.png', array('width' => '200px', 'height' => '48px','alt' => 'Sign in with Facebook'))
																									)

																								);
											?></li>
							  <li><a href="<?php echo $googlelogin['AuthUrl']; ?>"><?= $this->Html->image('sign-in-with-google.png', array('width' => '200px', 'height' => '48px','alt' => 'Sign in with Google')) ?></a></li>

								<li><a href="<?php echo $twitterlogin['AuthUrl'];?>"><?= $this->Html->image('sign-in-with-twitter.png', array('width' => '200px', 'height' => '48px','alt' => 'Sign in with Twitter')) ?></a></li>
						  	<li class="hide"><?= $this->Facebook->logout(array('label' => 'Logout', 'redirect' => array('controller' => 'users', 'action' => 'logout'))); ?></li>
							</ul>
</div>
					</td>
					<td style="vertical-align:top;">
						&nbsp;&nbsp;<a href="<?php echo $this->Html->url( array( "controller" => "users", "action" => "reset_password" ) )  ?>" title="¿Ha olvidado su password?"><span class="glyphicon glyphicon-question-sign" ></span> </a>
					</td>
				</tr>
			</table>
		<?php echo $this->Form->end(); ?>

		</div><!--/.navbar-collapse -->
	</div>
</div>
