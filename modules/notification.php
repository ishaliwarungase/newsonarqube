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
$msg1 = $msg2 = '';
$c = $d = 0;

////////////////////////////
$qr = $db->prepare("SELECT id FROM `nmba_user` WHERE (id = '$id') AND (mobile = '$mobile') AND (password = '$password') LIMIT 1");
$qr->execute();

////////////////////////////
if (!$qr->rowCount() > 0) {
	header('location: '.$url['_base'].'index.php?action=login');	
}
////////////////////////////////////////////////////////////////////////////////////



$inp = json_decode(file_get_contents("php://input"),true);

if (isset($inp['status']) && isset($inp['type'])) {

	if($inp['type'] == 'mobile'){
		
		$qr = $db->prepare("UPDATE `nmba_user` SET `notif_mobile`= '".$inp['status']."' WHERE id = '$id'");
		$qr->execute();
	}


	if($inp['type'] == 'email'){

		$qr = $db->prepare("UPDATE `nmba_user` SET `notif_email`= '".$inp['status']."' WHERE id = '$id'");
		$qr->execute();
	}


	$res['st'] = $inp['status'];
	echo json_encode($res);
	exit();
}


/////////////
if (isset($_POST['notif_sms_submit'])) {


	$user_account_type = $_SESSION['user_account_type'];
	if ($user_account_type != 'super-admin') {
		header('location: '.$url['_base'].'index.php?action=login');
	}

	$notif_sms_message = $_POST['notif_sms_message'];
	$notif_sms_user_type = $_POST['notif_sms_user_type'];
	if ($notif_sms_user_type == 'all') {
		$qr = $db->prepare("SELECT name, mobile, notif_mobile FROM `nmba_user`");
		$qr->execute();
	}else{
		$qr = $db->prepare("SELECT name, mobile, notif_mobile FROM `nmba_user` WHERE user_account_type = '$notif_sms_user_type'");
		$qr->execute();
		if ($notif_sms_user_type == 'admin') {
			$qr = $db->prepare("SELECT name, mobile, notif_mobile FROM `nmba_user` WHERE user_account_type='admin' OR user_account_type='super-admin'");
			$qr->execute();
		}
	}

	if ($qr->rowCount() > 0) {
		
		while ($r = $qr->fetch(PDO::FETCH_ASSOC)) {
			if ($r['notif_mobile'] == 'on') {
				$mobile_msg = 'Hi '.ucfirst($r['name']).', '.$notif_sms_message;
				if(send_sms($r['mobile'], $mobile_msg) == 'success'){
					$d++;
				}
			}
		}
	}
	$msg1 = '<div class="alert alert-success alert-raised alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	<h5>'.$d.' Messaged</h5></div>';
}



//////////////
if (isset($_POST['notif_email_submit'])) {


	$user_account_type = $_SESSION['user_account_type'];
	if ($user_account_type != 'super-admin') {
		header('location: '.$url['_base'].'index.php?action=login');
	}




	$notif_email_title = $_POST['notif_email_title'];
	$notif_email_message = $_POST['notif_email_message'];
	$notif_email_user_type = $_POST['notif_email_user_type'];

	if ($notif_email_user_type == 'all') {

		$qr = $db->prepare("SELECT email, notif_email FROM `nmba_user` ");

	}else{

		$qr = $db->prepare("SELECT email, notif_email FROM `nmba_user` WHERE user_account_type = '$notif_email_user_type'");

		if ($notif_email_user_type == 'admin') {
			$qr = $db->prepare("SELECT email, notif_email FROM `nmba_user` WHERE user_account_type='admin' OR user_account_type='super-admin'");
		}
	}

	$qr->execute();

	if ($qr->rowCount() > 0) {
		require($path['_base'].'config/mail_functions.php');
		
		$emails = array();

		while ($r = $qr->fetch(PDO::FETCH_ASSOC)) {
			if ($r['notif_email'] == 'on') {
				array_push($emails, $r['email']);

				$email_msg = '<h4>Hello NMBA Member,</h4>
				<h3>'.ucfirst($notif_email_title).'</h3>
				<h5>'.$notif_email_message.'</h5>';
			}
		}


		if(!(isset($_FILES['notif_email_image1']) && (file_exists($_FILES['notif_email_image1']['tmp_name']) || is_uploaded_file($_FILES['notif_email_image1']['tmp_name']))) && !(isset($_FILES['notif_email_image1']) && (file_exists($_FILES['notif_email_image1']['tmp_name']) || is_uploaded_file($_FILES['notif_email_image1']['tmp_name']))) ) {

			if(send_mail($emails, 'noreply@nmba.in', 'NMBA', 'NMBA: Notification', $email_msg) == 'success'){
				$msg2 = '<div class="alert alert-success alert-raised alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h5>Successfully Emailed</h5></div>';
			}
		}


		if((isset($_FILES['notif_email_image1']) && (file_exists($_FILES['notif_email_image1']['tmp_name']) || is_uploaded_file($_FILES['notif_email_image1']['tmp_name']))) && !(isset($_FILES['notif_email_image2']) && (file_exists($_FILES['notif_email_image2']['tmp_name']) || is_uploaded_file($_FILES['notif_email_image2']['tmp_name'])))) {

			$target_file = $path['_views'].'asset/images/tmp/'.basename($_FILES["notif_email_image1"]["name"]);
			
			if(move_uploaded_file($_FILES["notif_email_image1"]["tmp_name"], $target_file)){
				$files = array($target_file);

				if(send_mail($emails, 'noreply@nmba.in', 'NMBA', 'NMBA: Notification', $email_msg,$files ) == 'success'){
					$msg2 = '<div class="alert alert-success alert-raised alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h5>Successfully Emailed</h5></div>';
				}
			}else{
				echo $_FILES['notif_email_image1']['error'];
			}
		}


		if((isset($_FILES['notif_email_image1']) && (file_exists($_FILES['notif_email_image1']['tmp_name']) || is_uploaded_file($_FILES['notif_email_image1']['tmp_name']))) && (isset($_FILES['notif_email_image2']) && (file_exists($_FILES['notif_email_image2']['tmp_name']) || is_uploaded_file($_FILES['notif_email_image2']['tmp_name'])))) {

			$target_file1 = $path['_views'].'asset/images/tmp/'.basename($_FILES["notif_email_image1"]["name"]);

			$target_file2 = $path['_views'].'asset/images/tmp/'.basename($_FILES["notif_email_image2"]["name"]);
			
			if((move_uploaded_file($_FILES["notif_email_image1"]["tmp_name"], $target_file1)) && (move_uploaded_file($_FILES["notif_email_image2"]["tmp_name"], $target_file2))){

				$files = array($target_file1, $target_file2);

				if(send_mail($emails, 'noreply@nmba.in', 'NMBA', 'NMBA: Notification', $email_msg,$files ) == 'success'){
					$msg2 = '<div class="alert alert-success alert-raised alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h5>Successfully Emailed</h5></div>';
				}
			}else{
				echo $_FILES['notif_email_image1']['error'];
			}
		}
	}

}




/////////////////////////////////////////////
if (isset($_POST['request_admin'])) {
	require($path['_base'].'config/mail_functions.php');

	$name = $_POST['name'];
	$type = $_POST['type'];
	$email = $_POST['email'];
	$number = $_POST['number'];
	$address = $_POST['address'];

	switch ($type) {
		case 'email':
			$email_msg = 'Hello NMBA Admin, <br><br>Myself <i>'.$name.'</i>, Request you to <b>change my email address</b> on NMBA-MMS [MemBraiN] Portal.<br>My current email-id is: <a href="mailto:'.$email.'">'.$email.'</a><br>My mobile number is: <a href="tel:'.$number.'">'.$number.'</a> <small>(For Verification)</small><br><br><small>For any enquiry <a href="tel:'.$number.'">Call</a> or <a href="mailto:'.$email.'">Email</a></small>';
			if(send_mail($auth_email, 'noreply@nmba.in', 'NMBA', 'NMBA: Member Email-Id Change Request', $email_msg) == 'success'){ echo '1'; }
		break;

		case 'phone':
			$email_msg = 'Hello NMBA Admin, <br><br>Myself <i>'.$name.'</i>, Request you to <b>change my Mobile Number</b> on NMBA-MMS [MemBraiN] Portal.<br>My current Mobile Number is: <a href="tel:'.$number.'">'.$number.'</a><br>My Email-Id is: <a href="mailto:'.$email.'">'.$email.'</a> <small>(For Verification)</small><br><br><small>For any enquiry <a href="tel:'.$number.'">Call</a> or <a href="mailto:'.$email.'">Email</a></small>';
			if(send_mail($auth_email, 'noreply@nmba.in', 'NMBA', 'NMBA: Member Mobile Number Change Request', $email_msg) == 'success'){ echo '1'; }
		break;

		case 'address':
			$email_msg = 'Hello NMBA Admin, <br><br>Myself <i>'.$name.'</i>, Request you to <b>change my Residential Address</b> on NMBA-MMS [MemBraiN] Portal.<br><br>My current Residential Address is: '.$address.'<br>My Email-Id is: <a href="mailto:'.$email.'">'.$email.'</a> <small>(For Verification)</small><br>My mobile number is: <a href="tel:'.$number.'">'.$number.'</a> <small>(For Verification)</small><br><br><small>For any enquiry <a href="tel:'.$number.'">Call</a> or <a href="mailto:'.$email.'">Email</a></small>';
			if(send_mail($auth_email, 'noreply@nmba.in', 'NMBA', 'NMBA: Member Residential Address Change Request', $email_msg) == 'success'){ echo '1'; }
		break;
	}


	exit();
}


require_once($path['_views'] . 'notification.php');
exit();