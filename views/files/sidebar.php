<div id="left-menu">
	<div class="sub-left-menu scroll"><br>

		&nbsp;&nbsp; <a href="<?php echo $url['_base'] . 'index.php?action=home'; ?>"><img src="<?php echo $url['_asset'];?>img/logo.jpg" class = "img-rounded" title="NMBA Logo" style ="height: auto; width: 200px; border: 1px solid #989898;padding: 3px;"></a>

		<ul class="nav nav-list">

			<li class="ripple <?php if($side == 1){echo 'active';} ?>">
				<a href="<?php echo $url['_base'];?>index.php?action=home">
					<span class="fa-home fa"></span> Home 
					<span class="fa-angle-right fa right-arrow text-right"></span>
			</a></li>

			<li class="ripple <?php if($side == 2){echo 'active';} ?>">
				<a href="<?php echo $url['_base'];?>index.php?action=profile" >
					<span class="fa fa-user"></span> My Profile
					<span class="fa-angle-right fa right-arrow text-right"></span>
			</a></li>

			<?php

			if (strtolower($_SESSION['user_account_type']) == 'admin' || strtolower($_SESSION['user_account_type']) == 'super-admin') {

				echo '<li class="ripple '; if($side == 3){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=member">
				<span class="fa fa-users"></span> Manage Member
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a></li>';
			}


			if (strtolower($_SESSION['user_account_type']) == 'super-admin') {

				echo '<li class="ripple '; if($side == 4){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=admin">
				<span class="fa fa-user-secret"></span> Manage Admin
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a></li>';
			}
			
			if (strtolower($_SESSION['user_account_type']) == 'admin' || strtolower($_SESSION['user_account_type']) == 'super-admin') {

				echo '<li class="ripple '; if($side == 5){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=event">
				<span class="fa fa-calendar"></span> Event
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a></li>

				<li class="ripple '; if($side == 6){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=payment">
				<span class="fa fa-money"></span> Payment
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a></li>

				<li class="ripple '; if($side == 7){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=notice">
				<span class="fa fa-user"></span> Notice
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a></li>';
			}
		

			if (strtolower($_SESSION['user_account_type']) == 'super-admin') {

				echo '<li class="ripple '; if($side == 8){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=notification">
				<span class="fa fa-bell"></span> Send Notification
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a>
				</li>

				<li class="ripple '; if($side == 9){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=report">
				<span class="fa fa-th-list"></span> Activity
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a>
				</li>

				<li class="ripple '; if($side == 10){echo 'active';} echo '">
				<a href="'.$url['_base'].'index.php?action=fee_year">
				<span class="fa fa-search"></span> Fees Report
				<span class="fa-angle-right fa right-arrow text-right"></span>
				</a>
				</li>';
			}
			?>
		</ul>
	</div>
</div>