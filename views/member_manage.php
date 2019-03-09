<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>MEMBER  | NMBA Vashi</title>

	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo $url['_asset'];?>css/plugins/select2.min.css"/>

</head>

<body id="mimin" class="dashboard">
	<?php
	include($path['_files'].'nav_web.php');
	?>
	<div class="container-fluid mimin-wrapper">

		<?php
		$side = 3;
		include($path['_files'].'sidebar.php');
		?>

		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Manage Members</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a> 
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; Manage Members
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-12 top-20 padding-0">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading" style="background-color: #ff4343;">
							<a href="<?php echo $url['_base'];?>index.php?action=home" class="btn btn-danger btn-xs ">
								<i class="fa fa-arrow-circle-left"></i> Back
							</a>
						</div>
						<div class="panel-body">
							<div class="responsive-table">
								<h3 class="text-center" style="color: #2d0101">Search by Filter</h3><br>
								
								<form method="post" action="<?php echo $url['_base'];?>index.php?action=member">

									<div class="row text-center">

										<div class="col-md-3 col-sm-6 col-xs-6">
											<select class="form-text select2-E col-md-12" name="senior_citizen">
												<option value="">Senior Citizen</option>
												<option value="yes">YES</option>
												<option value="no">NO</option>
											</select>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-6">
											<select class="form-text select2-F col-md-12" name="gender">
												<option value="">Select Gender</option>
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-6">
											<select class="form-text select2-G col-md-12" name="blood_group">
												<option value="">Blood Group</option>
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

										<div class="col-md-3 col-sm-4 col-xs-4">
											<select class="form-text select2-H col-md-12" name="mem_status">
												<option value="">Membership Status</option>
												<option value="active">Active</option>
												<option value="inactive">Inactive</option>
												<option value="expired">Expired</option>
											</select>
										</div>

									</div><br>

									<div class="row text-center">

										<div class="col-md-3 col-sm-6 col-xs-6">
											<select class="form-text select2-A col-md-12" name="user_account_type">
												<option value="">Account Type</option>
												<option value="">Account Type</option>
												<option value="super-admin">Super Admin</option>
												<option value="admin">Admin</option>
												<option value="member">Member</option>
												<option value="non-member">Non-Member</option>
											</select>
										</div>									

										<div class="col-md-3 col-sm-6 col-xs-6">
											<select class="form-text select2-C col-md-12"  name="city">
												<option value="">Select City</option>
												
												<option value="Ahmadnagar">Ahmadnagar</option>
												<option value="Akola">Akola</option>
												<option value="Amravati">Amravati</option>
												<option value="Aurangabad">Aurangabad</option>
												<option value="Bhandara">Bhandara</option>
												<option value="Bid">Bid</option>
												<option value="Buldana">Buldana</option>
												<option value="Chandrapur">Chandrapur</option>
												<option value="Dhule">Dhule</option>
												<option value="Gadchiroli">Gadchiroli</option>
												<option value="Gondiya">Gondiya</option>
												<option value="Hingoli">Hingoli</option>
												<option value="Jalgaon">Jalgaon</option>
												<option value="Jalna">Jalna</option>
												<option value="Kolhapur">Kolhapur</option>
												<option value="Latur">Latur</option>
												<option value="Mumbai">Mumbai</option>
												<option value="Navi Mumbai">Navi Mumbai</option>
												<option value="Nagpur">Nagpur</option>
												<option value="Nanded">Nanded</option>
												<option value="Nandurbar">Nandurbar</option>
												<option value="Nashik">Nashik</option>
												<option value="Osmanabad">Osmanabad</option>
												<option value="Parbhani">Parbhani</option>
												<option value="Pune">Pune</option>
												<option value="Raigarh">Raigarh</option>
												<option value="Ratnagiri">Ratnagiri</option>
												<option value="Sangli">Sangli</option>
												<option value="Satara">Satara</option>
												<option value="Sindhudurg">Sindhudurg</option>
												<option value="Solapur">Solapur</option>
												<option value="Thane">Thane</option>
												<option value="Wardha">Wardha</option>
												<option value="Washim">Washim</option>
												<option value="Yavatmal">Yavatmal</option>

											</select>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-6">
											<select class="select2-B col-md-12" name="sector">
												<option value="">Select Sector</option>
												<?php 

												for ($i=1; $i <=75 ; $i++) { 
													echo '
													<option value="sector'.$i.'">Sector '.$i.'</option>';
												}
												?>
											</select>
										</div> 

										<div class="col-md-3 col-sm-6 col-xs-6">
											<select class="select2-SS col-md-12" name="sub_sector">
												<option value="">Select Sub-Sector</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="C">C</option>
												<option value="D">D</option>
												<option value="E">E</option>
												<option value="F">F</option>      
											</select>
										</div><br><br><br>

										<div class="text-center">
											<button class=" btn btn-circle btn-sm btn-info" name="search" value="search" data-toggle="tooltip" data-placement="bottom" title="Search by Filter">
												<span class="fa fa-search fa-lg"></span>
											</button> 
										</div>

									</div><hr>

									<div class="text-center">
										<button class=" btn btn-mn btn-info" name="show_all" value="show_all" data-toggle="tooltip" data-placement="bottom" title="Show All Member">
											<span class="fa fa-group"></span> <b>View All</b>
										</button>
									</div>

								</form>



								<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
									<thead style="background-color: white;">
										<tr>
											<th><i class="fa fa-user"></i> Name</th>
											<th><i class="fa fa-phone-square"></i> Contact Details</th>
											<th><i class="fa fa-list-ul"></i> Account Type</th>
											<th><i class="fa fa-cubes"></i> Interest</th>
											<th><i class="fa fa-pencil-square"></i> Edit</th>
										</tr>
									</thead>
									<tbody>
										<?php

										if(isset($res)){ 
											foreach ($res as $r) {

												echo '<tr><td>
												<h4>'.ucwords($r['initial']).' '.ucwords($r['name']).'</h4>
												<span data-toggle="tooltip" data-placement="bottom" title="Membership ID">
													<i class="fa fa-bookmark"></i> '.$r['membership_id'].'
													&nbsp; |  &nbsp; </span> 

													<span data-toggle="tooltip" data-placement="bottom" title="Gender">
														<i class="fa fa-venus-mars"></i> '.ucwords($r['gender']).'
														&nbsp; |  &nbsp; </span>

														<span data-toggle="tooltip" data-placement="bottom" title="Blood Group">
															<i class="fa fa-tint"></i> '.strtoupper($r['blood_group']).'
															&nbsp; |  &nbsp; </span>

															<span data-toggle="tooltip" data-placement="bottom" title="Age"> 
																<i class="fa fa-calendar"></i> ' . (date('Y') - date('Y',$r['dob'])) .' Years</span>
															</td>

															<td>
																<a href="tel:'.$r['mobile'].'"><i class="fa fa-phone-square"></i> '.$r['mobile'].'</a><br><i class="fa fa-envelope"></i> 
																'.$r['email'].'
															</td>
															<td>'.ucwords($r['user_account_type']).'</td>
															<td>'.ucwords($r['area_of_interest']).'</td>
															<td><form method="post" action="'.$url['_base'].'index.php?action=member">
																<input type ="hidden" name ="member_id" value = "'.$r['id'].'">
																<input type="submit" value="Edit" class="btn btn-info btn-xs" name="member_detail" >
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
					<?php
					include($path['_files'].'footer.php');
					?>  
				</div>

			</div>
		</div>

		<?php
		include($path['_files'].'nav_mobile.php');
		include($path['_files'].'js.php');
		?>

		<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

		<script src="<?php echo $url['_asset'];?>js/plugins/select2.full.min.js"></script>


		<script type="text/javascript">
			$(document).ready(function() {
				$('#datatables-example').DataTable( { dom: 'Bfrtip',buttons: ['excel'] } );

				$(".select2-A").select2({
					placeholder: "Select Account Type",
					allowClear: true
				});

				$(".select2-D").select2({
					placeholder: "Select State",
					allowClear: true
				});

				$(".select2-C").select2({
					placeholder: "Select City",
					allowClear: true
				});

				$(".select2-B").select2({
					placeholder: "Select Sector",
					allowClear: true
				});

				$(".select2-SS").select2({
					placeholder: "Select Sub-Sector",
					allowClear: true
				});

				$(".select2-E").select2({
					placeholder: "Senior Citizen",
					allowClear: true
				});

				$(".select2-F").select2({
					placeholder: "Select Gender",
					allowClear: true
				});

				$(".select2-G").select2({
					placeholder: "Blood Group",
					allowClear: true
				});

				$(".select2-H").select2({		
					placeholder: "Membership Status",
					allowClear: true
				});

			} );
		</script>
	</body>
	</html>