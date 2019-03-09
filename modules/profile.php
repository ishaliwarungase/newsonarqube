<?php

////////////////////////////
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_number']) && !isset($_SESSION['password'])) {
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

$msg = '';

if(isset($_POST['add_family'])){

	require_once($path['_views'] . 'profile_add_family_member.php');
	exit();

}


/////////////////////////////////////////////////////////////////////////////////////////////



if(isset($_POST['edit_family'])){
	$uid = $_POST['mem_id'];

	$qr = $db->prepare("SELECT `id`, `name`, `spouse_member_id`, `relation`, `gender`, `dob`, `blood_group`, `dependency`, `occupation`  FROM `nmba_user_family` WHERE id = '$uid'");
	$qr->execute();

	if ($qr->rowCount() > 0) {	

		$edit_family_res = $qr->fetchAll(PDO::FETCH_ASSOC);
	}else{
		
		$edit_family_res = 0;

	}

	require_once($path['_views'] .'profile_add_family_member.php');
	exit();

}

////////////SUBMIT MEMBERSHIP DETAILS FORM1/////////////////

if(isset($_POST['submit_member'])){

	$intro_name =$_POST['intro_name'];
	$id_issued =$_POST['id_issued'];
	$voting_right =$_POST['voting_right'];
	$date_of_admission =strtotime($_POST['date_of_admission']);
	$membership_status =$_POST['membership_status'];
	$membership_category =$_POST['membership_category'];
	$user_account_type =$_POST['user_account_type'];
	$password =$_POST['password'];

	$qr = $db->prepare("UPDATE `nmba_user` SET `password`= '$password',`introduce_by`='$intro_name',`id_issued`='$id_issued',`membership_status`='$membership_status',`membership_category`='$membership_category',`voting_right`= '$voting_right',`user_account_type`='$user_account_type',`date_of_addmission`='$date_of_admission'
		WHERE id = '$uid'");
	$qr->execute();

	if ($qr->rowCount() > 0) {	

		$msg = 'success';
	}else{
		
		$msg = 'Invalid input';

	}	

}


////////////SUBMIT PERSONAL DETAILS FORM2/////////////////

if(isset($_POST['submit_personal'])){

	$str = '';
	$name =$_POST['name'];
	$join_reason =$_POST['join_reason'];
	$gender =$_POST['gender'];
	$dob = strtotime($_POST['dob']);
	$blood_group =strtoupper($_POST['blood_group']);
	$profession =$_POST['profession'];
	$designation =$_POST['designation'];
	$organization =$_POST['organization'];

	foreach ( $_POST['area_of_interest'] AS $opt){
		$str .= $opt. ',';
	}

	$str = rtrim($str,',');
	$dob = strtotime($_POST['dob']);
	$age = (date('Y') - date('Y',$dob));
	if($age <= 60){ $senior_citizen = 'no'; }else{ $senior_citizen = 'yes'; }

	$target_dir = $path['_views'].'asset/images/profile/';
	$imageFileType = strtolower(pathinfo($_FILES["profile_image"]["name"],PATHINFO_EXTENSION));
	$img = $image['name']. '.'.$imageFileType;
	$target_file = $target_dir. $img;
	$uploadOk = 1;
	

	if ((isset($_FILES['profile_image']) && (file_exists($_FILES['profile_image']['tmp_name']) || is_uploaded_file($_FILES['profile_image']['tmp_name'])))) {
		
		$check = getimagesize($_FILES["profile_image"]["tmp_name"]);

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
		if ($_FILES["profile_image"]["size"] > 500000) {
			$msg .= "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.[$imageFileType]";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			$msg .= "Sorry, your file was not uploaded.";

		} else {

			if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {

				$qr = $db->prepare("UPDATE `nmba_user` SET `name`= '$name',`join_reason` = '$join_reason',`profession`='$profession',`designation`='$designation', `area_of_interest`='$str',`image`='$img',`organization`='$organization' WHERE id = '$id' ");

				$qr->execute();

				if ($qr->rowCount() > 0) {	

					$msg .= 'success';
				}else{
					
					$msg .= 'Invalid input';

				}

			}
		}

	}else{

		$qr = $db->prepare("UPDATE `nmba_user` SET `name`= '$name',`join_reason` = '$join_reason',`profession`='$profession',`designation`='$designation', `area_of_interest`='$str', organization='$organization' WHERE id = '$id' ");
		$qr->execute();
		if ($qr->rowCount() > 0) {	
			$msg .= 'success';
		}else{
			$msg .= 'Invalid input';
		}
	}
}	


////////////SUBMIT ADDRESS DETAILS FORM3/////////////////

if(isset($_POST['submit_address'])){

	$house_no =$_POST['house_no'];
	
	$area =$_POST['area'];
	$sector = $_POST['sector'];
	$city =$_POST['city'];
	
	$qr = $db->prepare("UPDATE `nmba_user` SET `flat_house_no`='$house_no',`area`='$area',`sector`='$sector',`city_node`='$city' WHERE id = '$id'");
	$qr->execute();

	if ($qr->rowCount() > 0) {	

		$msg = 'success';
	}else{
		
		$msg = 'Invalid input';

	}
}	

/////////////// ADD FAMILY /////////////

if(isset($_POST['submit_family'])){

	$name =$_POST['validate_name'];
	$relation =$_POST['validate_relation'];
	$blood_group =strtoupper($_POST['validate_blood']);
	$gender =$_POST['gender'];
	$occupation =$_POST['occupation'];
	$dependency =$_POST['dependency'];
	$dob =strtotime($_POST['validate_dob']);
	$spouse_id = $_SESSION['user_id'];
	
	$qr = $db->prepare("INSERT INTO `nmba_user_family`(`name`, spouse_member_id, `relation`, `gender`, `dob`, `blood_group`, `dependency`, `occupation`) VALUES ('$name', '$spouse_id','$relation', '$gender', '$dob', '$blood_group', '$dependency', '$occupation')");
	$qr->execute();

	if ($qr->rowCount() > 0) {	

		$msg = 'success';

	}else{
		
		$msg = 'Invalid input';
	}
}

/////////////// Update FAMILY /////////////

if(isset($_POST['update_family'])){

	$family_id =$_POST['fid'];
	$name =$_POST['validate_name'];
	$relation =$_POST['validate_relation'];
	$blood_group =strtoupper($_POST['validate_blood']);
	$gender =$_POST['gender'];
	$occupation =$_POST['occupation'];
	$dependency =$_POST['dependency'];
	$dob = strtotime($_POST['validate_dob']);
	$spouse_id = $_SESSION['user_id'];

	$qr = $db->prepare("UPDATE nmba_user_family SET name = '$name', spouse_member_id ='$spouse_id', relation = '$relation', gender = '$gender', dob = '$dob', blood_group = '$blood_group', dependency ='$dependency', occupation = '$occupation' WHERE id = '$family_id'");
	$qr->execute();

	if ($qr->rowCount() > 0) {

		$msg = 'success';

	}else{

		$msg = 'Invalid input';
	}
} 


//////////////////////Display Family////////////////////////////////
$qr = $db->prepare("SELECT `id`, `name`, `spouse_member_id`, `relation`, `gender`, `dob`, `blood_group`, `dependency`, `occupation`	FROM `nmba_user_family` WHERE spouse_member_id = '$id' ORDER BY id DESC");
$qr->execute();

if ($qr->rowCount() > 0) {	

	$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	
}else{

	$res = 'No Family member to display. Add New';
}




/////////////////////////// show my profile ///////////////////////////////

$qr = $db->prepare("SELECT * FROM nmba_user WHERE id ='$id' ");
$qr->execute();

if ($qr->rowCount() > 0) {

	$edit_my_profile = $qr->fetchAll(PDO::FETCH_ASSOC);

}else{

	$edit_my_profile = 'No profile to display';

}


require_once($path['_views'] . 'my_profile.php');
exit();