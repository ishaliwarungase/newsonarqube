<!DOCTYPE html>
<html lang="en">
<head>

	<title>LOGIN  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $url['_asset'];?>css/plugins/icheck/skins/flat/aero.css"/>


</head>

<body id="mimin" class="dashboard form-signin-wrapper">

	<div class="container">

		<form method="post" action="<?php echo $url['_base'];?>index.php?action=login" class="form-signin" id="signupForm" style="max-width: 400px" autocomplete="off">
			<div class="panel periodic-login">
				<div class="panel-body text-center">
					<h3><?php echo $site['title']; ?></h3>
					<h4>Login</h4>					

					<div class="form-group form-animate-text" style="margin-top:20px !important;">
						<input type="text" class="form-text" id="validate_name" name="user_input" required autofocus autocomplete="off">
						<span class="bar"></span>
						<label><i class="fa fa-user"></i> ID / Mobile / Email <span style="color: red">*</span> 
						</label>
					</div>
					<div class="form-group form-animate-text" style="margin-top:20px !important;">
						<input type="password" class="form-text" id="password" name="password" required autocomplete="off">
						<span toggle="#password" class="fa fa-eye fa-lg field-icon toggle-password" style="float: right;"></span>
						<span class="bar"></span>
						<label>
							<i class="fa fa-key"></i> Password <span style="color: red">*</span>
						</label>
					</div>
					<input type="submit" class="btn col-md-12" value="Login" name="login_button"/>
				</div>

				<?php if (isset($msg)) { echo $msg; }?>

				<div class="text-center" style="padding:5px;">
					<a href="<?php echo $url['_base'];?>index.php?action=forgot_password">Forgot Password?</a> &nbsp; | &nbsp; 
					<a href="<?php echo $url['_base'];?>index.php?action=signup">Signup</a>
				</div>
				
			</div>
		</form>

	<?php
	include($path['_files'].'org_label.php');
	include($path['_files'].'js.php');
	?>
	<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			$(".toggle-password").click(function() {

				$(this).toggleClass("fa-eye fa-eye-slash");
					var input = $($(this).attr("toggle"));
					if (input.attr("type") == "password") {
							input.attr("type", "text");
						} else {
							input.attr("type", "password");
						}
				});


			$("#signupForm").validate({
				errorElement: "i",
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
					password: {
						required: true,
					}
				},
				messages: {
					validate_name: {
						required: "Please Enter ID / Mobile / Email"
						
					},
					password: {
						required: "Please Enter Password"
						
					}

				}
			});

			$(".alert").fadeTo(5500, 700).slideUp(700, function(){
				$(".alert").slideUp(700);
			});

		});

	</script>


</body>
</html>