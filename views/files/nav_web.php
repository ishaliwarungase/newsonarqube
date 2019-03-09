<nav class="navbar navbar-default header navbar-fixed-top">
	<div class="col-md-12 nav-wrapper">
		<div class="navbar-header" style="width:100%;">
			<div class="opener-left-menu is-open">
				<span class="top"></span>
				<span class="middle"></span>
				<span class="bottom"></span>
			</div>
			
			<a href="<?php echo $url['_base'] . 'index.php?action=home'; ?>" class="navbar-brand"><b><?php echo $site['title']; ?></b></a>
		
			<ul class="nav navbar-nav navbar-right user-nav">
				<li class="user-name" style="color:#fff">
					<b><?php echo ucwords($_SESSION['user_name']);?></b>
				</li>
				<li class="dropdown avatar-dropdown">

					<img src="https://static.thenounproject.com/png/516849-200.png" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>

					<ul class="dropdown-menu user-dropdown">
						<li><a href="<?php echo $url['_base'];?>index.php?action=profile">
							<span class="fa fa-user"></span> My Profile</a>
						</li>
						<li><a href="<?php echo $url['_base'];?>index.php?action=login">
							<span class="fa fa-power-off"></span> Logout</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>