<!DOCTYPE html>
<html lang="en">
<head>

	<title>PROFILE  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	<link rel="stylesheet" type="text/css" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url['_asset'];?>css/plugins/select2.min.css"/>
	<style type="text/css">
		.dtp > .dtp-content { max-width: 345px; }
		.dp_container {
			position: relative;
			text-align: center;
			color: white;
		}

		.req_admin_button_glow{
			animation: glowing 1300ms infinite;
		}

		@keyframes glowing {
			0% {
				-moz-box-shadow:0 0 10px 7px #D32F2F;
				-webkit-box-shadow:0 0 10px 7px #D32F2F;
				box-shadow:0 0 10px 7px #D32F2F;
			}
			40% {
				-moz-box-shadow:0 0 20px 7px #D32F2F;
				-webkit-box-shadow:0 0 20px 7px #D32F2F;
				box-shadow:0 0 20px 7px #D32F2F;
			}
			60% {
				-moz-box-shadow:0 0 20px 7px #D32F2F;
				-webkit-box-shadow:0 0 20px 7px #D32F2F;
				box-shadow:0 0 20px 7px #D32F2F;
			}
			100% {
				-moz-box-shadow:0 0 -10px 7px #D32F2F;
				-webkit-box-shadow:0 0 -10px 7px #D32F2F;
				box-shadow:0 0 -10px 7px #D32F2F;
			}
		}

	</style>

</head>

<body id="mimin" class="dashboard">
	<?php
	include($path['_files'].'nav_web.php');
	?>
	<div class="container-fluid mimin-wrapper">

		<?php
		$side = 2;
		include($path['_files'].'sidebar.php');

		if (!empty(array_filter($edit_my_profile))){
			$data = $edit_my_profile[0];
		}else{
			header("Location: ". $path['_base'] ."index.php?action=login");
		}
		?>

		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">

					<div class="col-md-12">
						<span id="member_name">
							<h3 class="animated fadeInLeft">
								<?php echo ucwords($data['initial']) .' '. ucwords($data['name']) . ' <small style="color: #000;">[ '. $data['membership_id'] .' ] </small>' ;?>

							</h3>
						</span>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home">Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; 
							<?php echo ucwords($data['initial']) .' '. ucwords($data['name']);?>
						</p>
					</div>
				</div>
			</div>


			<div class="col-md-12 top-20 padding-0">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">

						<div class="panel">
							<div class="panel-heading" style="background-color: #ff4343;">
								<a href="<?php echo $url['_base'];?>index.php?action=home" class="btn btn-danger btn-xs ">
									<i class="fa fa-arrow-circle-left"></i> Back
								</a>
							</div>

							<br>
							<div class="row text-center">
								<div class="col-md-4 col-sm-4 col-xs-4">
									<a href="#mem_detail">
										<h4><p class="label label-info">Member Details</p></h4>
									</a>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<a href="#personal_detail">
										<h4><p class="label label-warning">Personal Details</p></h4>
									</a>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<a href="#family_detail">
										<h4><p class="label label-danger">Family Details</p></h4>
									</a>
								</div>
							</div>


							<div class="panel-body">

								<!-- /////////////////////////////////////////////////////////////////////////// -->
								<div class="panel panel-info" id="mem_detail">
									<div class="panel-heading">
										<h4 class="text-center" style="color: #000">Membership Detail</h4>
									</div>

									<div class="panel-body text-center">

										<div class="row">

											<div class="col-md-6 col-sm-6 col-xs-4" >
												<h4 class="text-left">

													<?php
													$name = '';
													$intro_id = $data['introduce_by'];
													$db = conn();
													$qrr = $db->prepare("SELECT initial, name, membership_id FROM nmba_user WHERE id = '$intro_id'");
													$qrr->execute();

													if ($qrr->rowCount() > 0) {
														$r= $qrr->fetch(PDO::FETCH_ASSOC);
														$name = $r['name'];
														$initial = $r['initial'].' ';
														$membership_id = ' ['. $r['membership_id'].']';
														$color = "info";
													}else{
														$name = 'NOT SET';
														$color = "warning";
														$initial = $membership_id = '';
													}
													?>

													<i class="fa fa-user"></i> Introduced By <p class="label label-<?php echo $color; ?>"><?php echo $initial .$name .$membership_id; ?></p>
												</h4>

											</div> 

											<div class="col-md-6 col-sm-6 col-xs-6"  >

												<h4 class="text-left"><i class="fa fa-calendar"></i> Approved by Committee on 
													<?php

													if (isset($data['date_of_addmission'])) {
														echo '<p class="label label-info">' . date('D, j M Y',$data['date_of_addmission']) . '</p>';
													}else{
														echo '<p class="label label-warning">NOT APPROVED</p>';
													}

													?></h4>
												</div>
											</div><br>

											<div class="row">

												<div class="col-md-6">
													<h4 class="text-left"><i class="fa fa-gavel"></i> Voting Right
														<?php

														if ($data['voting_right'] == 'yes') {
															echo '<span class="label label-info"> YES</span>';
														}

														if ($data['voting_right'] == 'no') {
															echo '<span class="label label-warning"> NO</span>';
														}

														?>
													</h4>
												</div>


												<div class="col-md-6">
													<h4 class="text-left"><i class="fa fa-bookmark"></i> ID Issued
														<?php
														if ($data['id_issued'] == 'yes') {
															echo '<span class="label label-info"> YES</span>';
														}

														if ($data['id_issued'] == 'no') {
															echo '<span class="label label-warning"> NO</span>';
														}
														?>
													</h4>
												</div>
											</div><br>

											<div class="row">

												<div class="col-md-6" >
													<h4 class="text-left">
														<i class="fa fa-bookmark"></i> Membership Status
														<?php

														if (strtolower($data['membership_status']) == 'active') {
															echo '<span class="label label-info"> Active</span>';
														}

														if (strtolower($data['membership_status']) == 'inactive') {
															echo '<span class="label label-primary"> Inactive</span>';
														}

														if (strtolower($data['membership_status']) == 'expired') {
															echo '<span class="label label-warning"> Expired</span>';
														}

														?>
													</h4>
												</div>

												<div class="col-md-6" >
													<h4 class="text-left"><i class="fa fa-sitemap"></i> Membership Category
														<?php


														switch ($data['membership_category']) {
															case 'non-member': $color = '#898989'; break;
															case 'Associate': $color = '#007BE3'; break;
															case 'Honorary': $color = '#0ddb00'; break;
															case 'Life': $color = '#7c00f0'; break;
															default: $color = '#9c9c9c'; break;
														}


														?>
														<span class="label" style="background-color:<?php echo $color;?>"><?php echo strtoupper( $data['membership_category'] );?></span>
													</h4>
												</div>
											</div><br>

											<div class="row">
												<div class="col-md-6">
													<h4 class="text-left">
														<i class="fa fa-user-secret"></i>	User Account Type &nbsp; 
														<?php
														if ($data['user_account_type'] == 'non-member') {
															echo '<span class="label label-warning"> '. strtoupper($data['user_account_type']). '</span>';
														}else{
															echo '<span class="label label-info"> '. strtoupper($data['user_account_type']). '</span>';
														}
														?>
													</h4>
												</div>

												<div class="col-md-6 form-group form-animate-text" >
													<?php
													$uid = $data['id'];
													$db = conn();
													$qr = $db->prepare("SELECT `paid_year` FROM `nmba_payment` WHERE user_id = '$uid'");
													$qr->execute();
													if ($qr->rowCount() > 0) {
														echo '<h4 style="float: left;"><i class="fa fa-calendar"></i> Membership Renewal Fees';
														while ($r = $qr->fetch(PDO::FETCH_ASSOC)) {
															echo ' <span class="label label-info">'.$r['paid_year'].'</span> ';
														}
													}else{
														echo "</h4>";
													}
													?>

												</div>

											</div>
										</div>
									</div>


									<!-- /////////////////////////////////////////////////////////////////////////// -->


									<div class="panel panel-warning" id="personal_detail">
										<div class="panel-heading">
											<h4 class="text-center"  style="color: #000">Personal Details</h4>
										</div>

										<div class="panel-body text-center">

											<!-- FORM2 START -->
											<form id="signupForm" action="<?php echo $url['_base'];?>index.php?action=profile" method="post" enctype="multipart/form-data">
												<div class="row col-md-offset-1">

													<div class="col-md-6 text-center dp_container">
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
														<input type="file" class="form-text" name="profile_image" accept="image/*">
													</div>


													<div class="col-md-6 text-center">

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
													</div>
												</div><br>


												<div class="row">
													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-user"></i> Name</h4>
														<input type="text" class="form-text" name="name" placeholder="Enter Name" autocomplete="off" required   <?php echo 'value="'.ucwords( $data['name']).'"';?> >
														<span class="bar"></span>
													</div>

													<div class="col-md-6" >
														<h4 class="text-left"><i class="fa fa-file"></i> Purpose of Joining
														</h4>

														<?php

														$a = $b = $c = '';

														if ($data['join_reason'] == 'Volunteer') {
															$a = 'selected';
														}

														if ($data['join_reason'] == 'Progress') {
															$b = 'selected';
														}

														if ($data['join_reason'] == 'Social') {
															$c = 'selected';
														}

														?>

														<select class="col-md-12" name="join_reason">
															<option value="">Select a Reason to join</option>
															<option <?php echo $a;?> value="Volunteer">Volunteer</option>
															<option <?php echo $b;?> value="Progress">Progress</option>
															<option <?php echo $c;?>  value="Social">Social</option>
														</select>
													</div>

												</div>
												
												<div class="row">


													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-envelope"></i> E-Mail 
															<?php
															echo '<span class="label label-warning" data-toggle="tooltip" data-placement="bottom" id="user_email_display" title="Request admin to change"> '. strtolower($data['email']). '</span>';
															?>

															<!-- ================================================================== -->	
															<span class="btn btn-circle btn-mn btn-primary " id="req_admin_email" class="label label-info" data-toggle="tooltip" data-placement="top" title="Send Request"><i class="fa fa-user-circle-o"></i></span>
														</h4><br><p id="req_admin_email_msg" style="display: none;">Admin Informed</p>

														<!-- ================================================================== -->

													</div>


													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-mobile"></i> Mobile 
															<?php
															echo '<span class="label label-warning"  data-toggle="tooltip" data-placement="bottom" id="user_phone_display" title="Request admin to change"> '. $data['mobile']. '</span>'; 
															?>

															<!-- ================================================================== -->	
															<span class="btn btn-circle btn-mn btn-primary " id="req_admin_phone" class="label label-info" data-toggle="tooltip" data-placement="top" title="Send Request"><i class="fa fa-user-circle-o"></i></span>
														</h4><br><p id="req_admin_phone_msg" style="display: none;">Admin Informed</p>
														<!-- ================================================================== -->

													</div>
												</div>


												<?php
												if ( !empty($data['flat_house_no']) AND !empty($data['area']) AND !empty($data['city_node']) ) {
													echo '<div class="row">
													<div class="col-md-12 form-group form-animate-text">
														<h4 style="float: left;">
															<i class="fa fa-building" aria-hidden="true"></i>
															Address <span class="label label-warning" data-toggle="tooltip" data-placement="bottom" id="user_address_display" title="Request admin to change">
															'.ucwords($data['flat_house_no']).', 
															'.ucwords($data['society_building']).',
															'.ucfirst($data['sector']).ucfirst($data['sub_sector']).',
															'.$data['area'].', '.$data['city_node'].'-'.$data['pincode'].'
														</span>&nbsp;
														<span class="btn btn-circle btn-mn btn-primary " id="req_admin_address" class="label label-info" data-toggle="tooltip" data-placement="top" title="Send Request">
															<i class="fa fa-user-circle-o"></i></span>

														</h4><br><p id="req_admin_address_msg" style="display: none;">Admin Informed</p>
													</div></div>';
												}elseif(!empty($data['nri'])){
													echo '<div class="row">
													<div class="col-md-12 form-group form-animate-text">
														<h4 style="float: left;">
															<i class="fa fa-building" aria-hidden="true"></i>
															Address: <span class="label label-warning" data-toggle="tooltip" data-placement="bottom" id="user_address_display" title="Request admin to change">
															'.ucwords($data['nri']).'
														</span>&nbsp;
														<span class="btn btn-circle btn-mn btn-primary " id="req_admin_address" class="label label-info" data-toggle="tooltip" data-placement="top" title="Send Request">
															<i class="fa fa-user-circle-o"></i></span>

														</h4><br><p id="req_admin_address_msg" style="display: none;">Admin Informed</p>
													</div></div>';
												}
												?>

												<div class="row">
													

													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-venus-mars"></i> Gender 
															<?php

															echo '<span class="label label-warning"  data-toggle="tooltip" data-placement="bottom" title="Request admin to change"> '. ucfirst($data['gender']). '</span>'; 
															?>
														</h4>														
													</div>

													<div class="col-md-6 form-group form-animate-text">

														<h4 class="text-left"><i class="fa fa-calendar"></i> Date of Birth

															<?php

															echo '<input type="hidden" name="dob" value="'.$data['dob'].'">
															<span class="label label-warning" data-toggle="tooltip" data-placement="bottom" title="Request admin to change"> '.date('D, j M Y',$data['dob']).'</span>';
															?>
														</h4>													
													</div>

												</div>

												<div class="row">

													<div class="col-md-6 form-group form-animate-text">
														<h4 style="float: left;"><i class="fa fa-tint"></i> Blood Group 
															<?php
															echo '<span class="label label-warning"  data-toggle="tooltip" data-placement="bottom" title="Request admin to change"> '. $data['blood_group']. '</span>'; 
															?>
														</h4>														
													</div>

													<div class="col-md-6" >
														<h4 class="text-left"><i class="fa fa-cubes"></i> Areas of Interest
														</h4>

														<?php
														$f_a = $housekeeping = $kali_mandir = $durga_puja = $sports = $art_music = $library_education = $community_services = '';

														$arr = explode(",",$data['area_of_interest']);

														foreach ($arr AS $k) {

															if ($k == 'Finance & Account') { $f_a = 'selected'; }
															if ($k == 'Housekeeping') { $housekeeping = 'selected'; }
															if ($k == 'Kali Mandir') { $kali_mandir = 'selected'; }
															if ($k == 'Durga Pooja') { $durga_puja = 'selected'; }
															if ($k == 'Sports') { $sports = 'selected'; }
															if ($k == 'Art & Music') { $art_music = 'selected'; }
															if ($k == 'Library & Educational') { $library_education = 'selected'; }
															if ($k == 'Community Services') { $community_services = 'selected';}
														}

														?>

														<select class="col-md-12 select2-I" name="area_of_interest[]" multiple="multiple">
															<option <?php echo $f_a;?> value="Finance & Account">Finance & Account</option>
															<option <?php echo $housekeeping;?> value="Housekeeping">Housekeeping</option>
															<option <?php echo $kali_mandir;?> value="Kali Mandir">Kali Mandir</option>
															<option <?php echo $durga_puja;?> value="Durga Pooja">Durga Puja</option>
															<option <?php echo $sports;?> value="Sports">Sports</option>
															<option <?php echo $art_music;?> value="Art & Music">Art / Music</option>
															<option <?php echo $library_education;?> value="Library & Educational">Library & other Educational Sevice</option>
															<option <?php echo $community_services;?> value="Community Services">Community services</option>
														</select>
														<samll style="color: gray">You may select multiple interests</small>
														</div>
													</div><br>

													<div class="row">
														<div class="col-md-6" >
															<h4 class="text-left"><i class="fa 	fa-briefcase"></i> Occupation</h4>
															<?php
															$service = $business = $house_wife = $student = $professional = $other = '';
															if ($data['profession'] == 'service') {$service = 'selected';}
															if ($data['profession'] == 'business') {$business = 'selected';}
															if ($data['profession'] == 'house_wife') {$house_wife = 'selected';}
															if ($data['profession'] == 'student') {$student = 'selected';}
															if ($data['profession'] == 'professional') {$professional = 'selected';}
															if ($data['profession'] == 'other') {$other = 'selected';}
															?>
															<select class="col-md-12" name="profession">
																<option value="">Select Occupation</option>
																<option <?php echo $service;?> value="service">Service</option>
																<option <?php echo $business;?> value="business">Business</option>
																<option <?php echo $house_wife;?>  value="house_wife">Housewife</option>
																<option <?php echo $student;?>  value="student">Student</option>
																<option <?php echo $professional;?>  value="professional">Professional</option>
																<option <?php echo $other;?>  value="other">Other</option>
															</select>
														</div>

														<div class="col-md-6" >
															<h4 class="text-left"><i class="fa 	fa-briefcase"></i> Designation</h4>
															<?php
															$accountant = $c_a = $cse = $student = $advocate = $surgon = $physician = $other = '';
															if ($data['designation'] == 'Accountant') {$accountant = 'selected';}
															if ($data['designation'] == 'Chartered Accountant') {$c_a = 'selected';}
															if ($data['designation'] == 'Engineer') {$cse = 'selected';}
															if ($data['designation'] == 'student') {$student = 'selected';}
															if ($data['designation'] == 'Advocate') {$advocate = 'selected';}
															if ($data['designation'] == 'Surgeon') {$surgon = 'selected';}
															if ($data['designation'] == 'Physician') {$physician = 'selected';}
															if ($data['designation'] == 'other') {$other = 'selected';}
															?>
															<select class="col-md-12" name="designation">
																<option value="">Select Designation</option>
																<option <?php echo $accountant;?> value="Accountant">Accountant</option>
																<option <?php echo $c_a;?> value="Chartered Accountant">Chartered Accountant</option>
																<option <?php echo $house_wife;?>  value="house_wife">Housewife</option>
																<option <?php echo $cse;?>  value="Engineer">Engineer</option>
																<option <?php echo $advocate;?>  value="Advocate">Advocate</option>
																<option <?php echo $surgon;?>  value="Surgeon">Surgeon</option>
																<option <?php echo $physician;?>  value="Physician">Physician</option>
																<option <?php echo $other;?>  value="other">Other</option>
															</select>
														</div>

													</div><br>

													<div class="row">
														
														<div class="col-md-6 form-group form-animate-text">
															<h4 style="float: left;"><i class="fa fa-building" aria-hidden="true"></i> Organisation</h4>
															<input type="text" class="form-text" name="organization" placeholder="Organisation" autocomplete="off" value="<?php echo ucwords( $data['organization'])?>" >
															<span class="bar"></span>
														</div>

														<div class="col-md-6 form-group form-animate-text">
															<h4 style="float: left;"><i class="fa fa-key"></i> Password</h4>
															<input type="password" class="form-text" id="password" name="password" placeholder="Enter Password" autocomplete="off" required value="<?php echo $data['password'];?>" >
															<span toggle="#password" class="fa fa-eye fa-lg field-icon toggle-password" style="float: right;"></span><span class="bar"></span>
														</div>

													</div>
													
													<div class="text-center">
														<input type="submit" class="btn btn-success btn-md" value="Save Personal Details" name="submit_personal" />
													</div>
												</form>
											</div>
										</div>
										<!-- /////////////////////////////////////////////////////////////////////////// -->


										<!-- /////////////////////////////////////////////////////////////////////////// -->
										<div class="panel  panel-danger"  id="family_detail">
											<div class="panel-heading" id="family_details">
												<h4 class="text-center"  style="color: #000">Family Details</h4>
											</div>
											<div class="panel-body">
												<div class="col-md-12 padding-0" style="padding-bottom:20px;">

													<div class="text-center">
														<form method="post" action="<?php echo $url['_base'];?>index.php?action=profile">
															<button type="submit" class="btn btn-primary" name="add_family" >
																<i class="fa fa-user-plus"></i> Add Family Member
															</button>
														</form>
													</div>

												</div>
												<div class="responsive-table">

													<?php
													$can_foreach = is_array($res) || is_object($res);

													if ($can_foreach) {

														echo '<table class="table table-striped table-bordered text-center" width="100%" cellspacing="0"><thead><tr>
														<th><i class="fa fa-user"></i> Name</th>
														<th><i class="fa fa-venus-mars"></i>  Gender</th>
														<th><i class="fa fa-child"></i> Dependent</th>
														<th><i class="fa fa-calendar"></i> Date of Birth</th>
														<th><i class="fa fa-briefcase"></i> Occupation</th>
														<th><i class="fa fa-pencil-square"></i> Update</th>
													</tr></thead><tbody>';

													foreach ($res as $r) {
														echo '<tr><td>'.ucwords($r['name']).'<br>
														<span data-toggle="tooltip" data-placement="bottom" title="Relation">
															<i class="fa fa-handshake-o"></i> '.ucwords($r['relation']).'</span> &nbsp; | &nbsp; 
															<span data-toggle="tooltip" data-placement="bottom" title="Blood Group">
																<i class="fa fa-tint"></i> '.ucwords($r['blood_group']).'</span>
															</td>
															<td>'.ucwords($r['gender']).'</td>
															<td>'.ucwords($r['dependency']).'</td>
															<td>'.date('d F Y',$r['dob']).'</td>
															<td>'.ucwords($r['occupation']).'</td>
															<td>

																<form method="post" action="'.$url['_base'].'index.php?action=profile">
																	<input type="hidden" name="mem_id" value="'.$r['id'].'" >
																	<input type="submit" value="Edit" class="btn btn-info btn-xs" name="edit_family"></form></td></tr>';
																}
																echo '</tbody></table>';
															}
															?>
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


				<!-- start: Javascript -->
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


						$("#user_email_display").on({
							mouseenter: function () {
								$("#req_admin_email").addClass("req_admin_button_glow");
							},
							mouseleave: function () {
								$("#req_admin_email").removeClass("req_admin_button_glow");
							}
						});

						$("#user_phone_display").on({
							mouseenter: function () {
								$("#req_admin_phone").addClass("req_admin_button_glow");
							},
							mouseleave: function () {
								$("#req_admin_phone").removeClass("req_admin_button_glow");
							}
						});

						$("#user_address_display").on({
							mouseenter: function () {
								$("#req_admin_address").addClass("req_admin_button_glow");
							},
							mouseleave: function () {
								$("#req_admin_address").removeClass("req_admin_button_glow");
							}
						});


						$("#req_admin_email").on('click',function(e){
							e.preventDefault();
							req_admin_function("email");

						});

						$("#req_admin_phone").on('click',function(e){
							e.preventDefault();
							req_admin_function("phone");

						});

						$("#req_admin_address").on('click',function(e){
							e.preventDefault();
							req_admin_function("address");

						});



						function req_admin_function (type){

							var name = $('#member_name').text();
							name = name.trim();

							var email = $('#user_email_display').text();
							email = email.trim();

							var number =  $('#user_phone_display').text();
							number = number.trim();

							var address =  $('#user_address_display').text();
							address = address.trim();

							$.ajax({
								type: "POST",
								data:{"request_admin":"request_admin","type":type, "name":name, "email":email, "number": number, "address": address},
								url: "<?php echo $url['_modules'].'notification.php';?>",
								success:function(res){
									if (res == 1) {

										if (type == 'email') {

											$("#req_admin_email").hide();
											$("#req_admin_email_msg").show();

											$("#req_admin_email_msg").fadeTo(2000, 500).slideUp(500, function(){
												$("#req_admin_email_msg").hide(500);
											});
										}
										
										if (type == 'phone') {

											$("#req_admin_phone").hide();
											$("#req_admin_phone_msg").show();

											$("#req_admin_phone_msg").fadeTo(2000, 500).slideUp(500, function(){
												$("#req_admin_phone_msg").hide(500);
											});
										}

										if (type == 'address') {

											$("#req_admin_address").hide();
											$("#req_admin_address_msg").show();

											$("#req_admin_address_msg").fadeTo(2000, 500).slideUp(500, function(){
												$("#req_admin_address_msg").hide(500);
											});
										}									

									}						
								}
							});
						}

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

						$(".select2-M").select2({
							placeholder: "Select Member",
							allowClear: true
						});

						$(".select2-I").select2({
							placeholder: "Select Area of Interest",
							tags: true
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
								
								password: {
									required: true
								},
							},
							messages: {
								password: {
									required: "Please enter Password"							  
								},
							}

						});


});


</script>

</body>
</html>
