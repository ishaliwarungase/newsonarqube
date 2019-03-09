<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>HOME  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>

	<link rel="stylesheet" type="text/css" href="<?php echo $url['_asset'];?>css/plugins/select2.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
	<style type="text/css">.dtp > .dtp-content { max-width: 345px; }

		.img_slide_cover{
			height: 20em;
			width: 100%;
		}

	</style>

</head>

<body id="mimin" class="dashboard">

	<?php
	include($path['_files'].'nav_web.php');
	?>

	<div class="container-fluid mimin-wrapper">

		<?php
		$side = 1;
		include($path['_files'].'sidebar.php');
		?>

		<div id="content">
			<div class="panel">
				<div class="panel-body">
					<div class="row animated fadeInLeft">

						<?php

						switch ($user_data['membership_category']) {
							case 'non-member': $color = '#898989'; break;
							case 'Associate': $color = '#007BE3'; break;
							case 'Honorary': $color = '#0ddb00'; break;
							case 'Life': $color = '#7c00f0'; break;
							default: $color = '#9c9c9c'; break;
						}

						echo '<div class="col-md-10 col-sm-8 col-xs-8">
						<h3 style="margin-top: 0px;">
							<span class="fa-stack" data-toggle="tooltip" data-placement="bottom" title="'. ucwords($user_data['membership_category']) .'">
								<i class="fa fa-certificate fa-stack-2x" style="color:'. $color .'"></i>
								<i class="fa fa-check fa-stack-1x" style="color:#fff;"></i>
							</span>
							'. ucfirst($user_data['initial']) .' '. ucwords($user_data['name']) .'
						</h3>
						<p>';						

							if (!empty($user_data['city_node'])) {
								echo '<span data-toggle="tooltip" data-placement="bottom" title="City"><i class="fa fa-map-marker"></i> ' . ucfirst($user_data['city_node']);
								echo '</span> &nbsp; |';
							}

							echo '<span data-toggle="tooltip" data-placement="bottom" title="Membership ID">';
							if (isset($user_data['membership_id'])) {
								echo ' &nbsp; <i class="fa fa-bookmark"></i> '. ucfirst($user_data['membership_id']);
							}

							?> 
						</span>
					</p></div>

					<div class="col-md-2 col-sm-4 col-xs-4 text-center ">
						<img onerror="http://cdn.onlinewebfonts.com/svg/img_568657.png" src="<?php
						if(file_exists($path['_views'].'asset/images/profile/'.$user_data['image']) ){
							if(isset($user_data['image'])){
								echo $url['_asset'].'images/profile/'.$user_data['image'];
								$x = '';
							}else{
								echo 'http://cdn.onlinewebfonts.com/svg/img_568657.png';
								$x = '<a href="'.$url['_base'].'index.php?action=profile#personal_detail"><small>Upload Image</small></a>';
							}
						}else{
							echo 'http://cdn.onlinewebfonts.com/svg/img_568657.png';
							$x = '<a href="'.$url['_base'].'index.php?action=profile#personal_detail"><small>Upload Image</small></a>';
						}
						?>" class="img-responsive img-rounded center-block" style ="border: 1px solid #989898;width: 100%;padding:1px;">
						<?php echo $x;?>
					</div>


				</div>

			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-12 padding-0">

				<div id="myCarousel" class="carousel slide" style="width: 100%">
					<div class="carousel-inner" role="listbox">

						<div class="item active">
							<div class="img_slide_cover" style="background: url('<?php echo $url['_asset']; ?>img/durga-mata-1.jpeg') no-repeat top center; background-size: cover;">
							</div>
						</div>

						<div class="item">
							<div class="img_slide_cover" style="background: url('<?php echo $url['_asset']; ?>img/durga-mata-2.jpeg') no-repeat top center; background-size: cover;">
							</div>
						</div>

						<div class="item">
							<div class="img_slide_cover" style="background: url('<?php echo $url['_asset']; ?>img/durga-mata-3.jpeg') no-repeat top center; background-size: cover;">
							</div>
						</div>

						<div class="item">
							<div class="img_slide_cover" style="background: url('<?php echo $url['_asset']; ?>img/durga-mata-4.jpeg') no-repeat top center; background-size: cover;">
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12" style="padding:20px;">
			<div class="col-md-12 padding-0">

				<div class="col-md-3">					
					<div class="panel box-v1">
						<span data-toggle="tooltip" data-placement="top" title="Age Calculator">
							<div class="panel-body text-center">								
								<h4><i class="fa fa-calendar-plus-o"></i> Age Calculator</h4>
								<input type="text" class="form-text ripple dateAnimate" id="select_date" required placeholder="Select Date">
								<input type="hidden" id="user_dob" value="<?php echo date('Y-m-d',$user_data['dob']);?>">
								<h4 id="age_on"></h4>
							</div>
						</span>
					</div>				
				</div>

				<?php
				$w_loc = json_decode(file_get_contents("https://ipinfo.io/geo"),true)["city"];
				$w_weath =json_decode(file_get_contents("http://api.apixu.com/v1/current.json?key=e7e591ee404a4aa59f2133854181307&q=".urlencode( $w_loc ) ),true)["current"];

				if (!empty($w_loc) AND !empty($w_weath)) {

					echo '<div class="col-md-6 col-sm-12 col-xs-12" data-toggle="tooltip" data-placement="top" title='. $w_weath["condition"]["text"] .'>

					<div class="col-md-6 col-sm-6 col-xs-6 text-center" style="color:#fff;">

						<h3><span class="fa fa-map-marker"></span> '. $w_loc .'</h3>

						<h2 style="margin-top: -10px;">'. floor( $w_weath["temp_c"] ) .'<sup>o</sup>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-6">';

							$weth = strtolower( $w_weath["condition"]["text"] );

							if(preg_match('(rain|rainy|drizzle)', $weth) == 1) {

								if(preg_match('(thunder|shower|outbreak)', $weth) == 1) {

									echo '<div class="wheather"><div class="stormy rainy animated pulse infinite"><div class="shadow"></div></div><div class="sub-wheather"><div class="thunder"></div><div class="rain"><div class="droplet droplet1"></div><div class="droplet droplet2"></div><div class="droplet droplet3"></div><div class="droplet droplet4"></div><div class="droplet droplet5"></div><div class="droplet droplet6"></div></div><div class="tornado"><div class="wind wind1"></div><div class="wind wind2"></div><div class="wind wind3"></div><div class="wind wind4"></div></div></div></div>';

								}else{

									echo '<div class="wheather"><div class="stormy rainy animated pulse infinite"><div class="shadow"></div></div><div class="sub-wheather"><div class="rain"><div class="droplet droplet1"></div><div class="droplet droplet2"></div><div class="droplet droplet3"></div><div class="droplet droplet4"></div><div class="droplet droplet5"></div><div class="droplet droplet6"></div></div></div></div>';
								}
							}

							if(preg_match('(sun|clear|sunny)', $weth) == 1) {

								echo '<div class="suny"> <div class="sun animated pulse infinite"> </div><div class="mount"></div><div class="mount mount1"></div><div class="mount mount2"></div></div>';
							}

							if(preg_match('(snow|blizzard|ice|sleet)', $weth) == 1) {

								echo '<div class="snowy rainy animated pulse infinite"></div><div class="sub-wheather snowy-sub-wheather"><div class="rain"><div class="droplet droplet1"></div><div class="droplet droplet2"></div><div class="droplet droplet3"></div><div class="droplet droplet4"></div><div class="droplet droplet5"></div><div class="droplet droplet6"></div></div><br><br><div class="mount"></div><div class="mount mount1"></div><div class="mount mount2"></div></div>';
							}


							if(preg_match('(cloud|overcast|mist|fog)', $weth) == 1) {

								echo '<div class="mostly-suny suny">
								<div class="sun animated pulse infinite"></div>
								<div class="mount mount"></div><div class="mount mount1"></div>
								<div class="cloudy animated pulse infinite"></div>
							</div>';
						}
						echo '</div></div>';
					}
					?>

					<div class="col-md-3">
						<div class="panel">
							<span data-toggle="tooltip" data-placement="top" title="Notification Control">
								<div class="panel-body text-left">
									<h5><i class="fa fa-phone"></i> Mobile Nofication
										<span id="notif_mobile_status"

										<?php
										if (strtoupper($user_data['notif_mobile']) == 'ON') {
											echo 'class="label label-success"';
										}else{
											echo 'class="label label-danger"';
										}
										?>

										><?php echo strtoupper($user_data['notif_mobile']); ?></span>
									</h5>
									<div class="mini-onoffswitch onoffswitch-success">
										<input type="checkbox" name="notif_mobile" class="onoffswitch-checkbox" id="notif_mobile"
										<?php
										if (strtoupper($user_data['notif_mobile']) == 'ON') {
											echo 'checked';
										}
										?>
										><label class="onoffswitch-label" for="notif_mobile"></label>
									</div>


									<h5><i class="fa fa-envelope"></i> Email Nofication
										<span id="notif_email_status"
										<?php
										if (strtoupper($user_data['notif_email']) == 'ON') {
											echo 'class="label label-success"';
										}else{
											echo 'class="label label-danger"';
										}
										?>
										><?php echo strtoupper($user_data['notif_email']); ?></span>
									</h5>
									<div class="mini-onoffswitch onoffswitch-success">
										<input type="checkbox" name="notif_email" class="onoffswitch-checkbox" id="notif_email"
										<?php
										if (strtoupper($user_data['notif_email']) == 'ON') {
											echo 'checked';
										}
										?>
										>
										<label class="onoffswitch-label" for="notif_email"></label>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="col-md-12">
						<?php

						if (count($event_data) != 0) {

							echo '<div class="col-md-8"><div class="panel box-v4"><div class="panel-heading bg-white border-none"><h3 style="color: #2d0101;"><i class="fa fa-calendar"></i> Upcoming Events</h3></div><div class="panel panel-default">';

							foreach ($event_data as $r) {
								echo '<div class="panel-body">
								<h3 class="animated fadeInUp">'. ucwords($r['title']) .'</h3><p>
								<span data-toggle="tooltip" data-placement="bottom" title="Event Venue">
									<i class="fa fa-map-marker"></i> '. ucwords($r['location']) .'
								</span> &nbsp; | &nbsp; 

								<span data-toggle="tooltip" data-placement="bottom" title="Event Type">
									<i class="fa fa-sitemap"></i> '. ucfirst($r['event_type']) .'</p>
								</span>

								<b><i class="fa fa-clock-o"></i> From:</b> '. date('D, M jS Y',$r['from_date_time']) .'&nbsp; | &nbsp; 

								<b><i class="fa fa-clock-o"></i> To:</b> '. date('D, M jS Y',$r['to_date_time']) .'
								<h4>'. ucwords($r['description']) .'</h4>
								
							</div><hr style="margin: 0;">';
						}

						echo '</div></div></div>';
					}

					if (count($notice_data) != 0) {

						echo '<div class="col-md-4">
						<div class="panel bg-white">

							<h3 class="text-center" style="padding-top: 20px; ">Notice Board</h3><hr style="border-top: 1px solid #0006;">';

							foreach ($notice_data as $r) {

								echo '<div class="panel-body ">
								<h4 class="animated fadeInDown ">'. ucwords($r['title']) .'</h4>
								<div class="col-md-12 padding-0">
									<div class="text-left col-md-7 col-xs-12 col-sm-7 padding-0">

										<i class="fa fa-calendar fa-lg"></i><i> '. date('D, M jS Y',$r['from_date']) .'</i> &nbsp; &nbsp; 
										<i class="fa fa-clock-o fa-lg"></i><i> '.$r['to_date'].'</i>									
									</div><div style="padding-top:8px;" class="text-right col-md-5 col-xs-12 col-sm-5 padding-0">

									<i class="fa fa-sitemap"></i> '. ucfirst($r['type']) .'

								</div></div></div><hr style="border-top: 1px solid #0003;">';
							}

							echo '</div></div>';

						}

						?>

					</div>
				</div>
				<?php
				include($path['_files'].'footer.php');
				?>
			</div>
		</div>

		<?php
		include($path['_files'].'nav_mobile.php');
		include($path['_files'].'js.php');
		?>
		<script src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
		<script src="<?php echo $url['_asset'];?>js/plugins/select2.full.min.js"></script>


		<script type="text/javascript">
			$(document).ready(function(){

				$('.dateAnimate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, animation:true, format : 'DD MMMM YYYY' });

				$(".select2-C").select2({
					placeholder: "Select Option",
					allowClear: true
				});


				$("#select_date").change(function() {

					var input_date = $('#select_date').val()
					var user_dob = $('#user_dob').val()

					var dob1 = new Date(input_date);
					var dob2 = new Date(user_dob);
					var age = Math.floor(( dob1 - dob2 ) / (365.25 * 24 * 60 * 60 * 1000));

					if (parseInt(age) <= 0 ) {
						$('#age_on').text('You were not born yet');
					}else{							
						$('#age_on').text(parseInt(age) + ' Years Old');
					}

				});


				function ajax_call(status, type){
					var data = JSON.stringify( { "status": status, "type": type } );

					$.ajax({
						type: "POST",
						url: "<?php echo $url['_modules'].'notification.php'; ?>",
						data: data,
						dataType: 'json',
						contentType: 'application/json',
						success: function(data){

							if (type == "mobile") {

								if (data['st'] == 'on') {
									$("#notif_mobile_status").text("ON");
									$("#notif_mobile_status").removeClass("label label-danger").addClass("label label-success");
								}else{
									$("#notif_mobile_status").text("OFF");
									$("#notif_mobile_status").removeClass("label label-success").addClass("label label-danger");
								}
							}

							if (type == "email") {

								if (data['st'] == 'on') {
									$("#notif_email_status").text("ON");
									$("#notif_email_status").removeClass("label label-danger").addClass("label label-success");
								}else{
									$("#notif_email_status").text("OFF");
									$("#notif_email_status").removeClass(" labellabel-success").addClass("label label-danger");
								}
							}

						},
						error : function(one, status, err){
							console.log(status);
						}
					});
				}

				$("#notif_mobile").click(function(){
					var radioValue = $("#notif_mobile:checked").val();

					if(radioValue){
						ajax_call("on", "mobile");

					}else{
						ajax_call("off", "mobile");
					}

				});


				$("#notif_email").click(function(){
					var radioValue = $("#notif_email:checked").val();
					if(radioValue){
						ajax_call("on", "email");
					}else{
						ajax_call("off", "email");
					}

				});


				$("#select").on('change',function(e){
					e.preventDefault();
					var val = $(this).val();    
					console.log(val);

					$.ajax({
						type: "POST",
						url: "<?php echo $url['_modules'].'home.php';?>",
						data:{val:val},
						success:function(data){
							console.log(data);
							$('#report_count').text(data);
						}
					});
				});

				$("#myCarousel").carousel({interval: 3000});

			});

		</script>	

	</body>
	</html>