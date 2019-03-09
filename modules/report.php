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


	$qr = $db->prepare("SELECT nu.initial, nu.name AS admin_name, nu.user_account_type, nu.membership_id, date_time, activity 
			FROM `nmba_activity` AS na 
			JOIN nmba_user AS nu ON na.admin_id = nu.id 
			ORDER BY na.id DESC"
		 );
	$qr->execute();
	
	if ($qr->rowCount() > 0) {	

		$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
	}else{
		$res = 0;
	}

require_once($path['_views'] . 'activity_report.php');
exit();