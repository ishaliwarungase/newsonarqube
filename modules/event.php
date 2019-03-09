<?php

////////////////////////////
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_number']) && !isset($_SESSION['password'])) {
	header('location: '.$url['_base'].'index.php?action=login');
}

$user_account_type = $_SESSION['user_account_type'];
if (($user_account_type != 'super-admin') AND ($user_account_type != 'admin')) {
	header('location: '.$url['_base'].'index.php?action=login');
}

////////////////////////////
$db = conn();
$id = $_SESSION['user_id'];
$mobile = $_SESSION['user_number'];
$password = $_SESSION['password'];

////////////////////////////
$qr = $db->prepare("SELECT id FROM `nmba_user` WHERE (id = '$id') AND (mobile = '$mobile') AND (password = '$password') LIMIT 1");
$qr->execute();

////////////////////////////
if (!$qr->rowCount() > 0) {
	header('location: '.$url['_base'].'index.php?action=login');	
}
////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['event_create'])){

	require_once($path['_views'] . 'event_create.php');
	exit();

}

/////////// CREATE EVENT ///////////

if(isset($_POST['event_submit'])){

	$title =$_POST['validate_title'];
	$event_type =$_POST['event_type'];
	$location =$_POST['validate_location'];
	$from_date =strtotime($_POST['validate_sdate']);
	$to_date =strtotime($_POST['validate_edate']);
	$description =$_POST['description'];


	$target_dir = $path['_views'].'asset/images/event/';
	$imageFileType = strtolower(pathinfo($_FILES["event_image"]["name"],PATHINFO_EXTENSION));
	$img = $image['name']. '.'.$imageFileType;
	$target_file = $target_dir. $img;
	$uploadOk = 1;
	

	$check = getimagesize($_FILES["event_image"]["tmp_name"]);

	if($check !== false) {
		$uploadOk = 1;
	} else {
		$msg .= "File is not an image.";
		$uploadOk = 0;
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		$msg .= "Sorry, file already exists.";
		$uploadOk = 0;
	}
	
	// Check file size
	if ($_FILES["event_image"]["size"] > 10000000) {
		$msg .= "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		$msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.[$imageFileType]";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$msg .= "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file

	} else {

		if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file)) {

			$db = conn();
			$qr = $db->prepare("INSERT INTO `nmba_event`(`title`, `description`, `image`, `location`, `from_date_time`, `to_date_time`, `event_type`) VALUES ('$title', '$description', '$img', '$location', '$from_date', '$to_date', '$event_type')");
			$qr->execute();

			if ($qr->rowCount() > 0) {	

				$msg .= 'success';

				///////////
				if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
					$activity = 'Created new event: '.$title;
					$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
					$qr2->execute();
				}
				//////////

			}else{

				$msg .= 'Invalid input';
			}

		} else {
			$msg .= "Sorry, there was an error uploading your file.";
		}
	}
}	

///////CLICK EDIT BUTTON IN MANAGE EVENT////////
if(isset($_POST['edit_event'])){

	$eid =$_POST['event_id'];

	$qr = $db->prepare("SELECT * FROM `nmba_event` WHERE id = '$eid'");
	$qr->execute();
	
	if ($qr->rowCount() > 0) {	

		$edit_event = $qr->fetchAll(PDO::FETCH_ASSOC);
	
	}else{

		$edit_event = 'Member doesnt exists';
		
	}
////////////////////////////////////////////
	require_once($path['_views'] . 'event_create.php');
	exit();

}

////////CLICK ON EDIT EVENT////////
if(isset($_POST['update_event'])){

	$event_id =$_POST['eid'];
	$title =$_POST['validate_title'];
	$event_type =$_POST['event_type'];
	$location =$_POST['validate_location'];
	$from_date =strtotime($_POST['validate_sdate']);
	$to_date =strtotime($_POST['validate_edate']);
	$description =$_POST['description'];


	$qr = $db->prepare("UPDATE nmba_event SET title ='$title', description ='$description', location ='$location', from_date_time='$from_date', to_date_time ='$to_date', event_type ='$event_type' WHERE id = '$event_id'");
	$qr->execute();
		
	if ($qr->rowCount() > 0) {	

		$msg = 'success';

		///////////
		if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
			$activity = 'updated event: '.$title;
			$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
			$qr2->execute();
				}
		//////////
	}else{
		
		$msg = 'Invalid input';
			
	}	
		header("location: ".$url['_base']."index.php?action=event ");

}

/////CLICK EDIT BUTTON IN MANAGE EVENT//////
if(isset($_POST['event_delete'])){

	$eid =$_POST['eid'];

	$qr = $db->prepare("SELECT title, image FROM `nmba_event` WHERE id = '$eid'");
	$qr->execute();
	$r = $qr->fetchAll(PDO::FETCH_ASSOC);
	$image = $r[0]['image'];
	$title = $r[0]['title'];
	

	@unlink($path['_views'] . 'asset/images/event/' . $image);
	$qr = $db->prepare("DELETE FROM nmba_event WHERE id = '$eid'");
	$qr->execute();

		///////////
		if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
			$activity = 'Deleted event: '.$title;
			$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
			$qr2->execute();
		}
		//////////

	header("location: ".$url['_base']."index.php?action=event ");
}

////////DISPLAY EVENT MANAGE PAGE///////////

$qr = $db->prepare("SELECT id , title, description, image, location, from_date_time, to_date_time, event_type FROM nmba_event ORDER BY id DESC ");
$qr->execute();

if ($qr->rowCount() > 0) {	

	$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{
	$res = 'NO DATAT TO DISPLAY';
}


require_once($path['_views'] . 'event_manage.php');
exit();