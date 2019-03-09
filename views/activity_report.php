<!DOCTYPE html>
<html lang="en">
<head>

	<title>ACTIVITY REPORT | NMBA Vashi</title>
	
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
		$side = 9;
		include($path['_files'].'sidebar.php');
		?>

		<div id="content">
			<div class="panel box-shadow-none content-header ">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Activity Report</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; Activity Report
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
											<th><i class="fa fa-user-secret"></i> Admin</th>
											<th><i class="fa fa-th-list"></i> Activity</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($res)){ 
											foreach ($res as $r) {

												echo '<tr>
												<td>
													<h4>'.ucwords($r['initial']).' '.ucwords($r['admin_name']).'</h4>
													<span data-toggle="tooltip" data-placement="bottom" title="Member Account Type"><i class="fa fa-user-secret"></i> '.ucwords($r['user_account_type']).'</span>
													&nbsp; |  &nbsp; 
													<span data-toggle="tooltip" data-placement="bottom" title="Membership ID"><i class="fa fa-bookmark"></i> '.$r['membership_id'].'</span>
												</span>
											</td>
											<td> '.ucwords($r['activity']).'
												<br><br>
												<i><i class="fa fa-calendar"></i> '.date('D, M jS Y @ g:i A',$r['date_time']).'</i>
											</td>
										</tr>

										';
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

<!-- custom -->
<script src="<?php echo $url['_asset'];?>js/main.js"></script>
<!-- custom -->

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