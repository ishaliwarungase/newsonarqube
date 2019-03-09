<?php
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Max-Age: 1000');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers:Content-Type, Accept, X-Requested-With, Session, Content-Range, Content-Disposition, Content-Description ');

$env = "dev";

if($env == "dev"){

////////////////////////////////////////////////////////////////////////////////////

	$ip = '10.0.42.1/';
	$cur_dir = 'nmba/';
	$protocol = 'http';

	$path['_base'] = realpath(__DIR__).'/../';
	$path['_modules'] = $path['_base'] . 'modules/';
	$path['_views'] = $path['_base'] . 'views/';
	$path['_files'] = $path['_views'] . 'files/';

	$url['_base'] = $protocol.'://' . $ip . $cur_dir;
	$url['_views'] = $url['_base'] . 'views/';
	$url['_asset'] = $url['_views'] . 'asset/';
	$url['_modules'] = $url['_base'] . 'modules/';
	$url['_api'] = $protocol.'://' . $ip . $cur_dir . 'api/nmba.php?';

	$auth_email['vrushali'] = "vrushali.ahirrao@os3infotech.com";
	$auth_email['gaurav'] = "gaurav.gawhane@os3infotech.com";
	$auth_email['ravi'] = "ravikumar.thakur@os3infotech.com";

	$site['title'] = 'MeMBraiN';
	
	///API///
	$data['hashtag'] = 'rangerover';
	$data['trending_count'] = '30';

	$image['name'] = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',10)),0,15);

	function conn(){
		$dbhost="localhost";
		$dbuser="root";
		$dbpass="12345678";
		$dbname="nmba_mms";

		$db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES UTF8");
		return $db;
	}

	function send_sms($mob, $msg){
		$api = 'http://smspush.skinfotechs.com/app/smsapi/index.php?key=558F2830F479F2&routeid=8&type=text&contacts='.$mob.'&senderid=NMBAMC&msg='.urlencode($msg).'+CONF';

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$api);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$r = curl_exec($ch);
		curl_close($ch);

		if (preg_match('/\SMS-SHOOT-ID\b/',$r)){ 
			return 'success';
		}else{
			return 'Error Sending SMS OTP : '. $r;
		}
	}

////////////////////////////////////////////////////////////////////////////////////

}elseif($env == "prod"){

////////////////////////////////////////////////////////////////////////////////////

	$ip = 'nmba.in/';
	$cur_dir = 'mms/';
	$protocol = 'https';

	$path['_base'] = realpath(__DIR__).'/../';
	$path['_modules'] = $path['_base'] . 'modules/';
	$path['_views'] = $path['_base'] . 'views/';
	$path['_files'] = $path['_views'] . 'files/';

	$url['_base'] = $protocol.'://' . $ip . $cur_dir;
	$url['_views'] = $url['_base'] . 'views/';
	$url['_asset'] = $url['_views'] . 'asset/';
	$url['_modules'] = $url['_base'] . 'modules/';
	$url['_api'] = $protocol.'://' . $ip . $cur_dir . 'api/nmba.php?';

	
	$auth_email['admin'] = "admin@nmba.in";
    $auth_email['president'] = "president@nmba.in";
	$auth_email['gaurav'] = "gaurav.gawhane@os3infotech.com";
	$auth_email['ravi'] = "ravikumar.thakur@os3infotech.com";
	
	////API///
	$data['hashtag'] = 'rangerover';
	$data['trending_count'] = '30';

	$site['title'] = 'MeMBraiN';

	$image['name'] = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',10)),0,15);

	function conn(){
		$dbhost="localhost";
		$dbuser="nmbai4be_db_user";
		$dbpass="MahitNahi#12";
		$dbname="nmbai4be_mms";

		$db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES UTF8");
		return $db;
	}

	function send_sms($mob, $msg){
		$api = 'http://smspush.skinfotechs.com/app/smsapi/index.php?key=558F2830F479F2&routeid=8&type=text&contacts='.$mob.'&senderid=NMBAMC&msg='.urlencode($msg).'+CONF';

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$api_url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$r = curl_exec($ch);
		curl_close($ch);

		if (preg_match('/\SMS-SHOOT-ID\b/',$r)){ 
			return 'success';
		}else{
			return 'Error Sending SMS OTP : '. $r;
		}
	}

////////////////////////////////////////////////////////////////////////////////////

}