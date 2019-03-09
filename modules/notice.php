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





////////////IF PRESS NOTICE CREATE BUTTON ON MANAGE NOTICE//////////// 

if(isset($_POST['notice_create'])){

	require_once($path['_views'] . 'notice_create.php');
	exit();

}

/////////////// CREATE NOTICE /////////////

if(isset($_POST['notice_submit'])){

	$title =$_POST['title'];
	$notice_type =$_POST['type'];
	$from_date =strtotime($_POST['validate_sdate']);
	$to_date =$_POST['validate_edate'];	

	$db = conn();
	$qr = $db->prepare("INSERT INTO `nmba_notice`(`title`, `from_date`, `to_date`, `type`) VALUES ('$title', '$from_date', '$to_date', '$notice_type')");
	$qr->execute();
		
	if ($qr->rowCount() > 0) {

		///////////
		if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
			$activity = 'Created new notice: '.$title;
			$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
			$qr2->execute();
		}
		//////////	
		$msg = 'success';
		
	}else{
		$msg = 'Invalid input';
		require_once($path['_views'] . 'notice_create.php');
		exit();
	}
}	
	


//////////////////Display notice in manage notice//////////////////////


$db = conn();
$qr = $db->prepare("SELECT `id`, `title`, `from_date`, `to_date`, `type` FROM `nmba_notice` ORDER BY id DESC");
$qr->execute();
	
if ($qr->rowCount() > 0) {	

	$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{
	$res = 'Invalid input: User doesnt exists';
}

////////////IF PRESS edit BUTTON ON MANAGE NOTICE//////////// 


if(isset($_POST['edit_notice'])){
	$nid = $_POST['notice_id'];

$db = conn();
$qr = $db->prepare("SELECT * FROM `nmba_notice` WHERE id = '$nid'");
$qr->execute();
	
if ($qr->rowCount() > 0) {	

	$edit_notice_res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{
	$edit_notice_res = 'Invalid input: User doesnt exists';
}

	require_once($path['_views'] . 'notice_create.php');
	exit();

}


/////////////////////////// update notice ////////////////////////////////

if(isset($_POST['update_notice'])){

	$nid = $_POST['nid'];
	$title =$_POST['title'];
	$notice_type =$_POST['type'];
	$from_date =strtotime($_POST['validate_sdate']);
	$to_date = $_POST['validate_edate'];	

	$db = conn();
	$qr = $db->prepare("UPDATE `nmba_notice` SET  `title`='$title',`from_date`='$from_date',`to_date`='$to_date',`type`='$notice_type' WHERE id = '$nid'");
	$qr->execute();
		
	if ($qr->rowCount() > 0) {
		$msg = 'success';
		///////////
		if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
			$activity = 'updated notice: '.$title;
			$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
			$qr2->execute();
		}
		//////////
	
	}else{
		$msg = 'Invalid input';
		require_once($path['_views'] . 'notice_manage.php');
		exit();
	}
}	

//////////////////Display notice in manage notice//////////////////////


$db = conn();
$qr = $db->prepare("SELECT `id`, `title`, `from_date`, `to_date`, `type` FROM `nmba_notice` ORDER BY id DESC");
$qr->execute();
	
if ($qr->rowCount() > 0) {	

	$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{
	$res = 'Invalid input: User doesnt exists';
}



require_once($path['_views'] . 'notice_manage.php');
exit();
