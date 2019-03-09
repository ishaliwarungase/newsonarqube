<?php
session_start();
require_once realpath(__DIR__).'/../config/config.php';

function is_ajax() {
return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

	$inp = json_decode(file_get_contents("php://input"),true);

	if ((isset($inp['mobile']) && isset($inp['email'])) && (isset($_SESSION['signup_otp1']) && isset($_SESSION['signup_otp2']))) {

		if ($_SESSION['signup_otp2'] == $inp['mobile']) {
			$res['res1'] = "1";
		}else{
			$res['res1'] = "&rarrtl; Invalid <b>Mobile OTP</b> provided<br>";
		}

		if ($_SESSION['signup_otp1'] == $inp['email']) {
			$res['res2'] = "1";
		}else{
			$res['res2'] = "&rarrtl; Invalid <b>Email OTP</b> provided<br>";
		}

	}else{
		$res['res'] = "Invalid Data, Signup again<br>";
	}

	
}else{
	$res['res'] = "Invalid Data, Signup again<br>";
}
echo json_encode($res);