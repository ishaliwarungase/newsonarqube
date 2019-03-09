<?php

if(isset($_POST['login_button'])){

	$user_input =$_POST['user_input'];
	$password =$_POST['password'];

	$db = conn();
	$qr = $db->prepare("SELECT id,name, mobile, dob, user_account_type FROM `nmba_user` WHERE (mobile = '$user_input' OR email = '$user_input' OR membership_id = '$user_input') AND (password = '$password') LIMIT 1");
	$qr->execute();

	if ($qr->rowCount() > 0) {

		$data = $qr->fetch(PDO::FETCH_ASSOC);
		$_SESSION['user_id'] = $data['id'];
		$_SESSION['user_name'] = $data['name'];
		$_SESSION['user_number'] = $data['mobile'];
		$_SESSION['user_account_type'] = $data['user_account_type'];
		$_SESSION['password'] = $password;

		$age = (date('Y') - date('Y',strtotime($data['dob'])));
		if($age <= 60){
			$senior_citizen = 'no';
		}else{
			$senior_citizen = 'yes';
		}

		$last_log = strtotime("now");
		$qrr = $db->prepare("UPDATE `nmba_user` SET `last_logged_in_date_time`= '$last_log',`senior_citizen` = '$senior_citizen' WHERE id = '".$data['id']."'");
		$qrr->execute();

		header("location: ". $url['_base'] . 'index.php?action=home');
		exit();
		
	}else{
		$msg = '<div class="alert alert-danger alert-dismissible fade in text-center" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		</button><strong>User does not exists<br>Check credentials and retry</strong></div>';
	}

}

if (isset($_SESSION['user_number']) || isset($_SESSION['password']) || isset($_SESSION['user_id']) || isset($_SESSION['user_account_type'])) {

	unset($_SESSION['user_number']);
	unset($_SESSION['password']);
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_account_type']);
}


require_once($path['_views'] . 'login.php');
exit();