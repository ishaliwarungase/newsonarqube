<!DOCTYPE html>
<html lang="en">
<head>

	<title>NOTICE  | NMBA Vashi</title>
	
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
		$side = 7;
		include($path['_files'].'sidebar.php');
		?>
		<div id="content">
			<div class="panel box-shadow-none content-header">
				<div class="panel-body">
					<div class="col-md-12">
						<h3 class="animated fadeInLeft">Manage Notice</h3>
						<p class="animated fadeInDown">
							<a href="<?php echo $url['_base'];?>index.php?action=home"> Dashboard</a>
							&nbsp; <span class="fa-angle-right fa"></span> &nbsp; Manage Notice
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

								<!-- FORM START -->
								<form method="post" action="<?php echo $url['_base'];?>index.php?action=notice">

									<button type="submit" class="btn btn-primary btn-md" name="notice_create">
										<i class="fa fa-star-o"></i> Create Notice
									</button>

								</form>
								<!-- FORM END -->
							</div>
							

							<div class="responsive-table">
								<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
									<thead  style="background-color: white;">
										<tr>
											<th>
												<i class="fa fa-bars"></i> Title
											</th>
											
											<th>
												<i class="fa fa-pencil-square"></i> Edit
											</th>
										</tr>
									</thead>
									<tbody>

										<?php
										// var_dump($res);
										if(isset($res)){ 
											foreach ($res as $r) {

												echo '<tr>
												<td>
													<h5>'.ucwords($r['title']).'</h5>
													<span data-toggle="tooltip" data-placement="bottom" title="Notice Type">
														<i class="fa fa-sitemap"></i>
														'.ucwords($r['type']).'&nbsp; | &nbsp

														<i class="fa fa-calendar-plus-o"></i>
															Date: '.date('D, M jS Y',$r['from_date']).'&nbsp; | &nbsp;
													
														<i class="fa fa-clock-o"></i>
															Time: '.$r['to_date'].'

													</span>
												</td>
												
												<td>
													<form method="post" action="'.$url['_base'].'index.php?action=notice">
														<input type="hidden" name="notice_id" value="'.$r['id'].'" >

														<input type="submit" value="Edit" class="btn btn-info btn-xs" name="edit_notice" >
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

<!-- custom -->
<script src="<?php echo $url['_asset'];?>js/main.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#datatables-example').DataTable();

	});
</script>
<!-- end: Javascript -->
</body>
</html>