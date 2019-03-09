<?php


$db = conn();

if(isset($_POST['signup_submit'])){

	$input_name = $_POST['input_name'];
	$input_mobile = $_POST['input_mobile'];
	$input_email = 	$_POST['input_email'];
	$input_dob = $_POST['input_dob'];

	$qrr = $db->prepare("SELECT name, initial FROM nmba_user WHERE mobile = '$input_mobile' OR email = '$input_email' LIMIT 1");
	$qrr->execute();

	if ($qrr->rowCount() == 0) {

		$otp1 = mt_rand(1111,9999);
		$otp2 = mt_rand(1111,9999);

		$email_msg = '<h4>Hello '.ucfirst($input_name).',</h4>
			<h1 class="align-center">'.$otp1.'</h1>
			<h5 class="align-center">is your Email OTP for NMBA account registration.</h5>';

		require($path['_base'].'config/mail_functions.php');

		$input_email_arr = 	array($input_email);        
		$msg1 = send_mail($input_email_arr, 'noreply@nmba.in', 'NMBA', 'NMBA:Account Registration OTP', $email_msg);

		$mobile_msg = 'Hello '.ucfirst($input_name).', '.$otp2.' is your Mobile OTP for NMBA account registration.';

		$msg2 = send_sms($input_mobile, $mobile_msg);

		if ($msg1 == 'success' && $msg2 == 'success') {

			$_SESSION['signup_name'] = $input_name;
			$_SESSION['signup_mobile'] = $input_mobile;
			$_SESSION['signup_email'] = $input_email;
			$_SESSION['signup_dob'] = $input_dob;
			$_SESSION['signup_otp1'] = $otp1;
			$_SESSION['signup_otp2'] = $otp2;

			header("location: ". $url['_views'] . 'signup_otp.php' );
			exit();
			
		}else{
			$st = 2;
			$data = $msg1 .'--<br>--'. $msg2;
		}

	}else{
		$res = $qrr->fetch(PDO::FETCH_ASSOC);
		$data = 'This mobile number or email belongs to '. ucfirst( $res['initial'] ) . ' ' . ucfirst( $res['name'] ) .'<br><h4><a href="'.$url['_base'].'index.php?action=login"> Login to procced  </a> <br> </h4><br><h5><a href="'.$url['_base'].'index.php?action=signup"> Try Signup Again</a> <br> </h5>';
		$st = 2;
	}

}


if(isset($_POST['complete_signup'])){

	$signup_name = strtolower( $_SESSION['signup_name'] );
	$signup_mobile = $_SESSION['signup_mobile'];
	$signup_email = strtolower( $_SESSION['signup_email'] );
	$signup_dob = strtotime( $_SESSION['signup_dob'] );
	$signup_gender = strtolower( $_POST['signup_gender'] );
	$signup_blood = strtoupper( $_POST['signup_blood'] );
	$signup_initial = ucfirst( $_POST['signup_initial'] );
	$signup_password = $_POST['signup_password'];	
	$acc_create = strtotime("now");	

	$qrr = $db->prepare("SELECT membership_id FROM nmba_user WHERE membership_category = 'non-member' ORDER BY membership_id DESC LIMIT 1");
	$qrr->execute();

	$mem_id = $qrr->fetch(PDO::FETCH_ASSOC)['membership_id'];
	$mem_id = $mem_id + 1;

	$qr = $db->prepare(" INSERT INTO nmba_user(name, mobile, email, membership_id, password, initial, gender, dob, blood_group, account_created_date_time) 
		VALUES('$signup_name','$signup_mobile','$signup_email','$mem_id','$signup_password','$signup_initial','$signup_gender','$signup_dob','$signup_blood','$acc_create')");
	$qr->execute();
	
	if ($qr->rowCount() > 0) {

		$_SESSION['user_id'] = $db->lastInsertId();
		$_SESSION['user_name'] = $signup_name;
		$_SESSION['user_number'] = $signup_mobile;
		$_SESSION['user_account_type'] = 'non-member';
		$_SESSION['password'] = $signup_password;

		header("location: ". $url['_base'] . 'index.php?action=home');
		exit();

	}else{
		$msg = "Error Inserting Data.";
	}
}

require_once($path['_views'] . 'signup.php');
exit();
