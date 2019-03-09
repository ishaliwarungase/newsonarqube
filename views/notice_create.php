<!DOCTYPE html>
<html lang="en">
<head>

<title>NOTICE  | NMBA Vashi</title>
	
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
		$side = 7;
		include($path['_files'].'sidebar.php');

		if (isset($edit_notice_res)) {
			if (!empty(array_filter($edit_notice_res))){

				$data = $edit_notice_res[0];

			}else{
				header('Location:'.$path['_base'].'index.php?action=notice');
			}
		}
		?> 

		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<?php

						if (isset($data)){
							$x = 'Edit Notice';
						}else{
							$x = 'Create Notice';
						}
						?>
						<h3 class="animated fadeInLeft"><?php echo $x;?></h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<a href="<?php echo $url['_base'];?>index.php?action=notice"> Manage Notice</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<?php echo $x;?>
						</p>
					</div>
				</div>
			</div>


			<div class="col-md-12 top-20 padding-0">

				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="panel">
							<div class="panel-heading" style="background-color: #ff4343;">
								<a href="<?php echo $url['_base'];?>index.php?action=notice" class="btn btn-danger btn-xs ">
									<i class="fa fa-arrow-circle-left"></i> Back
								</a>
							</div>

							<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=notice" method="post">
								<?php

								if (isset($data)){
									$id = 'value="'.$data['id'].'"';
								}else{
									$id = '';
								}
								
								?>
								<input type="hidden" name="nid" <?php echo $id;?> >

								<div class="panel periodic-login">

									<div class="panel-body text-center">

										<div class="row">

											<div class="col-md-12 form-group form-animate-text">
												<h4 class="text-left"><i class="fa fa-bars"></i> Notice
													<span style="color: #F44336">*</span>
												</h4>
												<?php

												if (isset($data)){
													$y = ucwords( $data['title']);
												}else{
													$y = '';
												}
												
												?>

												<textarea class="form-text" name="title"  autocomplete="off" required><?php echo $y;?></textarea>
												<span class="bar"></span>
												
											</div>

											<div class="col-md-12 form-group">
												<h4 class="text-left"><i class="fa fa-sitemap"></i> Notice Type
													<span style="color: #F44336">*</span>
												</h4>
												<?php

												$meeting = $gen_body_meeting = $other = '';
												if (isset($data)){
													if ($data['type'] == 'Meeting') { $meeting = 'selected'; }
													if ($data['type'] == 'General Body Meeting') { $gen_body_meeting = 'selected'; }
													if ($data['type'] == 'Other') { $other = 'selected'; }
												}

												?>
												<select class="col-md-12 form-text" name="type" required>
													<option value="">Select Notice Type</option>
													<option <?php echo $meeting;?> value="Meeting">Meeting</option>
													<option <?php echo $gen_body_meeting;?> value="General Body Meeting">General Body Meeting</option>
													<option <?php echo $other;?> value="Other">Other</option>
												</select>
											</div>
										</div><br>

										<div class="row">
											<div class="col-md-6 form-group form-animate-text">
												<h4 class="text-left"><i class="fa fa-calendar-plus-o"></i> Date
													<span style="color: #F44336">*</span>
												</h4>
												<?php
												if (isset($data)){
													$y = 'value="'.date('d-m-Y', $data['from_date']).'"';
												}else{
													$y = '';
												}
												?>
												<input type="text" class="form-text date-start" name="validate_sdate" <?php echo $y;?>  required>
												<span class="bar"></span>
											</div>

											<div class="col-md-6 form-group form-animate-text">

												<h4 class="text-left"><i class="fa fa-calendar-minus-o"></i> Time 
													<span style="color: #F44336">*</span>
												</h4>
												<?php
												if (isset($data)){
													$y = 'value="'.$data['to_date'].'"';
												}else{
													$y = '';
												}
												?>
												<input type="text" class="form-text time" name="validate_edate" <?php echo $y;?>  required>
												<span class="bar"></span>

											</div>
										</div>

										
										<?php
										if (isset($data)){
											$val = 'value="Update Notice"';
											$name = 'name="update_notice"';
											$color = 'class="btn btn-info"';
										}else{
											$val = 'value="Create Notice"';
											$name = 'name="notice_submit"';
											$color = 'class="btn btn-success"';
										}
										?>
										<input type="submit" <?php echo $color;?> <?php echo $val;?> <?php echo $name;?> />
									</div><br>
								</div>
							</form>
						</div>
						<?php
						if (isset($msg)) {
							if ($msg == 'success') {
								echo '<div class="alert alert-success alert-dismissible fade in" role="alert"><strong>Notice Created Successfully</strong></div>';
							}else{
								echo '<div class="alert alert-warning alert-dismissible fade in" role="alert"><strong> ERROR</strong></div>';
							}
						}
						?>
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

	<script src="<?php echo $url['_asset'];?>js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('.date-start').bootstrapMaterialDatePicker({ format : 'DD-MM-YYYY', weekStart : 0, time: false, animation:true }).on('change', function(e, date){
			});

			$('.time').bootstrapMaterialDatePicker({ format :'hh:mm A', weekStart : 0, time: true, animation:true , date: false});

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
					title: {
						required: true,
						minlength: 3,
						maxlength: 100
					},
					type: {
						required: true							  						
					},							
					validate_sdate: {
						required: true,
						
					},
					validate_edate: {
						required: true,
						
					},							

				},
				messages: {
					title: {
						required: "Please Enter Notice Title",
						minlength: "Your title must consist of at least 3 characters",
						maxlength: "Your title must be less than 100 characters"
					},
					type: {
						required: "Please select a Notice Type"
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

		$(".alert").fadeTo(5500, 11700).slideUp(11700, function(){
			$(".alert").slideUp(11700);
		});

	</script>

</body>
</html>