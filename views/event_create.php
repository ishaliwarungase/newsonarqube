<!DOCTYPE html>
<html lang="en">
<head>

<title>EVENT  | NMBA Vashi</title>
	
	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	<link rel="stylesheet" type="text/css" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
	<style type="text/css">.dtp > .dtp-content { max-width: 345px; }</style>
</head>

<body id="mimin" class="dashboard">
	<?php
	include($path['_files'].'nav_web.php');
	?>

	<div class="container-fluid mimin-wrapper">

		<?php
		$side = 5;
		include($path['_files'].'sidebar.php');

		if (isset($edit_event)) {
			if (!empty(array_filter($edit_event))){
				$data = $edit_event[0];
			}else{
				header('Location:'.$path['_base'].'index.php?action=event');
			}
		}

		?>
		<div id="content">

			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">

						<?php
						if (isset($data)){
							$x = 'Edit Event';
						}else{
							$x = 'Create Event';
						}
						?>
						<h3 class="animated fadeInLeft"><?php echo $x;?></h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<a href="<?php echo $url['_base'];?>index.php?action=event"> Manage Event</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<?php echo $x;?>
						</p>
					</div>
				</div>
			</div>


			<div class="col-md-12 top-20 padding-0">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="panel periodic-login">

							<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=event" method="post" enctype="multipart/form-data">
								<?php
								if (isset($data)){
									echo '<input type="hidden" name="eid" value="'.$data['id'].'">';
								}
								?>

								<div class="panel-heading" style="background-color: #ff4343;">
									<a href="<?php echo $url['_base'];?>index.php?action=event" class="btn btn-danger btn-xs">
										<i class="fa fa-arrow-circle-left"></i> Back
									</a>
								</div>
								<div class="panel-body text-center">

									<div class="row">
										<div class="col-md-12 form-group form-animate-text">
											<h4 class="text-left"><i class="fa fa-bars fa-md"></i> Event Title <span style="color: #F44336">*</span>
											</h4>

											<textarea class="form-text"  name="validate_title" autocomplete="off" required><?php if (isset($data)){ echo ucwords($data['title']);} ?></textarea>
											<span class="bar"></span>
											
										</div>
									</div>

									<div class="row">
										<div class="col-md-12 form-group">
											<h4 class="text-left"><i class="fa fa-sitemap fa-lg"></i> Event Type <span style="color: #F44336">*</span>
											</h4>

											<?php

											$cultural_event = $meeting = $puja = $social_event = $member_connect = $other = '';

											if (isset($data)){

												if ($data['event_type'] == 'cultural_event') {
													$cultural_event = 'selected';
												}

												if ($data['event_type'] == 'meeting') {
													$meeting = 'selected';
												}

												if ($data['event_type'] == 'puja') {
													$puja = 'selected';
												}

												if ($data['event_type'] == 'social_event') {
													$social_event = 'selected';
												}

												if ($data['event_type'] == 'member_connect') {
													$member_connect = 'selected';
												}

												if ($data['event_type'] == 'other') {
													$other = 'selected';
												}

											}
											?>

											<select class="col-md-12 form-text" name="event_type" required>
												<option value="">Select Event Type</option>
												<option <?php echo $cultural_event;?> value="cultural_event">Cultural Event</option>
												<option <?php echo $meeting;?> value="meeting">Meeting</option>
												<option <?php echo $puja;?> value="puja">Puja</option>
												<option <?php echo $social_event;?> value="social_event">Social Event</option>
												<option <?php echo $member_connect;?> value="member_connect">Member Connect</option>
												<option <?php echo $other;?> value="other">Other</option>
											</select>
										</div>
									</div><br>

									<div class="row">
										<div class="col-md-6 form-group form-animate-text">
											<h4 class="text-left"><i class="fa fa-map-marker fa-md"></i> Venue <span style="color: #F44336">*</span>
											</h4>

											<?php
											if (isset($data)) {
												$y = 'value="'.ucwords($data['location']).'"';	
											}else{
												$y = '';
											}
											?>
											<input type="text" class="form-text" name="validate_location" <?php echo $y;?> required>
											<span class="bar"></span>
											
										</div>

										<div class="col-md-6 form-group form-animate-text">
											<h4 class="text-left"><i class="fa fa-picture-o fa-md"></i> Image</h4>
											<?php
											if (isset($data)) {
												$y = 'value="'.$data['image'].'"';
											}else{
												$y = '';
											}

											?>
											<input type="file" class="form-text"  name="event_image" <?php echo $y;?> accept="image/*">
											<span class="bar"></span>		
										</div>

									</div>

									<div class="row">
										<div class="col-md-6 form-group form-animate-text">

											<h4 class="text-left"><i class="fa fa-calendar-plus-o"></i> Start Date
												<span style="color: #F44336">*</span></h4> 
												<?php
												if (isset($data)){
													$y = date('d-m-Y',$data['from_date_time']);
												}else{
													$y = '';
												}
												?>
												<input type="text" class="form-text date-start" name="validate_sdate" value="<?php echo $y;?>" required>
												<span class="bar"></span>

											</div>

											<div class="col-md-6 form-group form-animate-text">

												<h4 class="text-left"><i class="fa fa-calendar-minus-o"></i> End Date
													<span style="color: #F44336">*</span></h4>

													<?php

													if (isset($data)){
														$x = date('d-m-Y',$data['to_date_time']);
													}else{
														$x = '';
													}

													?>

													<input type="text" class="form-text date-end" name="validate_edate" value="<?php echo $x;?>" required>
													<span class="bar"></span>

												</div>

											</div>

											<div class="row">
												<div class="col-md-12 form-group form-animate-text">

													<h4 class="text-left"><i class="fa fa-file-text"></i> Description
													</h4>

													<?php
													if (isset($data)){
														$y = ucwords($data['description']);
													}else{
														$y = '';
													}
													
													?>

													<textarea class="form-text" name="description" autocomplete="off" rows="5"> <?php echo $y;?></textarea>
													<span class="bar"></span>

												</div>
											</div>

											<?php
											if (isset($data)){
												$x = 'value="Update Data"';
												$name = 'name ="update_event"';
											}else{
												$x = 'value="Create Event"';
												$name = 'name ="event_submit"';
											}
											?>

											<input type="submit" <?php echo $name;?> class="btn btn-success" <?php echo $x;?> >
										</form>


										<?php

										if (isset($data)){

											echo '
											<form id="signupForm" action="'.$url['_base'].'index.php?action=event" method="post" enctype="multipart/form-data">
											<br><br>
											<input type="hidden" name="eid" value="'.$data['id'].'" >
											<input type="submit" class="btn btn-danger btn-sm" name="event_delete" value="Remove">
											</form>';

										}
										?>

									</div>
								</div>
							</div>

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

<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>
<script src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){

				$('.date-end').bootstrapMaterialDatePicker({format : 'DD-MM-YYYY', weekStart : 0, time: false, animation:true });

				$('.date-start').bootstrapMaterialDatePicker({format : 'DD-MM-YYYY', weekStart : 0, time: false, animation:true }).on('change', function(e, date)
				{

					$('.date-end').bootstrapMaterialDatePicker('setMinDate', date);
				});



				$("#signupForm").validate({
					errorElement: "em",
					errorPlacement: function(error, element) {
						$(element.parent("div").addClass("form-animate-error"));
						error.appendTo(element.parent("div"));
					},
					success: function(label) {
						$(label.parent("div").removeClass("form-animate-error"));
					},
					rules: {
						validate_title: {
							required: true,
							minlength: 3,
							maxlength: 100
						},
						validate_location: {
							required: true,
							minlength: 3,
							maxlength: 50,						
						},							
						validate_sdate: {
							required: true,
							
						},
						validate_edate: {
							required: true,
							
						},							

					},
					messages: {
						validate_title: {
							required: "Please enter Event Title",
							minlength: "Your title must consist of at least 3 characters",
							maxlength: "Your title must be less than 100 characters"
						},
						validate_location: {
							required: "Please enter Event Location",
							minlength: "Your Location must consist of at least 3 characters",
							maxlength: "Your Location must be 50 characters"
						},							
						validate_sdate: {
							required:"Please enter Start Date"
						},
						validate_edate: {
							required:"Please enter End Date"
						},							
					}

				});

			});
		</script>

	</body>
	</html>