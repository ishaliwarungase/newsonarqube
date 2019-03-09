<?php
require_once realpath(__DIR__).'/../config/config.php';

$db = conn();
$d = $e = 0;
$qr = $db->prepare("SELECT `id`,`name`, `initial`, `dob` FROM `nmba_user`WHERE DATE_FORMAT(FROM_UNIXTIME(dob),'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
$qr->execute();

if ($qr->rowCount() > 0) {	
	while($r = $qr->fetch(PDO::FETCH_ASSOC)){
			$id = $r['id'];
			$name = $r['initial'].' '.$r['name'];
			$dob = $r['dob'];
			$age = (date('Y') - date('Y',$dob))-1;
	}

	
	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
	if (($age %100) >= 11 && ($age%100) <= 13){
	  	$ag = $age. 'th';
	}else{
	  	$ag = $age. $ends[$age % 10];
	}
   

	$qrr = $db->prepare("SELECT name, mobile, notif_mobile, email, notif_email FROM `nmba_user` WHERE id = '$id'");
	$qrr->execute();
	if ($qrr->rowCount() > 0) {
		require($path['_base'].'config/mail_functions.php');
		$emails = array();
		
		while ($r = $qrr->fetch(PDO::FETCH_ASSOC)) {
			if ($r['notif_mobile'] == 'on') {
				$mobile_msg = 'Hi '.$name.', Warm Wishes on Your '.$ag.' Birthday. We Wish This Day is as Beautiful as You are. ';
				if(send_sms($r['mobile'], $mobile_msg) == 'success'){
					$d++;
				}
			}
			
			if ($r['notif_email'] == 'on') {
				array_push($emails, $r['email']);
				$email_msg = '<h3>Hello '.ucfirst($name).',</h3>
				<h5 class="align-center"><b> Warm Wishes on Your '.$ag.' Birthday.</b></h5>
				<h4 class="align-center">We Wish This Day is as Beautiful as You are. </h4>
				<img src = "https://media.giphy.com/media/hRS2MZzDx933i/giphy.gif" style = "height:auto; width:250px; display:block; margin-left:auto; margin-right:auto; -webkit-border-radius: 12px;
					-moz-border-radius: 12px;border-radius: 12px;" title = "NMBA Birthday Wish Banner" onerror = "NMBA Birthday Wish Banner" alt = "NMBA Birthday Wish Banner" class = "align-center" >	';
				if(send_mail($emails, 'noreply@nmba.in', 'NMBA', 'NMBA: Notification', $email_msg) == 'success'){
					$e++;
				}
			}

		}
	}
	
 	$res = 'total sms sent:'.$d.' & total email sent:'.$e;
}else{

	$res = 'No Data';
}
echo $res;

?>