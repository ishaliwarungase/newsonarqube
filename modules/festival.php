<?php
require_once realpath(__DIR__).'/../config/config.php';

$db = conn();
$d = $e = 0;
$qr = $db->prepare("SELECT `id`, `name`, `date` FROM `nmba_festivals` WHERE date = CURDATE()");
$qr->execute();

if ($qr->rowCount() > 0) {	
	$fest = $qr->fetchAll(PDO::FETCH_ASSOC)[0]['name'];

	$qrr = $db->prepare("SELECT name, mobile, notif_mobile, email, notif_email FROM `nmba_user` ");
	$qrr->execute();
	if ($qrr->rowCount() > 0) {
		require($path['_base'].'config/mail_functions.php');
		$emails = array();
		
		while ($r = $qrr->fetch(PDO::FETCH_ASSOC)) {
			if ($r['notif_mobile'] == 'on') {
				$mobile_msg = 'Hi '.$r['name'].', '.$fest;
				if(send_sms($r['mobile'], $mobile_msg) == 'success'){
					$d++;
				}
			}
			
			if ($r['notif_email'] == 'on') {
				array_push($emails, $r['email']);
				$email_msg = '<h4>Hello '.ucfirst($r['name']).',</h4>
				<h3>NMBA Festival</h3>
				<h5>'.$fest.'</h5>';
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