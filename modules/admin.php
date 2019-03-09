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


$qr = $db->prepare("SELECT id, name, mobile, email, membership_id, gender, dob, blood_group,area_of_interest,user_account_type, initial, membership_category FROM nmba_user WHERE (user_account_type = 'admin') OR (user_account_type = 'super-admin')");
$qr->execute();

if ($qr->rowCount() > 0) {	

	$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{
	$res = 'Invalid input: User doesnt exists';
}


require_once($path['_views'] . 'admin_manage.php');
exit();