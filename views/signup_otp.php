<?php
session_start();
require_once realpath(__DIR__).'/../config/config.php';

if (!isset($_SESSION['signup_otp1']) && !isset($_SESSION['signup_otp2'])) {
	header('location: '.$url['_base'].'index.php?action=signup');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>SIGNUP OTP  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	
</head>

<body id="mimin" class="dashboard form-signin-wrapper">

	<div class="container">
		<div id="content">

			<div class="form-element ">
				<div class="col-md-12 col-sm-12 col-xs-12 padding-0">
					<div class="col-md-8 col-sm-12 col-xs-12">
						<div class="panel form-element-padding">
							<div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">

									<div class="col-md-12 text-center">
										<h3>Hello, <?php echo ucwords($_SESSION['signup_name']); ?></h3>
										<h5>Fill out the following data to proceed</h5>
										<br>
									</div>
									

									<div id="verify_otp_section">

										<div class="col-md-6 form-group form-animate-text">
											<h4>
												<i class="fa fa-mobile fa-lg"></i> Mobile OTP <span style="color: #F44336">*</span>
											</h4>
											<input type="text" class="form-text" name="otp_mobile" autocomplete="off" maxlength="4" maxlength="4" required autofocus>
											<span class="bar"></span>
											
										</div>

										<div class="col-md-6 form-group form-animate-text">

											<h4>
												<i class="fa fa-envelope"></i> E-Mail OTP <span style="color: #F44336">*</span>
											</h4>
											<input type="text" class="form-text" name="otp_email" autocomplete="off" required maxlength="4" minlength="4">
											<span class="bar"></span>
											
										</div>


										<div class="alert col-md-12 col-sm-12 alert-icon alert-dismissible fade in" role="alert" id="myalert" style="display: none;">
											<div class="col-md-2 col-sm-2 icon-wrapper text-center">
												<span class="fa fa-flash fa-2x"></span></div>
												<div class="col-md-10 col-sm-10">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
													<h5 id="myalert_msg"></h5>
												</div>
											</div>


											<div class="text-center">
												<button class="btn btn-info" id="verify_otp">
													Verify OTP
												</button><br><br><br>
												<a href="<?php echo $url['_base'];?>index.php?action=signup">Signup</a>

											</div>

										</div>


										<div style="display: none;" id="rest_data_section">

											<form action="<?php echo $url['_base'];?>index.php?action=signup" method="post">

												<div class="row" name="validate_gender" >
													<h4 class="col-md-4 text-left">
														<i class="fa fa-mars" aria-hidden="true"></i> Gender <span style="color: #F44336">*</span>
													</h4>
													<div class="col-md-8">
														<input id="m_gender" type="radio" value="male" name="signup_gender" required>
														<label for="m_gender">MALE</label>
														&nbsp; | &nbsp;
														<input id="f_gender" type="radio" value="female" name="signup_gender" required>
														<label for="f_gender">FEMALE</label>
														&nbsp; | &nbsp;

													</div>
												</div><br>

												<div class="row">
													<h4 class="col-md-5 text-left">
														<i class="fa fa-tint"></i> Blood Group 
														<span style="color: #F44336">*</span>
													</h4>
													<div class="col-md-5">
														<select name="signup_blood">
															<option value="">Select Blood Group</option>
															<option value="a+">A+</option>
															<option value="a-">A-</option>
															<option value="b+">B+</option>
															<option value="b-">B-</option>
															<option value="o+">O+</option>
															<option value="o-">O-</option>
															<option value="ab+">AB+</option>
															<option value="ab-">AB-</option>
														</select>
													</div>
												</div><br>

												<div class="row">
													<h4 class="col-md-5 text-left">
														<i class="fa fa-bars"></i> Initial
														<span style="color: #F44336">*</span>
													</h4>
													<div class="col-md-5">
														<select  name="signup_initial">
															<option value="">Select Initial</option>
															<option value="Mr.">Mr.</option>
															<option value="Miss.">Miss</option>
															<option value="Mrs.">Mrs.</option>
														</select>
													</div>
												</div><br>

												<div class="row">
													<h4 class="col-md-5 text-left">
														<i class="fa fa-key"></i> Password
														<span style="color: #F44336">*</span>
													</h4>
													<div class="col-md-5">
														<input type="Password" id="password" name="signup_password" class="form-control" placeholder="Password"><span toggle="#password" class="fa fa-eye fa-lg field-icon toggle-password" style="float: right;"></span>
													</div>
												</div><br>

												<div class="text-center">
													<input type="submit" class="btn btn-success btn-lg" value="Create My Account" id="submit_button" name="complete_signup">
												</div>
											</form>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end: content -->

		</div>


		<?php
		include($path['_files'].'org_label.php');
		include($path['_files'].'js.php');
		?>
		<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){

				$("input[name='otp_mobile'").on("input", function(){
					if($(this).val().length >= 4){
						$("input[name='otp_email'").focus();
					}
				});

				$("input[name='otp_email'").on("input", function(){
					if($(this).val().length >= 4){
						$("#verify_otp").focus();
					}
				});


				$("#verify_otp").focus(function(){
					$(this).removeClass("btn-info").addClass("btn-primary");

				}).blur(function(){
					$(this).removeClass("btn-primary").addClass("btn-info");
				})



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
					errorElement: "em",
					errorPlacement: function(error, element) {
						$(element.parent("div").addClass("form-animate-error"));
						error.appendTo(element.parent("div"));
					},
					success: function(label) {
						$(label.parent("div").removeClass("form-animate-error"));
					},
					rules: {
						otp_mobile: {
							required: true,
							minlength: 4,
							maxlength: 4
						},
						otp_email: {
							required: true,
							minlength: 4,
							maxlength: 4
						},
						validate_gender: "required",
						validate_intrest: "required",
						validate_blood: "required",
						validate_initial: "required"
					},
					messages: {
						otp_mobile: {
							required: "Please Enter Mobile OTP",
							minlength: "Your Mobile OTP must be of 4 characters",
							maxlength: "Your Mobile OTP must be of 4 characters"
						},
						otp_email: {
							required: "Please Enter Email OTP",
							minlength: "Your Email OTP must be of 4 characters",
							maxlength: "Your Email OTP must be of 4 characters"
						},
						validate_gender: "Please select one option",
						validate_intrest: "Please select area of interst",
						validate_blood: "Please select blood group",
						validate_initial: "Please select an initial"
					}
				});


			///////////////////////////////////////////    VERIFY OTP AJAX
			$("#verify_otp").parent().on("click","#verify_otp", function (e) {
				e.preventDefault();

				var mobile_otp = $("input[name='otp_mobile']").val();
				var email_otp= $("input[name='otp_email']").val();
				var data = JSON.stringify( { "mobile": mobile_otp, "email": email_otp } );

				$.ajax({
					type: "POST",
					url: "<?php echo $url['_modules'].'signup_otp.php'; ?>",
					data: data,
					dataType: 'json',
					contentType: 'application/json',
					success: function(data){

						if ((data['res1'] == 1) && (data['res2'] == 1)) {

							$("input[name='otp_mobile']").prop("disabled", true);
							$("input[name='otp_email']").prop("disabled", true);
							$("#myalert").show("slow");
							$("#myalert").addClass("alert-success").removeClass("alert-danger");
							$("#myalert_msg").html('<h4 class="text-center">OTP verified successfully</h4>').show("slow");
							$("#verify_otp").removeClass("btn-info").addClass("btn-success");
							$("#verify_otp").text("Continue SignUp");
							$("#verify_otp").prop('id', 'con_signup');

						}else{

							if(data['res1'] != 1){ var xx = data['res1']; }else{var xx = ''; }
							if(data['res2'] != 1){ var yy = data['res2']; }else{var yy = ''; }
							$("#myalert").addClass("alert-danger");
							$("#myalert").show("slow");
							$("#myalert_msg").html(xx+yy).show("slow");
							
							if( (data['res1'] != 1 ) && (data['res2'] == 1 ) ){ $("input[name='otp_mobile']").focus(); }
							if( (data['res1'] == 1 ) && (data['res2'] != 1 ) ){ $("input[name='otp_email']").focus(); }
							if( (data['res1'] != 1 ) && (data['res2'] != 1 ) ){ $("input[name='otp_mobile']").focus(); }
							
						}

					},
					error : function(one, status, err){
						//console.log(status);
					}
				});
			}).on("click","#con_signup",function (e) {
				e.preventDefault();

				$("#verify_otp_section").hide("slow");
				$("#rest_data_section").slideUp("800").delay("1500").show("slow");

			});
		});

	</script>
</body>
</html>