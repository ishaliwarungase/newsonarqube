<!DOCTYPE html>
<html lang="en">
<head>

	<title>MEMBER  | NMBA Vashi</title>
	
	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	<link rel="stylesheet" type="text/css" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
	<style type="text/css">.dtp > .dtp-content {  max-width: 345px; }</style>
	<link rel="stylesheet" type="text/css" href="<?php echo $url['_asset'];?>css/plugins/select2.min.css"/>
	
</head>

<body id="mimin" class="dashboard">
	<?php include($path['_files'].'nav_web.php');?>
	<div class="container-fluid mimin-wrapper">
		<?php
		$side = 3;
		include($path['_files'].'sidebar.php');

		if (!empty(array_filter($edit_member_details))){
			$data = $edit_member_details[0];
		}else{
			header('Location:'.$path['_base'].'index.php?action=member');
		}
		?>

		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">

					<div class="col-md-12">
						<h3 class="animated fadeInLeft">
							<?php echo ucfirst($data['initial']) .' '. ucwords($data['name']) . ' <small  style="color: #000;">[ '. $data['membership_id'] .' ] </small>' ;?>
						</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<a href="<?php echo $url['_base'];?>index.php?action=member"> Manage Member</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp;
							<b>Member :</b> <?php echo ucfirst($data['initial']) .' '. ucwords($data['name']);?>
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-12 top-20 padding-0">

				<div class="row">
					<div class="col-md-10 col-md-offset-1">

						<div class="panel">
							<div class="panel-heading" style="background-color: #ff4343;">
								<a href="<?php echo $url['_base'];?>index.php?action=member" class="btn btn-danger btn-xs ">
									<i class="fa fa-arrow-circle-left"></i> Back
								</a>
							</div>

							<br>
							<div class="row col-md-offset-1">
								<div class="col-md-3 col-sm-2">
									<a href="#mem_detail">
										<h4><p class="label label-info">Member Details</p></h4>
									</a>
								</div>
								<div class="col-md-3 col-sm-2">
									<a href="#personal_detail">
										<h4><p class="label label-warning">Personal Details</p></h4>
									</a>
								</div>
								<div class="col-md-3 col-sm-2">
									<a href="#address">
										<h4><p class="label label-primary">Address</p></h4>
									</a>
								</div>
								<div class="col-md-3 col-sm-2">
									<a href="#family_detail">
										<h4><p class="label label-danger">Family Details</p></h4>
									</a>
								</div>
							</div>

							<div class="panel-body text-center">
								<div class="panel-body ">
									<div class="panel panel-info" id="mem_detail">
										<div class="panel-heading">
											<h4 class="text-center" style="color: #000;">Membership Detail</h4>
										</div>

										<div class="panel-body text-center">
											<form  id="signupForm" action="<?php echo $url['_base'];?>index.php?action=member" method="post">
												<input type="hidden" name="uid" value="<?php echo $data['id']; ?>" />

												<div class="row">
													<div class="col-md-6 form-group form-animate-text">
														<h4 class="text-left"><i class="fa fa-user"></i> Introduced By</h4><br>
														<?php

														$db = conn();
														$qrr = $db->prepare("SELECT `id`, `name`,`membership_id`,`initial` FROM `nmba_user` WHERE `membership_status` != 'expired'");
														$qrr->execute();

														if ($qrr->rowCount() > 0) {
															echo '<select class="col-md-6 form-text select2-M" name="intro_name">';
															while($r = $qrr->fetch(PDO::FETCH_ASSOC)){
																if ($data['introduce_by'] == $r['id']) {
																	$y = 'selected';
																}else{
																	$y = '';
																}
																echo '<option value="">Select Member</option>
																<option value="'.$r['id'].'" '.$y.'>'.ucwords($r['initial']).' '.ucwords($r['name']).' [ '.$r['membership_id'].' ]</option>';
															}
															echo'</select>';
														}else{ echo 'Invalid input: User doesnt exists'; }
														?>
													</div>

													<div class="col-md-6 form-group form-animate-text">
														<h4 class="text-left"><i class="fa fa-calendar"></i> Approved by Committee on </h4>
														<input type="text" class="form-text dateAnimate" value="<?php echo date('d-m-Y',$data['date_of_addmission']);?>" name="date_of_admission">
														<span class="bar"></span>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<h4 class="text-left"><i class="fa fa-sticky-note"></i> Voting Right</h4>

														<?php

														$yes = $no = '';

														if ($data['voting_right'] == 'yes') {
															$yes = 'checked';
														}
														if ($data['voting_right'] == 'no') {
															$no = 'checked';
														}
														?>

														<input id="v_yes" type="radio" name="voting_right" <?php echo $yes;?> value ="yes" required>
														<label for="v_yes">YES</label>
														&nbsp;&nbsp;
														<input id="n_no" type="radio" name="voting_right" <?php echo $no;?> value ="no" required>
														<label for="n_no">NO</label>
													</div>

													<div class="col-md-6">
														<h4 class="text-left"><i class="fa fa-mars"></i> ID Issued</h4>
														<?php
														$yes = $no = '';
														if ($data['id_issued'] == 'yes') {
															$yes = 'checked';
														}

														if ($data['id_issued'] == 'no') {
															$no = 'checked';
														}
														?>

														<input id="yes" type="radio" name="id_issued" <?php echo $yes;?> value="yes" required>
														<label for="yes">YES</label>
														&nbsp;&nbsp;
														<input id="no" type="radio" name="id_issued" <?php echo $no;?> value="no" required>
														<label for="no">NO</label>
													</div>

												</div>

												<div class="row">

													<div class="col-md-6" >
														<h4 class="text-left"><i class="fa fa-bookmark"></i> Membership Status
														</h4>
														<?php
														$ac = $na = $expire = '';

														if ($data['membership_status'] == 'Active') {
															$ac = 'selected';
														}
														if ($data['membership_status'] == 'Inactive') {
															$na = 'selected';
														}

														if ($data['membership_status'] == 'Expired') {
															$expire = 'selected';
														}

														?>
														<select class="col-md-12" name="membership_status" required>
															<option <?php echo $ac;?> value="Active">Active</option>
															<option <?php echo $na;?> value="Inactive">Inactive</option>
															<option <?php echo $expire;?> value="Expired">Expired</option>
														</select>
													</div>

													
													<div class="col-md-6">
														<h4 class="text-left">
															<i class="fa fa-user-secret"></i> User Account Type
														</h4>

														<?php
														$super_admin = $admin = $member = $non_mem = '';

														if ( strtolower( $data['user_account_type'] ) == 'super-admin') {
															$super_admin = 'selected';
														}
														if ( strtolower( $data['user_account_type'] ) == 'admin') {
															$admin = 'selected';
														}
														if ( strtolower( $data['user_account_type'] ) == 'member') {
															$member = 'selected';
														}
														if ( strtolower( $data['user_account_type'] ) == 'non-member') {
															$non_mem = 'selected';
														}

														?>

														<select class="col-md-12" name="user_account_type" required>
															<option value="">User Account Type</option>
															<option <?php echo $super_admin;?> value="super-admin">Super Admin</option>
															<option <?php echo $admin;?> value="admin">Admin</option>
															<option <?php echo $member;?> value="member">Member</option>
															<option <?php echo $non_mem;?> value="non-member">Non-Member</option>
														</select> 
													</div>
													
												</div><br><br>

												<div class="row">

													<div class="col-md-6" >
														<h4 class="text-left"><i class="fa fa-bookmark"></i> Membership Category
														</h4>

														<?php

														$life = $hon = $associate = $not_applicable = '';

														if ($data['membership_category'] == 'Life') {
															$life = 'selected';
														}
														if ($data['membership_category'] == 'Honorary') {
															$hon = 'selected';
														}
														if ($data['membership_category'] == 'Associate') {
															$associate = 'selected';
														}
														if ($data['membership_category'] == 'non-member') {
															$not_applicable = 'selected';
														}
														?>  

														<select class="col-md-12" name="membership_category" required>
															<option value="">Select Membership Category</option>
															<option <?php echo $life;?> value="Life">Life</option>
															<option <?php echo $hon;?> value="Honorary">Honorary</option>
															<option <?php echo $associate;?> value="Associate">Associate</option>
															<option <?php echo $not_applicable;?> value="non-member">Not Applicable</option>
														</select>
													</div>

													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-key"></i> Password</h4>
														<input type="password" class="form-text" id="password" value="<?php echo $data['password'];?>" name="password" placeholder="Enter Password" autocomplete="off" required>
														<span toggle="#password" class="fa fa-eye fa-lg field-icon toggle-password" style="float: right;">
														</span><span class="bar"></span>
													</div>
												</div>                    

												<div class="row">
													<div class="col-md-12 form-group form-animate-text" >
														<?php
														$uid = $data['id'];
														$db = conn();
														$qr = $db->prepare("SELECT `paid_year` FROM `nmba_payment` WHERE user_id = '$uid'");
														$qr->execute();
														if ($qr->rowCount() > 0) {
															echo '<h5 style="float: left;"><i class="fa fa-calendar"></i> Membership Renewal Fees';
															while ($r = $qr->fetch(PDO::FETCH_ASSOC)) {
																echo ' <span class="label label-info">'.$r['paid_year'].'</span> ';
															}
														}else{
															echo "</h5>";
														}
														?>

													</div>
												</div>

												<input type="hidden" name="id">
												<div class="text-center">
													<input type="submit" class="btn btn-success btn-md" value="Save Member" name = "submit_member">
												</div>
											</form>
										</div>
									</div>

									<div class="panel panel-warning" id="personal_detail">
										<div class="panel-heading">
											<h4 class="text-center" style="color: #000;">Personal Details</h4>
										</div>

										<div class="panel-body text-center">
											<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=member" method="post" enctype="multipart/form-data">

												<input type="hidden" name="uid" value="<?php echo $data['id'];?>" />

												<div class="row col-md-offset-1">
													<div class="col-md-6 text-center">                    
														<span data-toggle="tooltip" data-placement="top" title="Profile Pic">
															<img onerror="http://cdn.onlinewebfonts.com/svg/img_568657.png" src="<?php
															if(file_exists($path['_views'].'asset/images/profile/'.$data['image']) ){
																if(isset($data['image'])){
																	echo $url['_asset'].'images/profile/'.$data['image'];
																}else{
																	echo 'http://cdn.onlinewebfonts.com/svg/img_568657.png';
																}
															}else{
																echo 'http://cdn.onlinewebfonts.com/svg/img_568657.png';
															}
															?>" class="img-responsive img-rounded" style ="border: 1px solid #989898;padding: 2px;height: auto; width: 200px;">
														</span>
													</div>

													<div class="col-md-6 text-center dp_container">
														<span data-toggle="tooltip" data-placement="top" title="Document">
															<img onerror="http://cdn.onlinewebfonts.com/svg/img_568657.png" src="<?php
															if(file_exists($path['_views'].'asset/images/document/'.$data['document_image']) ){
																if(isset($data['document_image'])){
																	echo $url['_asset'].'images/document/'.$data['document_image'];
																}else{
																	echo 'https://image.flaticon.com/icons/png/512/35/35920.png';
																}
															}else{
																echo 'https://image.flaticon.com/icons/png/512/35/35920.png';
															}
															?>" class="img-responsive img-rounded" style ="border: 1px solid #989898;padding: 2px;height: auto; width: 200px;">
														</span>

														<input type="file" class="form-text" name="document_image" accept="image/*">
													</div>
												</div><br>

												<div class="row">
													<div class="col-md-12 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-user"></i> Name</h4>
														<input type="text" class="form-text" value="<?php echo ucwords($data['name']); ?>" name="member_name" placeholder="Enter Name" autocomplete="off" required>
														<span class="bar"></span>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-cubes"></i> Area of Interest</h4><br><?php foreach( explode(',', $data['area_of_interest']) AS $key){
															echo ' <span class="label label-info">'.$key.'</span>';
														} ?>
													</div>

													<div class="col-md-6 form-group form-animate-text">
														<h5 style="float: left;"><i class="fa fa-handshake-o"></i> Purpose of Joining <span class="label label-info"><?php echo ucwords($data['join_reason']); ?></span>
														</h5>
													</div>

												</div>

												<div class="row">
													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-envelope"></i> E-Mail</h4>
														<input type="text" class="form-text" value="<?php echo strtolower($data['email']); ?>" name="email" placeholder="Enter E-Mail"  autocomplete="off" required>
														<span class="bar"></span>
													</div>
													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-mobile"></i> Mobile No.</h4>
														<input type="text" class="form-text" value="<?php echo $data['mobile']; ?>" name="mobile" placeholder="Enter Mobile No."  autocomplete="off" required>
														<span class="bar"></span>
														<small id="form_hint">10 digits only</small>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6" id="validate_gender" name="validate_gender">
														<h4 class="text-left"><i class="fa fa-venus-mars"></i> Gender<br><br>
															<?php
															$male = $female = '';             

															if ($data['gender'] == 'male') {
																$male = 'checked';
															}
															if ($data['gender'] == 'female') {
																$female = 'checked';
															}
															?>                          
															<input id="m_gender" type="radio" name="gender" <?php echo $male;?> value="male">
															<label for="m_gender">MALE</label>
															&nbsp; 
															<input id="f_gender" type="radio" name="gender" <?php echo $female;?> value="female">
															<label for="f_gender">FEMALE</label>
														</h4>
													</div>

													<div class="col-md-6 form-group form-animate-text">
														<h4 class="text-left"><i class="fa fa-calendar"></i> Date of Birth</h4>
														<input type="text" class="form-text dateAnimate" value="<?php echo date('d-m-Y',$data['dob']); ?>"  name="dob">
														<span class="bar"></span>
													</div>
												</div><br>

												<div class="row">
													<div class="col-md-6" >
														<h4 class="text-left"><i class="fa fa-tint"></i> Blood Group</h4>
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
														<select class="col-md-12" name="blood_group">
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

													<div class="col-md-6" >
														<h4 class="text-left"><i class="fa  fa-briefcase"></i> Occupation</h4>
														<?php
														$service = $business = $house_wife = $student = $professional = $other = '';
														if ($data['profession'] == 'service') { $service = 'selected'; }
														if ($data['profession'] == 'business') { $business = 'selected'; }
														if ($data['profession'] == 'housewife') { $house_wife = 'selected'; }
														if ($data['profession'] == 'student') { $student = 'selected'; }
														if ($data['profession'] == 'professional') { $professional = 'selected'; }
														if ($data['profession'] == 'other') { $other = 'selected'; }
														?>
														<select class="col-md-12" name="profession">
															<option value="">Select Occupation</option>
															<option <?php echo $service;?> value="service">Service</option>
															<option <?php echo $business;?> value="business">Business</option>
															<option <?php echo $house_wife;?>  value="housewife">Housewife</option>
															<option <?php echo $student;?>  value="student">Student</option>
															<option <?php echo $professional;?>  value="professional">Professional</option>
															<option <?php echo $other;?>  value="other">Other</option>
														</select>
													</div>
												</div><br><br>

												<div class="row">
													<div class="col-md-6" >
														<h4 class="text-left"><i class="fa  fa-briefcase"></i> Designation</h4>
														<?php
														$accountant = $c_a = $cse = $student = $advocate = $surgon = $physician = $other = '';
														if ($data['designation'] == 'Accountant') { $accountant = 'selected'; }
														if ($data['designation'] == 'Chartered Accountant') { $c_a = 'selected'; }
														if ($data['designation'] == 'Engineer') { $cse = 'selected'; }
														if ($data['designation'] == 'student') { $student = 'selected'; }
														if ($data['designation'] == 'Advocate') { $advocate = 'selected'; }
														if ($data['designation'] == 'Surgeon') { $surgon = 'selected'; }
														if ($data['designation'] == 'Physician') { $physician = 'selected'; }
														if ($data['designation'] == 'other') { $other = 'selected'; }
														?>
														<select class="col-md-12" name="designation">
															<option value="">Select Designation</option>
															<option <?php echo $accountant;?> value="Accountant">Accountant</option>
															<option <?php echo $c_a;?> value="Chartered Accountant">Chartered Accountant</option>
															<option <?php echo $house_wife;?>  value="Housewife">Housewife</option>
															<option <?php echo $cse;?>  value="Engineer">Engineer</option>
															<option <?php echo $advocate;?>  value="Advocate">Advocate</option>
															<option <?php echo $surgon;?>  value="Surgon">Surgeon</option>
															<option <?php echo $physician;?>  value="Physician">Physician</option>
															<option <?php echo $other;?>  value="other">Other</option>
														</select>
													</div>

													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-building" aria-hidden="true"></i> Organisation</h4>
														<input type="text" class="form-text" value="<?php echo ucwords($data['organization']); ?>" name="organization" placeholder="Organisation" autocomplete="off">
														<span class="bar"></span>
													</div>
												</div>
												<div class="text-center">
													<input type="submit" class="btn btn-success btn-md" value="Save Personal Details" name="submit_personal" />
												</div>
											</form>

										</div>
									</div>

									<div class="panel panel-primary" id="address">
										<div class="panel-heading">
											<h4 class="text-center" style="color: #000;">Address</h4>
										</div>

										<div class="panel-body text-center">
											
											<div class="form-group form-animate-checkbox" style="float: right;">
												<p class="label label-primary" for="check_nri"><input class="checkbox" type="checkbox" name="nri_check" id="check_nri">NRI</p>
											</div><br>

											<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=member" method="post">

												<input type="hidden" name="uid" value="<?php echo $data['id']; ?>" >
												
												<div class="row" id="address_nri" style="display: none">
													<div class="col-md-12 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-home"></i>NRI Address</h4>
														<textarea type="text" class="form-text" value= "" name="nri_address" placeholder="Enter Address"  autocomplete="off"><?php echo ucwords($data['nri']); ?></textarea>
														<span class="bar"></span>
														<small style="float: left; color: gray;">Ex : 5C / B-15, </small>
													</div>
												</div>

												<div id="ind_address">
													<div class="row"><br>
													
														<div class="col-md-3 form-group form-animate-text">
															<h4 style="float: left;"><i class="fa fa-home"></i> Flat / House No.</h4>
															<input type="text" class="form-text"  value="<?php echo ucwords($data['flat_house_no']); ?>" name="house_no" placeholder="Enter Flat/House No."  autocomplete="off" >
															<span class="bar"></span>
															<small style="float: left; color: gray;">Ex : 5C / B-15</small>
														</div>


														<div class="col-md-6 form-group form-animate-text">
															<h4 style="float: left;"><i class="fa fa-building"></i> Society / Building</h4>
															<input type="text" class="form-text"  value="<?php echo ucwords($data['society_building']); ?>" name="society_building" placeholder="Enter Society / Building Name" autocomplete="off" >
															<span class="bar"></span>
															<small style="float: left; color: gray;">Ex : Ganesh Society / Dosti Apartment</small>
														</div>

														<div class="col-md-3 form-group form-animate-text">
															<h4 style="float: left;"><i class="fa fa-road "></i> Plot No.</h4>
															<input type="text" class="form-text"  value="<?php echo ucwords($data['plot_no']); ?>" name="plot_no" placeholder="Enter Plot No."  autocomplete="off" >
															<span class="bar"></span>
															<small style="float: left; color: gray;">Ex : 15</small>
														</div>

													</div>

													<div class="row">
														<div class="col-md-6 form-animate-text">
															<h4 class="text-left"><i class="fa fa-map-marker"></i> Sector
															</h4>


															<select class="select2-B col-md-12" name="sector">
																<option value="">Select Sector</option>
																<?php 
																
																for ($i=1; $i <=75 ; $i++) { 

																	if ($data['sector'] == 'sector'.$i) {
																		echo '<option value="sector'.$i.'" selected >Sector '.$i.'</option>';												
																	}else{
																		echo '<option value="sector'.$i.'">Sector '.$i.'</option>';										
																	}
																	
																}
																?>
															</select>
															<span class="bar"></span>
														</div>


														<div class="col-md-6 form-animate-text">
															<h4 class="text-left"><i class="fa fa-map-marker"></i> Sub-Sector
															</h4>

															<?php
															$a = $b = $c = $d = $e = $f = '';
															if ($data['sub_sector'] == 'A') {
																$a = 'selected';
															}
															if ($data['sub_sector'] == 'B') {
																$b = 'selected';
															}
															if ($data['sub_sector'] == 'C') {
																$c = 'selected';
															}
															if ($data['sub_sector'] == 'D') {
																$d = 'selected';
															}
															if ($data['sub_sector'] == 'E') {
																$e = 'selected';
															}
															if ($data['sub_sector'] == 'F') {
																$f = 'selected';
															}

															?>

															<select class="select2-SS col-md-12" name="sub_sector">
																<option value="">Select Sub-Sector</option>
																<option <?php echo $a;?> value="A">A</option>
																<option <?php echo $b;?> value="B">B</option>
																<option <?php echo $c;?> value="C">C</option>
																<option <?php echo $d;?> value="D">D</option>
																<option <?php echo $e;?> value="E">E</option>
																<option <?php echo $f;?> value="F">F</option>      
															</select>
															<span class="bar"></span>
														</div>

													</div><br><br>

													<div class="row">

														<div class="col-md-4 form-animate-text">
															<h4 class="text-left"><i class="fa fa-map-marker"></i> City </h4><br>

															<?php
															$ahmadnagar = $akola = $amravati = $aurangabad = $bhandara = $bid = $buldana = $chandrapur = $dhule = $gadchiroli = $gondiya = $hingoli = $jalgaon = $jalna = $kolhapur = $latur = $mumbai = $navi_mumbai = $nagpur = $nanded = $nandurbar = $nashik = $osmanabad = $parbhani = $pune = $raigarh = $ratnagiri = $sangli = $satara = $sindhudurg = $solapur = $thane = $wardha = $washim = $yavatmal = ''; 

															
															switch($data['city_node']){
																case 'Ahmadnagar':$ahmadnagar='selected';break;case 'Akola':$akola='selected';break;case 'Amravati':$amravati='selected';break;case 'Aurangabad':$aurangabad='selected';break;case 'Bhandara':$bhandara='selected';break;case 'Bid':$bid='selected';break;case 'Buldana':$buldana='selected';break;case 'Chandrapur':$chandrapur='selected';break;case 'Dhule':$dhule='selected';break;case 'Gadchiroli':$gadchiroli='selected';break;case 'Gondiya':$gondiya='selected';break;case 'Hingoli':$hingoli='selected';break;case 'Jalgaon':$jalgaon='selected';break;case 'Jalna':$jalna='selected';break;case 'Kolhapur':$kolhapur='selected';break;case 'Latur':$latur='selected';break;case 'Mumbai':$mumbai='selected';break;case 'Navi Mumbai':$navi_mumbai='selected';break;case 'Nagpur':$nagpur='selected';break;case 'Nanded':$nanded='selected';break;case 'Nandurbar':$nandurbar='selected';break;case 'Nashik':$nashik='selected';break;case 'Osmanabad':$osmanabad='selected';break;case 'Parbhani':$parbhani='selected';break;case 'Pune':$pune='selected';break;case 'Raigarh':$raigarh='selected';break;case 'Ratnagiri':$ratnagiri='selected';break;case 'Sangli':$sangli='selected';break;case 'Satara':$satara='selected';break;case 'Sindhudurg':$sindhudurg='selected';break;case 'Solapur':$solapur='selected';break;case 'Thane':$thane='selected';break;case 'Wardha':$wardha='selected';break;case 'Washim':$washim='selected';break;case 'Yavatmal':$yavatmal='selected';break;
															}



															?>

															<select class="form-text select2-C col-md-12"  name="city">
																<option value="">Select City</option>

																<option <?php echo $ahmadnagar;?> value="Ahmadnagar">Ahmadnagar</option><option <?php echo $akola;?> value="Akola">Akola</option><option <?php echo $amravati;?> value="Amravati">Amravati</option><option <?php echo $aurangabad;?> value="Aurangabad">Aurangabad</option><option <?php echo $bhandara;?> value="Bhandara">Bhandara</option><option <?php echo $bid;?> value="Bid">Bid</option><option <?php echo $buldana;?> value="Buldana">Buldana</option><option <?php echo $chandrapur;?> value="Chandrapur">Chandrapur</option><option <?php echo $dhule;?> value="Dhule">Dhule</option><option <?php echo $gadchiroli;?> value="Gadchiroli">Gadchiroli</option><option <?php echo $gondiya;?> value="Gondiya">Gondiya</option><option <?php echo $hingoli;?> value="Hingoli">Hingoli</option><option <?php echo $jalgaon;?> value="Jalgaon">Jalgaon</option><option <?php echo $jalna;?> value="Jalna">Jalna</option><option <?php echo $kolhapur;?> value="Kolhapur">Kolhapur</option><option <?php echo $latur;?> value="Latur">Latur</option><option <?php echo $mumbai;?> value="Mumbai">Mumbai</option><option <?php echo $navi_mumbai;?> value="Navi Mumbai">Navi Mumbai</option><option <?php echo $nagpur;?> value="Nagpur">Nagpur</option><option <?php echo $nanded;?> value="Nanded">Nanded</option><option <?php echo $nandurbar;?> value="Nandurbar">Nandurbar</option><option <?php echo $nashik;?> value="Nashik">Nashik</option><option <?php echo $osmanabad;?> value="Osmanabad">Osmanabad</option><option <?php echo $parbhani;?> value="Parbhani">Parbhani</option><option <?php echo $pune;?> value="Pune">Pune</option><option <?php echo $raigarh;?> value="Raigarh">Raigarh</option><option <?php echo $ratnagiri;?> value="Ratnagiri">Ratnagiri</option><option <?php echo $sangli;?> value="Sangli">Sangli</option><option <?php echo $satara;?> value="Satara">Satara</option><option <?php echo $sindhudurg;?> value="Sindhudurg">Sindhudurg</option><option <?php echo $solapur;?> value="Solapur">Solapur</option><option <?php echo $thane;?> value="Thane">Thane</option><option <?php echo $wardha;?> value="Wardha">Wardha</option><option <?php echo $washim;?> value="Washim">Washim</option><option <?php echo $yavatmal;?> value="Yavatmal">Yavatmal</option>

															</select>
															<span class="bar"></span>
														</div>

														<div class="col-md-4 form-group form-animate-text">
															<h4 style="float: left;"><i class="fa fa-map-marker"></i> Pincode</h4>
															<input type="text" class="form-text"  value="<?php echo ucwords($data['pincode']); ?>" name="pincode" placeholder="Enter Pincode"  autocomplete="off" >
															<span class="bar"></span>
															<small style="float: left; color: gray;">Ex : 400072</small>
														</div>

														<div class="col-md-4 form-group form-animate-text">
															<h4 style="float: left;"><i class="fa fa-map-marker"></i> Area</h4>
															<input type="text" class="form-text"  value="<?php echo ucwords($data['area']); ?>" name="area" placeholder="Enter Area"  autocomplete="off" >
															<span class="bar"></span>
															<small style="float: left; color: gray;">Ex : Koperkhairane / Sakinaka</small>
														</div>

													</div><br>

												</div>

												<div class="text-center">
													<input type="submit" class="btn btn-success btn-md" value="Save Address" name="submit_address"/>
												</div>
											</form>
										</div>
									</div>

									<div class="panel  panel-danger" id="family_detail">
										<div class="panel-heading" id="member_family_details">
											<h4 class="text-center"  style="color: #000;">Family Details</h4>
										</div>
										<div class="panel-body">
											<div class="col-md-12 padding-0" style="padding-bottom:20px;"></div>

											<div class="responsive-table">

												<table class="table table-striped table-bordered" width="100%" cellspacing="0">
													<thead>
														<tr>
															<th><i class="fa fa-user"></i> Name</th>
															<th><i class="fa fa-venus-mars"></i> Gender</th>
															<th><i class="fa fa-child"></i> Dependent</th>
															<th><i class="fa fa-calendar"></i> Date of Birth</th>
															<th><i class="fa fa-briefcase"></i> Occupation</th>
															<!-- <th><i class="fa fa-pencil-square"></i> Update</th> -->
														</tr>
													</thead><tbody>

													<?php

													$can_foreach = is_array($res) || is_object($res);

													if ($can_foreach) {
														foreach ($res as $r) {

															echo '<tr>
															<td>'.ucwords($r['name']).'<br>
																<span data-toggle="tooltip" data-placement="bottom" title="Relation">
																	<i class="fa fa-handshake-o"></i> '.ucwords($r['relation']).'</span> &nbsp; | &nbsp; 
																	<span data-toggle="tooltip" data-placement="bottom" title="Blood Group">
																		<i class="fa fa-tint"></i> '.ucwords($r['blood_group']).'</span>
																	</td>
																	<td>'.ucwords($r['gender']).'</td>
																	<td>'.ucwords($r['dependency']).'</td>
																	<td>'.date('d M Y',$r['dob']).'</td>
																	<td>'.ucwords($r['occupation']).'</td>
																	<td>
																		<form method="post" action="'.$url['_base'].'index.php?action=member">
																			
																		</form>

																	</td>
																</tr>';

															}
														}
														?>

													</tbody>
												</table>
											</div>                 
										</div>
									</div>

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
	<script src="<?php echo $url['_asset'];?>js/plugins/jquery.validate.min.js"></script>
	<script src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
	<script src="<?php echo $url['_asset'];?>js/plugins/select2.full.min.js"></script>

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


			$("#check_nri").click(function () {

				if ($(this).is(":checked")) {
					
					$("#address_nri").show();
					$("#ind_address").hide();
				} else {
					$("#address_nri").hide();
					$("#ind_address").show();
				}
			});


			$('.dateAnimate').bootstrapMaterialDatePicker({ format : 'DD-MM-YYYY', weekStart : 0, time: false, animation:true });

			$(".select2-A").select2({
				placeholder: "Select Area",
				allowClear: true
			});
			$(".select2-B").select2({
				placeholder: "Select Sector",
				allowClear: true
			});
			$(".select2-C").select2({
				placeholder: "Select City",
				allowClear: true
			});
			$(".select2-D").select2({
				placeholder: "Select State",
				allowClear: true
			});
			$(".select2-M").select2({
				placeholder: "Select Member",
				allowClear: true
			});
			$(".select2-SS").select2({
				placeholder: "Select Sub-Sector",
				allowClear: true
			});

		});
	</script>
</body>
</html>