<?php require_once realpath(__DIR__).'/../config/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>SIGNUP  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $url['_asset'];?>css/plugins/icheck/skins/flat/aero.css">

	<link rel="stylesheet" type="text/css" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
	<style type="text/css">.dtp > .dtp-content { max-width: 345px; }</style>


</head>

<body id="mimin" class="dashboard form-signin-wrapper">

	<div class="container">  

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<form class="form-signin" id="signupForm" action="<?php echo $url['_base'];?>index.php?action=signup" method="post">
					<div class="panel periodic-login">
						<div class="panel-body text-center">
							
							<h3 style="margin-top: 0;"><?php echo $site['title']; ?></h3>
							<h4>Signup</h4>

							<?php

							if (!isset($st)) {
								
								?>

								<div class="row">
									<div class="col-md-6 form-group form-animate-text" style="margin-top:20px !important;">

										<input type="text" class="form-text" name="input_name" autocomplete="off" required autofocus>

										<span class="bar"></span>
										<label><i class="fa fa-user"></i> Name <span style="color: red">*</span></label>
									</div>

									<div class="col-md-6 form-group form-animate-text" style="margin-top:20px !important;">

										<input type="text" class="form-text" name="input_mobile" autocomplete="off" required >

										<span class="bar"></span>
										<small style="color: #3e3c3c">10 digits only</small>
										<label><i class="fa fa-mobile"></i> Mobile <span style="color: red">*</span></label>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 form-group form-animate-text" style="margin-top:20px !important;">

										<input type="email" class="form-text" name="input_email" autocomplete="off" required>

										<span class="bar"></span>
										<label><i class="fa fa-envelope"></i>
											Email <span style="color: red">*</span></label>
										</div>

										<div class="col-md-6 form-group form-animate-text" style="margin-top:20px !important;">

											<input type="text" class="form-text dateAnimate" name="input_dob" required>
											<span class="bar"></span>
											<label><i class="fa fa-calendar"></i> Date of Birth <span style="color: red">*</span></label>
										</div>

									</div>
									<div class="row">
										<input type="submit" class="btn btn-success btn-md" value="Create Account" name="signup_submit" style="margin-top:10px">
									</div>
								</div>


								<?php

							}else{
								echo $data;
							}

							?>


							<div class="text-center" style="padding:5px;">
								<a href="<?php echo $url['_base'];?>index.php?action=login">Already have account? Login</a>
							</div>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>


	<?php
	include($path['_files'].'org_label.php');
	include($path['_files'].'js.php');
	?>
	<script src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
	<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('.dateAnimate').bootstrapMaterialDatePicker({format : 'DD-MM-YYYY', weekStart : 0, time: false, animation:true }); 


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
					validate_name: {
						required: true,
						minlength: 3,
						maxlength: 20
					},
					validate_mobile: {
						required: true,
						minlength: 10,
						maxlength: 10,
						number: true
					},
					validate_email: {
						required: true,
						email: true
					},
					validate_blood: {
						required: true
					}

				},
				messages: {
					validate_name: {
						required: "Please enter name",
						minlength: "Your name must consist of at least 3 characters",
						maxlength: "Your name must consist of at least 20 characters"
					},
					validate_mobile: {
						required: "Please enter mobile",
						minlength: "Your mobile must be 10 characters long",
						maxlength: "Your mobile must be 10 characters long"
					},
					validate_email: "Please enter a valid email address",
					validate_dob: "Please enter date of birth"


				}
			});

		});

	</script>
	<!-- end: Javascript -->
</body>
</html>