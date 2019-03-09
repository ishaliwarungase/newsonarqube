<?php

////////////////////////////
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_number']) && !isset($_SESSION['password'])) {
	header('location: '.$url['_base'].'index.php?action=login');
}

$user_account_type = $_SESSION['user_account_type'];
if (($user_account_type != 'super-admin') AND ($user_account_type != 'admin')) {
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



if(isset($_POST['payment_create'])){

	require_once($path['_views'] . 'payment_create.php');
	exit();

}



/////////////// CREATE PAYMENT /////////////

if(isset($_POST['payment_submit'])){
	
	if(empty($_POST['user_id'])){
		$user_id = null;
	}else{
		$user_id =$_POST['user_id'];
	}

	$member =$_POST['non_mem_name'];
	$mobile =$_POST['non_mem_mobile'];
	$email =$_POST['non_mem_email'];
	$address =$_POST['non_mem_address'];
	$payment_type =$_POST['validate_type'];
	$payment_method =$_POST['validate_method'];
	$receipt_no =$_POST['validate_reciept'];
	$amount =$_POST['validate_amt'];
	$payment_date =strtotime($_POST['validate_date']);
	$amount_paid_year =$_POST['validate_paid_year'];
	$comment =$_POST['comment'];

	$db = conn();

	$qr = $db->prepare("INSERT INTO `nmba_payment`(`name`, `mobile`, `email`, `address`, `amount`, `payment_date_time`, `paid_year`, `receipt_no`, `payment_type`, `comment`, `payment_method`,`user_id` ) VALUES ('$member', '$mobile', '$email', '$address', '$amount', '$payment_date', '$amount_paid_year', '$receipt_no', '$payment_type', '$comment','$payment_method','$user_id')");
	$qr->execute();
		
	if ($qr->rowCount() > 0) {	

		$msg = 'success';
		///////////
		if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
			$activity = 'Created new payment';
			$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
			$qr2->execute();
		}
		//////////
	}else{
		
		$msg = 'Invalid input';
			require_once($path['_views'] . 'payment_create.php');
			exit();
	}
}

//////////////////Delete Payment/////////////////

if(isset($_POST['payment_delete'])){

	$payment_id = $_POST['payment_id'];

	$db = conn();
	$qr = $db->prepare("DELETE FROM `nmba_payment` WHERE id = '$payment_id'");
	$qr->execute();
		
	if ($qr->rowCount() > 0) {	

		$msg = 'success';
		///////////
		if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
			$activity = 'deleted existing payment';
			$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
			$qr2->execute();
		}
		//////////
	}else{
		
		$msg = 'Invalid input';
			
	}


}


////////////////Display Payment Details////////////

$qr = $db->prepare("SELECT * FROM `nmba_payment` ORDER BY id DESC");
$qr->execute();
	
if ($qr->rowCount() > 0) {	

	$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{
	$res = '';
}

require_once($path['_views'] . 'payment_manage.php');
exit();