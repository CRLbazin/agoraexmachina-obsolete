<!-- Fixed navbar -->
	<div class="navbar  navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo WEBSITE_ROOT ?>"><?php echo WEBSITE_TITLE ?> - <span class="fg-blue"><?php echo WEBSITE_SUBTITLE ?></span></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<?php
					if(isset($_SESSION['users']))
					{
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['users']->name ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo WEBSITE_ROOT?>/users/private/<?php echo $_SESSION['users']->id ?>"><span class="glyphicon glyphicon-user"></span> Profil utilisateur</a></li>
								<li><a href="<?php echo WEBSITE_ROOT ?>/users/disconnect"><span class="glyphicon glyphicon-off"></span> Deconnexion</a></li>
								<li class="divider"></li>
								<?php
								if($_SESSION['users']->level >= 8)
								{?>
									<li><a href="<?php echo WEBSITE_ROOT?>/admin"><span class="glyphicon glyphicon-cog"></span> Administration</a></li>
									<li class="divider"></li>
									<?php
								} ?>
							</ul>
						</li>
						<?php
						//echo "<li class='active'><a href='./'>Bonjour ".$_SESSION['users']->name."</a></li>";
					
					 }
					else
						echo "<li class='active'><a href='".WEBSITE_ROOT."/users/register'>Se connecter</a></li>";
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
<br /><br /><br />