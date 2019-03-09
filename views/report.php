<!DOCTYPE html>
<html lang="en">
<head>

	<title>FEE REPORT  | NMBA Vashi</title>
	
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
		$side = 10;
		include($path['_files'].'sidebar.php');
		?>
		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Fee Report</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; Fee Renewal Report
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

								<div class="text-center">
									<form method="post" action="<?php echo $url['_base'];?>index.php?action=fee_year">

										<select class="form-text" name="fee_year">
											<option value="">Select Year</option>
											<option value="2018-2019">2018-2019</option>
											<option value="2019-2020">2019-2020</option>
											<option value="2020-2021">2020-2021</option>
											<option value="2021-2022">2021-2022</option>
											<option value="2022-2023">2022-2023</option>
											<option value="2023-2024">2023-2024</option>
											<option value="2024-2025">2024-2025</option>
											
										</select> &nbsp; 

										<button class=" btn btn-circle btn-mn btn-info" name="search" value="search" data-toggle="tooltip" data-placement="bottom" title="Search Fee Year">

											<span class="fa fa-search" data-toggle="tooltip" data-placement="bottom" title="Search Fee Year"></span>	

										</button>

									</form>
								</div>

								<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
									<thead  style="background-color: white;">
										<tr>
											<th><i class="fa fa-user"></i> Member Details</th>
											<th><i class="fa fa-money"></i> Paid Amount</th>
											<th><i class="fa fa-calendar"></i> Amount Paid Year</th>
											<th><i class="fa fa-align-left"></i> Receipt No.</th>
											<th><i class="fa fa-money"></i> Payment Type</th>
											<th><i class="fa fa-sticky-note"></i> Note</th>
										</tr>
									</thead>
									<tbody>
										<?php
										//var_dump($res);
										if(isset($res)){ 

											foreach ($res as $r) {

												echo '<tr>
												<td><h4>'.ucwords($r['name']).'</h4></td>
												<td>
													Rs. '.$r['amount'].'<br>
													By '.ucwords($r['payment_method']).'
												</td>
												<td>'.$r['paid_year'].'</td>
												<td>'.$r['receipt_no'].'</td>
												<td>'.ucwords($r['payment_type']).'</td>
												<td>'.ucwords($r['comment']).'<br>
													<i><i class="fa fa-calendar"></i> '.date('D, jS M  Y',$r['payment_date_time']).'</i>
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
</div>
<!-- end: content -->


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

<script src="<?php echo $url['_asset'];?>js/plugins/select2.full.min.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
		$('#datatables-example').DataTable( {
			dom: 'Bfrtip',
			buttons: [
			'excel'
			]
		} );

		$(".select2-A").select2({
			placeholder: "Select Year",
			allowClear: true
		});

	} );
</script>
<!-- end: Javascript -->
</body>
</html>