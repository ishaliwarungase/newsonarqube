<?php require_once realpath(__DIR__).'/../config/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>PAYMENT  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>

    <link rel="stylesheet" type="text/css" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
	<style type="text/css">.dtp > .dtp-content { max-width: 345px; }</style>
	<link rel="stylesheet" type="text/css" href="<?php echo $url['_asset'];?>css/plugins/select2.min.css"/>

</head>

<body id="mimin" class="dashboard">
	<?php
	include($path['_files'].'nav_web.php');
	?>
	<div class="container-fluid mimin-wrapper">

		<?php
		$side = 6;
		include($path['_files'].'sidebar.php');
		?>

		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Create Payment</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<a href="<?php echo $url['_base'];?>index.php?action=payment"> Manage Payment</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							Create Payment
						</p>
					</div>
				</div>
			</div>


			<div class="col-md-12 top-20 padding-0">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						
						<div class="panel periodic-login">
							<div class="panel-heading" style="background-color: #ff4343;">
								<a href="<?php echo $url['_base'];?>index.php?action=payment" class="btn btn-danger btn-xs ">
									<i class="fa fa-arrow-circle-left"></i> Back
								</a>
							</div>

							<!-- FORM START -->

							<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=payment" method="post">
								<div class="panel-body text-center">

								<input type="hidden" name="user_id" value="" id="non_mem_id">

									<div class="row text-center">
										<div class="col-md-12">
											<label class="checkbox-inline">
												<input type="checkbox" class="checkbox" type="checkbox" name="check_non_mem" id="check_non_mem"> &nbsp; 
												<h4 class="label label-info">Non-Member</h4> 
											</label>
										</div>
									</div>

									<div class="row" id="check_member">
										<div class="col-md-12 form-group form-animate-text"><br>
											<h4 class="text-left"><i class="fa fa-user"></i> Member <span style="color: #F44336">*</span></h4>
											<?php

											$db = conn();
											$qrr = $db->prepare("SELECT id, name, membership_id, initial, email, mobile, flat_house_no, society_building, area, sector, sub_sector, city_node, pincode FROM nmba_user WHERE membership_status != 'expired'");
											$qrr->execute();

											if ($qrr->rowCount() > 0) {	

												echo '<select class="col-md-12 form-text select2-A" id="validate_user" name="validate_user">
												<option value="">Select Member</option>
												';

												while($r = $qrr->fetch(PDO::FETCH_ASSOC)){

													$name = ucwords($r['initial']).' '.ucwords($r['name']).' [ '.$r['membership_id'].' ]';
													$email = $r['email'];
													$mobile  = $r['mobile'];
													$address = ucwords($r['flat_house_no']).' '.ucwords($r['society_building']).','.ucfirst($r['sector']).ucfirst($r['sub_sector']).','.$r['area'].','.$r['city_node'].'. '.$r['pincode'];

													if(trim(str_replace(".", "", str_replace(",", "", $address))) == ''){
														$address = "No address available";
													}

													$value_data = $r['id'].'##'.$name .'##'. $mobile .'##'. $email .'##'. $address;

													echo '<option value=" '.$value_data.' ">'.$name.'</option>';
												}
												echo'</select>';

											}else{
												$user_data = 'Invalid input: User doesnt exists';
											}

											?>

										</div>
									</div>

									<div id="check_non_member" style="display: none">
										<div class="row">

											<div class="col-md-6 form-group form-animate-text"><br>
												<h4 class="text-left"><i class="fa fa-user"></i> Name <span style="color: #F44336">*</span></h4>

												<input type="text" class="form-text" id="non_mem_name" name="non_mem_name" required maxlength="15" minlength="3">
												<span class="bar"></span>

											</div>

											<div class="col-md-6 form-group form-animate-text"><br>
												<h4 class="text-left"><i class="fa fa-phone"></i> Mobile <span style="color: #F44336">*</span></h4>
												<input type="text" class="form-text" id="non_mem_mobile" name="non_mem_mobile" required>
												<span class="bar"></span>

											</div>

										</div>

										<div class="row">

											<div class="col-md-6 form-group form-animate-text"><br>
												<h4 class="text-left"><i class="fa fa-envelope"></i> E-Mail <span style="color: #F44336">*</span></h4>

												<input type="text" class="form-text" id="non_mem_email" name="non_mem_email" required >
												<span class="bar"></span>

											</div>

											<div class="col-md-6 form-group form-animate-text"><br>
												<h4 class="text-left"><i class="fa fa-address-card"></i> Address <span style="color: #F44336">*</span></h4>
												<input type="text" class="form-text" id="non_mem_address" name="non_mem_address" required>
												<span class="bar"></span>

											</div>

										</div>
									</div>


									<div class="row">

										<div class="col-md-6 form-group form-animate-text">

											<h4 class="text-left"><i class="fa fa-sitemap"></i> Payment Type <span style="color: #F44336">*</span></h4>
											<select class="col-md-12 form-text"  name="validate_type" required>
												<option value="">Select Payment Type</option>
												<option value="donation">Donation</option>
												<option value="charity">Charity</option>
												<option value="Subscription">Subscription</option>
												<option value="Membership Payment" id="mem_payment">Membership Payment</option>
											</select>

										</div>

										<div class="col-md-6 form-group form-animate-text">

											<h4 class="text-left"><i class="fa fa-money"></i> Payment Method <span style="color: #F44336">*</span></h4>
											<select class="col-md-12 form-text" name="validate_method">
												<option value="">Select Payment Method</option>
												<option value="cash">Cash</option>
												<option value="cheque">Cheque</option>
												<option value="dd">DD</option>
												<option value="online payment">Online Payment</option>
											</select>
										</div>

									</div>

									<div class="row">

										<div class="col-md-6 form-group form-animate-text"><br>
											<h4 class="text-left"><i class="fa fa-file-text"></i> Reciept No. <span style="color: #F44336">*</span></h4>

											<input type="text" class="form-text" id="validate_reciept" name="validate_reciept" required maxlength="15" minlength="3">
											<span class="bar"></span>

										</div>

										<div class="col-md-6 form-group form-animate-text"><br>
											<h4 class="text-left"><i class="fa fa-money"></i> Amount <span style="color: #F44336">*</span></h4>
											<input type="text" class="form-text mask-money" id="validate_amt" name="validate_amt" required>
											<span class="bar"></span>

										</div>

									</div>

									<div class="row">

										<div class="col-md-6 form-group form-animate-text"><br>
											<h4 class="text-left"><i class="fa fa-calendar"></i> Payment Date<span style="color: #F44336">*</span></h4>
											<input type="text" class="form-text dateAnimate" id="validate_date" name="validate_date" required>
											<span class="bar"></span>

										</div><br>

										<div class="col-md-6 form-group form-animate-text">
											<div id="renewal_fees" style="display: none;">

												<h4 class="text-left"><i class="fa fa-calendar"></i> Membership Renewal Fees:<span style="color: #F44336">*</span></h4>
												<select class="form-text" name="validate_paid_year">
													<option value="">Not Applicable</option>
													<option value="2018-2019">2018-2019</option>
													<option value="2019-2020">2019-2020</option>
													<option value="2020-2021">2020-2021</option>
													<option value="2021-2022">2021-2022</option>
													<option value="2022-2023">2022-2023</option>
													<option value="2023-2024">2023-2024</option>
													<option value="2024-2025">2024-2025</option>
												</select>
											</div>
										</div>


									</div>

									<div class="row">
										<div class="col-md-12 form-group form-animate-text text-left">
											<h4 ><i class="fa fa-commenting"></i> Comment:</h4>
											<input type="text" class="form-text" name="comment" autocomplete="off" >
											<span class="bar"></span>
										</div>
									</div>

									<input type="submit" name="payment_submit" class="btn btn-success" value="Save Details"/>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
			include($path['_files'].'footer.php');
			?>

		</div>
		<!-- end: content -->
	</div>

	<?php
	include($path['_files'].'nav_mobile.php');
	include($path['_files'].'js.php');
	?>
	<!-- plugins -->
	<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>
	<script src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

	<!-- custom -->
	<script src="<?php echo $url['_asset'];?>js/main.js"></script>
	<script src="<?php echo $url['_asset'];?>js/plugins/select2.full.min.js"></script>
	<script src="<?php echo $url['_asset'];?>js/plugins/jquery.mask.min.js"></script>


	<script type="text/javascript">
		$(document).ready(function(){

			 $("#validate_user").change(function(){
			
					var data = $(this).val();
					var arr = data.split('##');

					$("#non_mem_id").val(arr[0].trim());
					$("#non_mem_name").val(arr[1]);
					$("#non_mem_mobile").val(arr[2]);
					$("#non_mem_email").val(arr[3]);
					$("#non_mem_address").val(arr[4]);
				});
			$("#check_non_mem").click(function () {

				if ($(this).is(":checked")) {

					$("#check_non_member").show();
					$("#check_member").hide();
				} else {
					$("#check_non_member").hide();
					$("#check_member").show();
				}
			});

			$("#renewal_fees").hide();
			$("select[name=validate_type]").on('change', function(){
				var val = this.value;
				
				if (val == 'Membership Payment') {
					$("#renewal_fees").show();
				}else{
					$("#renewal_fees").hide();
				}

			});


			$('#check_non_mem').click(function() {
				if ($(this).is(":checked")) {
					
					$("#mem_payment").hide();
				} else {
					$("#mem_payment").show();
				}
			});



			$(".select2-A").select2({
				placeholder: "Select Member Name",
				allowClear: true
			});
			$('.mask-money').mask('0,00,00,000', {reverse: true});
			$('.dateAnimate').bootstrapMaterialDatePicker({format : 'DD-MM-YYYY', weekStart : 0, time: false,animation:true});

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
					validate_user: {
						required: true
					},
					validate_type: {
						required: true
					},
					validate_amt: {
						required: true
						
					},
					validate_reciept: {
						required: true

					},
					validate_method: {
						required: true
					},
					validate_date: {
						required: true

					},
					validate_paid: {
						required: true
					}

				},
				messages: {
					validate_user: {
						required: "Please secect a user",
					},
					validate_type: {
						required: "Please select payment type",
					},
					validate_amt: {
						required: "Please enter payment amount",
					},
					validate_reciept: {
						required: "Please enter reciept no.",
					},
					validate_method: {
						required: "Please select payment method",
					},
					validate_date: {
						required: "Please select payment date",
					},
					validate_paid: {
						required: "Please select amount paid year",
					},
				}
			});

			


		});

	</script>

</body>
</html>