<?php

if(isset($_POST['forgot_password_submit'])){

	$input =$_POST['input'];
	$otp_method =$_POST['otp_method'];

	$db = conn();
	$qr = $db->prepare("SELECT name, email, mobile, password, initial FROM `nmba_user` WHERE mobile = '$input' OR email = '$input' OR membership_id = '$input' LIMIT 1");
	$qr->execute();
	
	if ($qr->rowCount() > 0) {	

		$res = $qr->fetch(PDO::FETCH_ASSOC);
		$mob_number = $res['mobile'];
		$email = $res['email'];
		$password = $res['password'];
		$name = $res['name'];
		$initial = $res['initial'];
	
		if ($otp_method == 'email') {

			$contact = substr_replace($email, 'XXXXXX', -6);

			$email_msg = '<h4>Hello '.ucwords($initial .' '. $name).',</h4>
					<h1 class="align-center">'.$password.'</h1>
					<h5 class="align-center">is your password for NMBA account.</h5>';
			
			$msg = send_email($email, 'noreply@nmba.in', 'NMBA', 'NMBA', 'NMBA: Password Recovery Email', $email_msg);

		}elseif ($otp_method == 'mobile') {

			$contact = substr_replace($mob_number, 'XXXXX', -5);

			$mobile_msg = 'Hello '.ucwords($initial .' '. $name).', '.$password.' is your password for NMBA account.';
			$msg = send_sms($mob_number, $mobile_msg);

		}

	}else{
		$msg = 'Invalid input: User doesnt exists';
	}

}


require_once($path['_views'] . 'forgot_password.php');
exit();
