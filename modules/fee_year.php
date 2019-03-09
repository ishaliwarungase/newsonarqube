<?php

////////////////////////////
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_number']) && !isset($_SESSION['password'])) {
	header('location: '.$url['_base'].'index.php?action=login');
}

$user_account_type = $_SESSION['user_account_type'];
if ($user_account_type != 'super-admin') {
	header('location: '.$url['_base'].'index.php?action=login');
}

////////////////////////////
$db = conn();
$id = $_SESSION['user_id'];
$mobile = $_SESSION['user_number'];
$password = $_SESSION['password'];

////////////////////////////
$qr = $db->prepare("SELECT id FROM `nmba_user` WHERE (id = '$id') AND (mobile = '$mobile') AND (password = '$password') LIMIT 1");
$qr->execute();

////////////////////////////
if (!$qr->rowCount() > 0) {
	header('location: '.$url['_base'].'index.php?action=login');	
}
////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['search'])){

	$paid_year = $_POST['fee_year'];

	$db = conn();
	$qr = $db->prepare("SELECT * FROM `nmba_payment` WHERE paid_year = '$paid_year'
			");
	$qr->execute();
		
		if ($qr->rowCount() > 0) {	

			$res = $qr->fetchAll(PDO::FETCH_ASSOC);
			$msg = 'success';
		}else{
			
			$msg = 'Invalid input';
				
		}
}

require_once($path['_views'] . 'report.php');
exit();