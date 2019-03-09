<!DOCTYPE html>
<html lang="en">
<head>

	<title>ADMIN  | NMBA Vashi</title>
	
	<?php
	include($path['_files'].'meta.php');
	include($path['_files'].'css.php');
	?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>

</head>

<body id="mimin" class="dashboard">
	<?php
	include($path['_files'].'nav_web.php');
	?>

	<div class="container-fluid mimin-wrapper">

		<?php
		$side = 4;
		include($path['_files'].'sidebar.php');
		?>
		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Manage Admin</h3>
						<p class="animated fadeInDown"> 
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; Manage Admin
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
								<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
									<thead  style="background-color: white;">
										<tr>
											<th><i class="fa fa-user"></i> Name</th>
											<th><i class="fa fa-phone-square"></i> Contact Details</th>
											<th><i class="fa fa-user-secret"></i> Admin Type</th>
											<th><i class="fa fa-cubes"></i> Membership Category</th>
											<th><i class="fa fa-pencil-square"></i> Edit</th>
										</tr>
									</thead>

									<tbody>

										<?php
											// var_dump($res);
										if(isset($res)){ 
											foreach ($res as $r) {

												echo '<tr>
												<td>
													<h4>'.ucwords($r['initial']).' '.ucwords($r['name']).'</h4>

													<span data-toggle="tooltip" data-placement="bottom" title="Membership ID">
														<i class="fa fa-bookmark"></i> '.$r['membership_id'].'
														&nbsp; |  &nbsp; 
													</span>

													<span data-toggle="tooltip" data-placement="bottom" title="Gender">
														<i class="fa fa-venus-mars"></i> '.ucwords($r['gender']).'
														&nbsp; |  &nbsp; 
													</span>

													<span data-toggle="tooltip" data-placement="bottom" title="Blood Group">
														<i class="fa fa-tint"></i> '.strtoupper($r['blood_group']).'
														&nbsp; |  &nbsp; 
													</span>

													<span data-toggle="tooltip" data-placement="bottom" title="Age"> 
														<i class="fa fa-calendar"></i> ';
														echo $age = (date('Y') - date('Y',$r['dob']));

														echo' Years</span></td>

														<td>
															<a href="tel:'.$r['mobile'].'"><i class="fa fa-phone-square"></i> '.$r['mobile'].'</a><br><i class="fa fa-envelope"></i> '.$r['email'].'
														</td>
														<td>'.ucwords($r['user_account_type']).'</td>
														<td>'.ucwords($r['membership_category']).'</td>
														<td>
															<form method="post" action="'.$url['_base'].'index.php?action=member">
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

		<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js "></script>


		<script type="text/javascript">

			$(document).ready(function() {
				$('#datatables-example').DataTable( {
					dom: 'Bfrtip',
					buttons: [
					'excel'
					]
				} );
			} );
		</script>
		<!-- end: Javascript -->

	</body>
	</html>