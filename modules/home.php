<?php

@session_start();
require_once realpath(__DIR__).'/../config/config.php';


////////////////////////////
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_number']) && !isset($_SESSION['password'])) {
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



$qr = $db->prepare("SELECT name, image, membership_id, initial, dob, membership_category, city_node, notif_email, notif_mobile FROM `nmba_user` WHERE id='$id' AND mobile = '$mobile' LIMIT 1");
$qr->execute();

if ($qr->rowCount() > 0) {

	$user_data = $qr->fetch(PDO::FETCH_ASSOC);

	$qr1 = $db->prepare("SELECT `title`,`location`, `description`,`from_date_time`, `to_date_time`, `event_type` FROM `nmba_event` ORDER BY id DESC LIMIT 5");
	$qr1->execute();

	$qr2 = $db->prepare("SELECT `title`,`from_date`,`to_date`,`type` FROM `nmba_notice` ORDER BY id DESC LIMIT 5");
	$qr2->execute();

	$event_data = $qr1->fetchAll(PDO::FETCH_ASSOC);
	$notice_data = $qr2->fetchAll(PDO::FETCH_ASSOC);

}else{
	echo 'oops errror';
}


/////////////////////////////////////////////
if (isset($_POST['val'])) {
	$option = $_POST['val'];

	$qr = $db->prepare("SELECT count(id)AS id FROM `nmba_user` WHERE (senior_citizen = '$option' OR gender = '$option' OR membership_status = '$option')");
	$qr->execute();
	if ($qr->rowCount() > 0) {    
		echo $qr->fetch(PDO::FETCH_ASSOC)['id'];
		exit();
	}
}



require_once($path['_views'] . 'home.php');
exit();