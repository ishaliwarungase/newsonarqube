<!DOCTYPE html>
<html lang="en">
<head>

	<title>PAYMENT  | NMBA Vashi</title>

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
		$side = 6;
		include($path['_files'].'sidebar.php');
		?>
		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Manage Payment</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a> 
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; Manage Payment
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
							<div class="text-center">

								<form method="post" action="<?php echo $url['_base'];?>index.php?action=payment">
									<button type="submit" class="btn btn-primary " name="payment_create">
										<i class="fa fa-money"></i> Create Payment
									</button>
								</form>

							</div><br>
							<div class="responsive-table">
								<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
									<thead  style="background-color: white;">
										<tr>
											<th><i class="fa fa-user"></i> Member Details</th>
											<th><i class="fa fa-money"></i> Paid Amount [Rs.]</th>
											<th><i class="fa fa-align-left"></i> Receipt No.</th>
											<th><i class="fa fa-money"></i> Payment Type</th>
											<th><i class="fa fa-sticky-note"></i> Member Contact</th>
											<th>Remark</th>
										</tr>
									</thead>
									<tbody>

										<?php
										if(isset($res) AND !empty($res)){ 
											foreach ($res AS $r) {

												echo '<tr><td>
												<h4>'.ucwords($r['name']).'</h4>
												<i>
												<i class="fa fa-calendar"></i> '.date('D, M jS Y',$r['payment_date_time']).'
												</i>
											
												
												</td>
												<td>'.$r['amount'].'</td>
												<td>'.$r['receipt_no'].'</td>
										    	<td>';
												if($r['payment_type'] == 'Membership Payment'){
													echo ucwords($r['payment_type']).' By '.ucwords($r['payment_method']).' of Year '.$r['paid_year'];
												}else{
													echo ucwords($r['payment_type']).' By '.ucwords($r['payment_method']).'';
												}

												echo '</td>
												<td>
													<i>
															<i class="fa fa-mobile"></i> '.$r['mobile'].'
													</i><br>
													<i>
															<i class="fa fa-envelope"></i> '.$r['email'].'
													</i><br>
													<i>
															<i class="fa fa-home"></i> '.$r['address'].'
													</i>



												</td>
												<td>

												<form method="post" action="'.$url['_base'].'index.php?action=payment">
												<input type ="hidden" name ="payment_id" value = "'.$r['id'].'">
												<p>'.ucwords($r['comment']).'</p>
												<button type="submit" class="btn btn-danger btn-xs" name="payment_delete" ><i class="fa fa-trash"></i>
												</button>	
												</form></td></tr>';
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
</body>
</html>