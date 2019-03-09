<?php

$db = conn();
$qr = $db->prepare("SELECT id , title, from_date_time, to_date_time, event_type FROM nmba_event");
$qr->execute();

if ($qr->rowCount() > 0) {	

	$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{
	$res = 'NO EVENT TO DISPLAY';
}


require_once($path['_views'] . 'iframe_calender.php');
exit();