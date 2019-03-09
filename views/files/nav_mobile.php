<div id="mimin-mobile" class="reverse">
	<div class="mimin-mobile-menu-list">
		<div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
			<ul class="nav nav-list">

				<li class="ripple">
					<a href="<?php echo $url['_base'];?>index.php?action=home">
						<span class="fa-home fa"></span> Home 
						<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
				</li>

				<li class="ripple">
					<a href="<?php echo $url['_base'];?>index.php?action=profile" >
						<span class="fa fa-user"></span> My Profile
						<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
				</li>

				<?php
				if (strtolower($_SESSION['user_account_type']) == 'super-admin') {

					echo '<li class="ripple">
					<a href="'.$url['_base'].'index.php?action=admin">
					<span class="fa fa-user-secret"></span> Manage Admin
					<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
					</li>';
				}

				if (strtolower($_SESSION['user_account_type']) == 'admin' || strtolower($_SESSION['user_account_type']) == 'super-admin') {

					echo '<li class="ripple">
					<a href="'.$url['_base'].'index.php?action=member">
					<span class="fa fa-users"></span> Manage Member
					<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
					</li>

					<li class="ripple">
					<a href="'.$url['_base'].'index.php?action=event">
					<span class="fa fa-calendar"></span> Event
					<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
					</li>
					<li class="ripple">
					<a href="'.$url['_base'].'index.php?action=payment">
					<span class="fa fa-money"></span> Payment
					<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
					</li>
					<li class="ripple">
					<a href="'.$url['_base'].'index.php?action=notice">
					<span class="fa fa-user"></span> Notice
					<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
					</li>';
				}

				if (strtolower($_SESSION['user_account_type']) == 'super-admin') {

					echo '<li class="ripple">
					<a href="'.$url['_base'].'index.php?action=notification">
					<span class="fa fa-bell"></span> Send Notification
					<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
					</li>
					<li class="ripple">
					<a href="'.$url['_base'].'index.php?action=report">
					<span class="fa fa-th-list"></span> Activity
					<span class="fa-angle-right fa right-arrow text-right"></span>
					</a>
					</li>

					<li class="ripple">
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
</div>

<button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger btn-sm">
	<span class="fa fa-bars"></span>
</button>