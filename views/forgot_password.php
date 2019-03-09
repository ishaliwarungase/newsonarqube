<?php require_once realpath(__DIR__).'/../config/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>FORGOT PASSWORD  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
</head>

<body id="mimin" class="form-signin-wrapper">

	<div class="container">

		<form class="form-signin" id="signupForm" style="max-width: 400px" action="<?php echo $url['_base'];?>index.php?action=forgot_password" method="post">

			<div class="panel periodic-login">


				<div class="panel-body text-center">
					<h2>MMS</h2>
					<h4>Recover Password</h4>

					<div class="form-group form-animate-text" style="margin-top:40px !important;">
						<input type="text" class="form-text" name="input" required autofocus autocomplete="off" minlength="3" maxlength="30" />
						<span class="bar"></span>
						<label><i class="fa fa-user"></i> 
							Member ID / Mobile / Email <span style="color: red">*</span>
						</label>
					</div>


					<br><h4><i class="fa fa-key"></i> Send password on my:</h4>

					<input id="yes" type="radio" value="mobile" name="otp_method" required checked="checked">
					<label for="yes" style="font-size: 1.3em;">Mobile</label> &nbsp; 

					<input id="no" type="radio" value="email" name="otp_method"  required>
					<label for="no" style="font-size: 1.3em;">Email</label>

					<input type="submit" class="btn col-md-12" value="Send Password" name="forgot_password_submit" />

				</div>


				<?php

				if (isset($msg)) {

					if ($msg == 'success') {
						echo '<div class="alert alert-success alert-dismissible fade in" role="alert"><strong>Password Successfully sent to '.$contact.'</strong></div>';
					}else{
						echo '<div class="alert alert-warning alert-dismissible fade in" role="alert"><strong>'.$msg.'</strong></div>';
					}
				}

				?>
				

				<div class="text-center">
					<a href="<?php echo $url['_base'];?>index.php?action=login">Login</a>
					&nbsp; | &nbsp; 
					<a href="<?php echo $url['_views'] . 'signup.php';?>">Signup</a>
				</div>
			</div>
		</form>

	</div>

	<?php
	include($path['_files'].'org_label.php');
	include($path['_files'].'js.php');
	?>
	<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>


	<script type="text/javascript">
		$(document).ready(function(){

			$("input[name='otp_method']").click(function() {

				otp_method = this.value;
				if (otp_method == 'mobile') {
					$("input[name='forgot_password_submit']").val("Send Password via SMS");
				} else if (otp_method == 'email') {
					$("input[name='forgot_password_submit']").val("Send Password via Email");
				}

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
					mobile: {
						required: true,
						minlength: 3,
						maxlength: 30
					},
					otp_method: {
						required: true
					},

				},
				messages: {
					mobile: {
						required: "Please Enter ID / Mobile / Email",
						minlength: "Your field must consist of at least {0} characters",
						maxlength: "Your field must consist at most {0} characters"
					},
					otp_method: {
						required: "Please select atleast One OTP method"
					},
				}
			});


		});


		$(".alert").fadeTo(5500, 1700).slideUp(1700, function(){
			$(".alert").slideUp(1700);
		});
	</script>

	<!-- end: Javascript -->
</body>
</html>