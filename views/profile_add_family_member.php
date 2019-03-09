<!DOCTYPE html>
<html lang="en">
<head>

<title>FAMILY  | NMBA Vashi</title>
	
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
		$side = 2;
		include($path['_files'].'sidebar.php');

		if(isset($edit_family_res)){
			if (!empty(array_filter($edit_family_res))){
				$data = $edit_family_res[0];
			}
		}

		?>

		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">
							<?php
							if (isset($data)){
								echo 'Edit Family Member';
							}else{
								echo 'Add Family Member';
							}
							?>
						</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home">Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<a href="<?php echo $url['_base'];?>index.php?action=profile">My Profile</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<?php
							if (isset($data)){
								echo 'Edit Family Member';
							}else{
								echo 'Add Family Member';
							}
							?>

						</p>
					</div>
				</div>
			</div>

			<div class="col-md-12 top-20 padding-0">

				<div class="row">
					<div class="col-md-10 col-md-offset-1">

						<form  id="signupForm" action="<?php echo $url['_base'];?>index.php?action=profile" method="post">

							<?php
							if (isset($data)){
								$id = 'value="'.$data['id'].'"';
							}else{
								$id = '';
							}
							
							?>
							<input type="hidden" name="fid" <?php echo $id;?> >

							<div class="panel periodic-login">
								<div class="panel-heading" style="background-color: #ff4343;">
									<a href="<?php echo $url['_base'];?>index.php?action=profile" class="btn btn-danger btn-xs ">
										<i class="fa fa-arrow-circle-left"></i> Back
									</a>
								</div>
								<div class="panel-body text-center">

									<div class="row">

										<div class="col-md-12 form-group form-animate-text">

											<?php

											if (isset($data)){

												$y = 'value="'.ucwords( $data['name']).'"';

											}else{
												$y = '';
											}
											?>

											<h4 class="text-left"><i class="fa fa-user"></i> Name <span style="color: red">*</span></h4>

											<input autofocus type="text" class="form-text" name="validate_name" autocomplete="off" required <?php echo $y;?> >

											<span class="bar"></span>
											
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 form-group form-animate-text">

											<h4 class="text-left"><i class="fa fa-retweet "></i> Relation <span style="color: #F44336">*</span></h4>
											<select class="col-md-12 form-text" name="validate_relation" required>
												<?php
												$daughter =	$son =	$wife =	$husband = '';
												if (isset($data)){

													if ($data['relation'] == 'daughter') {
														$daughter = 'selected';
													}

													if ($data['relation'] == 'son') {
														$son = 'selected';
													}

													if ($data['relation'] == 'wife') {
														$wife = 'selected';
													}

													if ($data['relation'] == 'husband') {
														$husband = 'selected';
													}

												}
												?>

												<option value="">Select Relation</option>
												<option <?php echo $daughter;?> value="daughter">Daughter</option>
												<option <?php echo $son;?> value="son">Son</option>
												<option <?php echo $wife;?> value="wife">Wife</option>
												<option <?php echo $husband;?> value="husband">Husband</option>
											</select>
										</div>

										<div class="col-md-6 form-group form-animate-text">

											<h4 class="text-left"><i class="fa fa-tint "></i> Blood Group</h4>
											<select class="col-md-12 form-text" name="validate_blood" >

												<?php
												$a_p = $a_n = $b_p = $b_n = $o_p = $o_n = $ab_p = $ab_n = '';
													switch ($data['blood_group']) {

													case 'A+':
													$a_p = 'selected';
													break;

													case 'A-':
													$a_n = 'selected';
													break;

													case 'B+':
													$b_p = 'selected';
													break;

													case 'B-':
													$b_n = 'selected';
													break;

													case 'O+':
													$o_p = 'selected';
													break;

													case 'O-':
													$o_n = 'selected';
													break;


													case 'AB+':
													$ab_p = 'selected';
													break;

													case 'AB-':
													$ab_n = 'selected';
													break;
													}
												?>
												<option value="">Select Blood Group</option>
												<option <?php echo $a_p;?> value="a+">A+</option>
												<option <?php echo $a_n;?> value="a-">A-</option>
												<option <?php echo $b_p;?> value="b+">B+</option>
												<option <?php echo $b_n;?> value="b-">B-</option>
												<option <?php echo $o_p;?> value="o+">O+</option>
												<option <?php echo $o_n;?> value="o-">O-</option>
												<option <?php echo $ab_p;?> value="ab+">AB+</option>
												<option <?php echo $ab_n;?> value="ab-">AB-</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 form-group">
											<h4 class="text-left"><i class="fa fa-venus-mars"></i> Gender 
												<span style="color: red">*</span>
											</h4>
											
											<?php
											$male =	$female = '';
											if (isset($data)){
												if ($data['gender'] == 'male'){ $male = 'checked'; }
												if ($data['gender'] == 'female'){ $female = 'checked'; }
											}
											?>

											<input id="m_gender" type="radio" name="gender" <?php echo $male;?> value="male" required>
											<label for="m_gender">MALE</label>
											&nbsp; | &nbsp;
											<input id="f_gender" type="radio" name="gender"  <?php echo $female;?>  value="female" required>
											<label for="f_gender">FEMALE</label>
										</div>

										<div class="col-md-6 form-group">
											<h4 class="text-left"><i class="fa fa-child"></i> Dependent 
												<span style="color: red">*</span>
											</h4>

											<?php
											$yes = $no = '';
											if (isset($data)){

												if ($data['dependency'] == 'yes') {
													$yes = 'checked';
												}
												if ($data['dependency'] == 'no') {
													$no = 'checked';
												}											
											}
											?>
											<input id="yes" type="radio"  <?php echo $yes;?> value="yes" name="dependency" required>
											<label for="yes">YES</label>
											&nbsp; | &nbsp;
											<input id="no" type="radio" <?php echo $no;?> value="no" name="dependency" required>
											<label for="no">NO</label>
										</div>
									</div><br>

									<div class="row">
										<div class="col-md-6 form-group form-animate-text">
										<h4 class="text-left"><i class="fa fa-calendar"></i> Date of Birth</h4>

											<?php

											if (isset($data)){

												$d = 'value="'.date('d-m-Y', $data['dob']).'"';
											}else{
												$d = '';
											}
											?>
											<input type="text" class="form-text dateAnimate" name="validate_dob" <?php echo $d;?>>
											<span class="bar"></span>
											
										</div>

										<div class="col-md-6" >
											<h4 class="text-left"><i class="fa 	fa-briefcase"></i> Occupation:
											</h4>

											<?php

											$service = $business = $house_wife = $student = $professional = $other = '';

											if (isset($data)){
												if ($data['occupation'] == 'Service') {
													$service = 'selected';
												}

												if ($data['occupation'] == 'Business') {
													$business = 'selected';
												}

												if ($data['occupation'] == 'Housewife') {
													$house_wife = 'selected';
												}

												if ($data['occupation'] == 'Student') {
													$student = 'selected';
												}

												if ($data['occupation'] == 'Professional') {
													$professional = 'selected';
												}

												if ($data['occupation'] == 'Other') {
													$other = 'selected';
												}
											}

											?>

											<select class="col-md-12" name="occupation" >
												<option value="">Select Occupation</option>
												<option <?php echo $service;?> value="service">Service</option>
												<option <?php echo $business;?> value="Business">Business</option>
												<option <?php echo $house_wife;?>  value="Housewife">Housewife</option>
												<option <?php echo $student;?>  value="Student">Student</option>
												<option <?php echo $professional;?>  value="Professional">Professional</option>
												<option <?php echo $other;?>  value="Other">Other</option>
											</select>
										</div>
									</div><br>

									<?php
									if (isset($data)){
										$x = 'value="Update Data"';
										$name = 'name ="update_family"';
									}else{
										$x = 'value="Create Family Member"';
										$name = 'name ="submit_family"';
									}
									?>
									<input type="submit" <?php echo $name;?> class="btn btn-success" <?php echo $x;?> />
								</div>
							</div>
						</form>
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
	<script src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
	<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.dateAnimate').bootstrapMaterialDatePicker({ format : 'DD-MM-YYYY', weekStart : 0, time: false, animation:true });


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
						maxlength: 100
					},
					validate_relation: {
						required: true
					},
					gender: {
						required: true
					},
					dependency: {
						required: true
					},
				},
				messages: {
					validate_name: {
						required: "Please enter Name",
					},
					validate_relation: {
						required: "Please select Relation",
					},
					gender: {
						required: "Please select Gender",
					},
					dependency: {
						required: "Please select Dependency",
					},
				}

			});



		});

	</script>

</body>
</html>