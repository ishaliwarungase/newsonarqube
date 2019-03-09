
<?php require_once realpath(__DIR__).'/../config/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>NOTIFICATION  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>


</head>

<body id="mimin" class="dashboard">
	<?php
	include($path['_files'].'nav_web.php');
	?>

	<div class="container-fluid mimin-wrapper">

		<?php
		$side = 8;
		include($path['_files'].'sidebar.php');
		?>

		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Notification</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp;
							Notification
						</p>
					</div>
				</div>
			</div>

			<div class="row">

			<!-- //////////////////  SMS /////////////////////////////// -->

				<div class="col-md-6 top-20">

					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="panel">
								<div class="panel-heading" style="background-color:#ff4343">
									<h4 class="text-center" style="color: black">SMS Notification</h4>
								</div>

								<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=notification" method="post">
									<div class="panel periodic-login">

										<div class="panel-body text-center">

											<div class="row">

												<div class="col-md-12 form-group form-animate-text">
												<h4 class="text-left"><i class="fa fa-bars"></i> Message
													<span style="color: #F44336">*</span>
												</h4>
													<textarea class="form-text" name="notif_sms_message" autocomplete="off" required onkeyup="smsCountChar(this)"></textarea>
													<span class="bar"></span>
													<span id="smsCharNum"></span>
												</div>

												<div class="col-md-12 form-group form-animate-text">
												<h4 class="text-left"><i class="fa fa-sitemap"></i> Member Type
													<span style="color: #F44336">*</span>
												</h4>
													<select class="col-md-12 form-text" name="notif_sms_user_type" required>
														<option value="">Select Member Type</option>
														<option value="all">All</option>
														<option value="admin">Admin</option>
													</select>
												</div>
											</div>

											<?php echo $msg1;?>

											<input type="submit" name="notif_sms_submit" class="btn btn-success" value="Notify via SMS"/>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

	<!-- ////////////////// Mobile /////////////////////////////// -->
		
				<div class="col-md-6 top-20 padding-0">

					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="panel">
								<div class="panel-heading" style="background-color:#ff4343">
									<h4 class="text-center" style="color: black">Mobile App Notification</h4>
								</div>

								<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=notification" method="post">
									<div class="panel periodic-login">

										<div class="panel-body text-center">

											<div class="row">

												<div class="col-md-12 form-group form-animate-text">
													<h4 class="text-left"><i class="fa fa-bars"></i> Title
														<span style="color: #F44336">*</span>
													</h4>
														<input type="text" class="form-text title" name="title" autocomplete="off" required autofocus>
														<span class="bar"></span>
													</div>

												<div class="col-md-12 form-group form-animate-text">
												<h4 class="text-left"><i class="fa fa-file-text"></i> Message
													<span style="color: #F44336">*</span>
												</h4>
													<textarea class="form-text message" name="message" autocomplete="off" required autofocus onkeyup="mobCountChar(this)"></textarea>
													<span class="bar"></span>
													<span id="mobCharNum"></span>
												</div>
											</div>

											<div class="text-center" id="ajax-alert"></div>		

											<input type="submit" name="notif_sms_submit" class="btn btn-success send" value="Notify via APP"/>

										</div>
										
									</form>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>


	<!-- ///////////////////////////////  Email /////////////////////////////// -->

				<div class="row">
					<div class="col-md-12 top-20 padding-0">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<div class="panel">
									<div class="panel-heading" style="background-color:#ff4343"><h4 class="text-center" style="color: black">E-Mail Notification</h4>

									</div>

									<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=notification" method="post" enctype="multipart/form-data">
										<div class="panel periodic-login">

											<div class="panel-body text-center">

												<div class="row">

													<div class="col-md-12 form-group form-animate-text">
													<h4 class="text-left"><i class="fa fa-bars"></i> Title
														<span style="color: #F44336">*</span>
													</h4>
														<textarea class="form-text" name="notif_email_title" autocomplete="off" required autofocus></textarea>
														<span class="bar"></span>
													</div>


													<div class="col-md-12 form-group form-animate-text">

													<h4 class="text-left"><i class="fa fa-file-text"></i> Message
														<span style="color: #F44336">*</span>
													</h4>
														<textarea class="form-text" name="notif_email_message" autocomplete="off" rows="5" required autofocus></textarea>
														<span class="bar"></span>
													</div>

													<div class="col-md-12 form-group form-animate-text">
													<h4 class="text-left"><i class="fa fa-sitemap"></i> Member Type
														<span style="color: #F44336">*</span>
													</h4>
														<br>
														<select class="col-md-12 form-text" name="notif_email_user_type" required>
															<option value="">Select Member Type</option>
															<option value="all">All</option>
															<option value="admin">Admin</option>

														</select>

													</div>

												</div>

												<div class="row">

													<h4><i class="fa fa-picture-o"></i> Attach Images</h4>
													<p><small>Not mandatory</small></p>

													<div class="col-md-5 col-md-offset-1 form-group ">
														<h5 style="float: left;"><i class="fa fa-picture-o"></i> Image 1</h5><br><br>
														<input type="file" class="form-text" name="notif_email_image1" accept="image/*">
													</div>

													<div class="col-md-5 col-md-offset-1 form-group ">
														<h5 style="float: left;"><i class="fa fa-picture-o"></i> Image 2</h5><br><br>
														<input type="file" class="form-text"  name="notif_email_image2" accept="image/*">
													</div>

												</div><br>

												<?php echo $msg2;?>

												<input type="submit" name="notif_email_submit" class="btn btn-success" value="Notify via Email"/>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>



					<!-- ////////////////////////////////////////////////////////// -->

				<!-- end: content -->
			</div>
			</div>
				<?php
					include($path['_files'].'footer.php');
				?>


			<?php
			include($path['_files'].'nav_mobile.php');
			include($path['_files'].'js.php');
			?>
			<!-- plugins -->
			<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>
			<script src="jquery.charactercounter.js"></script>

			<script>
				function smsCountChar(val) {
					var len = val.value.length;
					if (len >= 160) {
						val.value = val.value.substring(0, 160);
					} else {
						$('#smsCharNum').text((160 - len) + " Characters Left");

					}
				};
			</script>

			<script>
				function mobCountChar(val) {
					var len = val.value.length;
					if (len >= 160) {
						val.value = val.value.substring(0, 160);
					} else {
						$('#mobCharNum').text((160 - len) + " Characters Left");
					}
				};
			</script>

			<script type="text/javascript">
				$(document).ready(function(){


				$(".send").click(function(e) {
					var title = $('.title').val();
					var message = $('.message').val();
					
					var arr = { 'title' : title, 'message' : message };

					$.ajax({
						url: '<?php echo $url['_api']; ?>call=send_notification',
						method: 'POST',
						data: JSON.stringify(arr),
						contentType: 'application/JSON',
						dataType: "json",
						success: function(res) {

							if(res.st == 1){
								$('.title').val('');
								$('.message').val('');
								
									$("#ajax-alert").addClass("alert alert-success alert-raised alert-dismissible").text(res.msg);
									$("#ajax-alert").alert();
									$("#ajax-alert").fadeTo(5500, 1700).slideUp(1700, function(){
								
								});
								
								// alert(res.msg);
							}else{
								alert(res.msg);
							}

						},
						error : function(one, status, err){
							console.log(err);
						}
					});

					e.preventDefault();
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
								maxlength: 50
							},
							type: {
								required: true
							},
						},
						messages: {
							validate_title: {
								required: "Please Enter Notice Title",
								minlength: "Your title must consist of at least 3 characters",
								maxlength: "Your title must be less than 50 characters"
							},
							type: {
								required: "Please select a Notice Type"
							},
						}
					});

				});

				$(".alert").fadeTo(5500, 1700).slideUp(1700, function(){
					$(".alert").slideUp(1700);
				});

			</script>

		</body>
		</html>