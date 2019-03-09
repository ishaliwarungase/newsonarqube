<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST ');
header('Access-Control-Max-Age: 1000');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers:Content-Type, Accept, X-Requested-With, Session, Content-Range, Content-Disposition, Content-Description ');

require_once "config/config.php";

$action = isset($_GET['action']) ? $_GET['action'] : '';


if (($action != 'forgot_password') && ($action != 'signup') && ($action != 'signup_otp') && ($action != 'iframe_calender') ) {

	if((empty($_SESSION['user_input']) && empty($_SESSION['password']) && empty($_SESSION['user_id'])) || empty($action) ){
		$action = 'login';
	}
}


switch ($action) {
	
	case "login":
		include_once($path['_modules'].'login.php');
	break;

	case "iframe_calender":
		include_once($path['_modules'].'iframe_calender.php');
	break;

	case "home":
		include_once($path['_modules'].'home.php');
	break;

	case "profile":
		include_once($path['_modules'].'profile.php');
	break;

	case "admin":
		include_once($path['_modules'].'admin.php');
	break;

	case "payment":
		include_once($path['_modules'].'payment.php');
	break;

	case "member":
		include_once($path['_modules'].'member.php');
	break;

	case "forgot_password":
		include_once($path['_modules'].'forgot_password.php');
	break;

	case "signup":
		include_once($path['_modules'].'signup.php');
	break;

	case "signup_otp":
		include_once($path['_modules'].'signup_otp.php');
	break;

	case "notification":
		include_once($path['_modules'].'notification.php');
	break;

	case "report":
		include_once($path['_modules'].'report.php');
	break;

	case "notice":
		include_once($path['_modules'].'notice.php');
	break;

	case "event":
		include_once($path['_modules'].'event.php');
	break;

	case "fee_year":
		include_once($path['_modules'].'fee_year.php');
	break;

	default:
		include_once($path['_modules'].'login.php');
	break;
}




