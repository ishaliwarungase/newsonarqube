<?php

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
$user_account_type = $_SESSION['user_account_type'];

////////////////////////////
$qr = $db->prepare("SELECT id FROM `nmba_user` WHERE (id = '$id') AND (mobile = '$mobile') AND (password = '$password') LIMIT 1");
$qr->execute();

////////////////////////////
if (!$qr->rowCount() > 0) {
	header('location: '.$url['_base'].'index.php?action=login');	
}
////////////////////////////////////////////////////////////////////////////////////

$msg = '';

/////////////////////////////////////////////////////////////

if(isset($_POST['member_detail'])){
	$uid =$_POST['member_id'];

	$qr = $db->prepare("SELECT * FROM nmba_user WHERE id ='$uid' ");
	$qr->execute();
	
	if ($qr->rowCount() > 0) {	

		$edit_member_details = $qr->fetchAll(PDO::FETCH_ASSOC);

	}else{

		$edit_member_details = 'Member doesnt exists';
		
	}

///////DISPLAY FAMILY MEMBER/////////

	$qr = $db->prepare("SELECT `id`, `name`, `spouse_member_id`, `relation`, `gender`, `dob`, `blood_group`, `dependency`, `occupation` FROM `nmba_user_family` WHERE spouse_member_id = '$uid' ORDER BY id DESC ");
	$qr->execute();

	if ($qr->rowCount() > 0) {    

		$res = $qr->fetchAll(PDO::FETCH_ASSOC);
		
	}else{

		$res = 'No Family member to display. Add New';
	}

	require_once($path['_views'] . 'member_detail.php');
	exit();

}

/////////EDIT FAMILY////////

if(isset($_POST['edit_family'])){
	$uid = $_POST['mem_id'];

	$db = conn();
	$qr = $db->prepare("SELECT `id`, `name`, `spouse_member_id`, `relation`, `gender`, `dob`, `blood_group`, `dependency`,`occupation` FROM `nmba_user_family` WHERE id = '$uid'");
	$qr->execute();

	if ($qr->rowCount() > 0) {	

		$edit_member_res = $qr->fetchAll(PDO::FETCH_ASSOC);
	}else{
		
		$edit_member_res = 0;

	}

	require_once($path['_views'] . 'member_edit_family_member.php');
	exit();

}


/////////Upadate Family////////

if(isset($_POST['update_mem_family'])){

	$member_family_id =$_POST['member_family_id'];
	$name =$_POST['name'];
	$relation =$_POST['relation'];
	$blood_group =strtoupper($_POST['blood_group']);
	$gender =$_POST['gender'];
	$occupation =$_POST['occupation'];
	$dependent =$_POST['dependency'];
	$dob = strtotime($_POST['validate_dob']);
// $spouse_id = $_SESSION['user_id'];


	$db = conn();
	$qr = $db->prepare("UPDATE nmba_user_family SET name = '$name', relation = '$relation', gender = '$gender', dob = '$dob', blood_group = '$blood_group', dependency ='$dependent', occupation = '$occupation' WHERE id = '$member_family_id'");
	$qr->execute();

	if ($qr->rowCount() > 0) {

		$msg = 'success';
		if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 

			$activity = 'Updated Family Details';
			$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
			$qr2->execute();
		}

	}else{

		$msg = 'Invalid input';
	}

} 

////////SUBMIT MEMBERSHIP DETAILS FORM1/////////

if(isset($_POST['submit_member'])){
	
	$uid = $_POST['uid'];
	$intro_name =$_POST['intro_name'];
	$id_issued =$_POST['id_issued'];
	$voting_right =$_POST['voting_right'];
	$date_of_admission =strtotime($_POST['date_of_admission']);
	$membership_status =$_POST['membership_status'];
	$membership_category =$_POST['membership_category'];
	$user_account_type =$_POST['user_account_type'];
	$password =$_POST['password'];

	////////////////////////////////////////

	switch ($membership_category) {
		case 'Life':

		$qr = $db->prepare("SELECT membership_category FROM nmba_user WHERE id = '$uid' LIMIT 1");
		$qr->execute();
		$category = $qr->fetch(PDO::FETCH_ASSOC)['membership_category'];

		if ($category == 'Life') {

			$qrr = $db->prepare("UPDATE nmba_user SET password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
			$qrr->execute();

		}else{

			$qr = $db->prepare("SELECT membership_id FROM nmba_user WHERE membership_category = 'Life' ORDER BY membership_id DESC LIMIT 1");
			$qr->execute();

			if ($qr->rowCount() > 0) {
				$mem_id = $qr->fetch(PDO::FETCH_ASSOC)['membership_id'];
				$mem_id = $mem_id+1;

				$qrr = $db->prepare("UPDATE nmba_user SET membership_id = '$mem_id', password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', membership_category ='$membership_category', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
				$qrr->execute();
			}else{
				$msg = 'Invalid input';
			}
		}
		break;

		case 'Honorary':
		$qr = $db->prepare("SELECT membership_category FROM nmba_user WHERE id = '$uid' LIMIT 1");
		$qr->execute();
		$category = $qr->fetch(PDO::FETCH_ASSOC)['membership_category'];

		if ($category == 'Honorary') {

			$qrr = $db->prepare("UPDATE nmba_user SET password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
			$qrr->execute();

		}else{

			$qr = $db->prepare("SELECT membership_id FROM nmba_user WHERE membership_category = 'Honorary' ORDER BY membership_id DESC LIMIT 1");
			$qr->execute();

			if ($qr->rowCount() > 0) {
				$mem_id = $qr->fetch(PDO::FETCH_ASSOC)['membership_id'];
				$mem_id = $mem_id+1;

				$qrr = $db->prepare("UPDATE nmba_user SET membership_id = '$mem_id', password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', membership_category ='$membership_category', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
				$qrr->execute();
			}else{
				$msg = 'Invalid input';
			}
		}
		break;

		case 'Associate':
		$qr = $db->prepare("SELECT membership_category FROM nmba_user WHERE id = '$uid' LIMIT 1");
		$qr->execute();
		$category = $qr->fetch(PDO::FETCH_ASSOC)['membership_category'];

		if ($category == 'Associate') {

			$qrr = $db->prepare("UPDATE nmba_user SET password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
			$qrr->execute();

		}else{
			$qr = $db->prepare("SELECT membership_id FROM nmba_user WHERE membership_category = 'Associate' ORDER BY membership_id DESC LIMIT 1");
			$qr->execute();

			if ($qr->rowCount() > 0) {
				$mem_id = $qr->fetch(PDO::FETCH_ASSOC)['membership_id'];
				$mem_id = $mem_id + 1;
				$qrr = $db->prepare("UPDATE nmba_user SET membership_id = '$mem_id', password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', membership_category ='$membership_category', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
				$qrr->execute();
			}else{
				$msg = 'Invalid input';
			}
		}
		break;

		case 'non-member':
		$qr = $db->prepare("SELECT membership_category FROM nmba_user WHERE id = '$uid' LIMIT 1");
		$qr->execute();
		$category = $qr->fetch(PDO::FETCH_ASSOC)['membership_category'];

		if ($category == 'non-member') {

			$qrr = $db->prepare("UPDATE nmba_user SET password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
			$qrr->execute();

		}else{
			$qr = $db->prepare("SELECT membership_id FROM nmba_user WHERE membership_category = 'non-member' ORDER BY membership_id DESC LIMIT 1");
			$qr->execute();

			if ($qr->rowCount() > 0) {
				$mem_id = $qr->fetch(PDO::FETCH_ASSOC)['membership_id'];
				$mem_id = $mem_id + 1;

				$qrr = $db->prepare("UPDATE nmba_user SET membership_id = '$mem_id', password = '$password', introduce_by ='$intro_name',id_issued ='$id_issued', membership_status ='$membership_status', membership_category ='$membership_category', voting_right = '$voting_right', user_account_type ='$user_account_type', date_of_addmission ='$date_of_admission' WHERE id = '$uid'");
				$qrr->execute();
			}else{
				$msg = 'Invalid input';
			}
		}
		break;
	}

	/////////////

	$activity = 'Updated membership Details';
	$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
	$qr2->execute();
}

////////SUBMIT PERSONAL DETAILS FORM 2////////

if(isset($_POST['submit_personal'])){
	$uid = $_POST['uid'];
	$name =$_POST['member_name'];
	$email =$_POST['email'];
	$mobile =$_POST['mobile'];
	$gender =$_POST['gender'];
	$dob = strtotime($_POST['dob']);
	$blood_group =strtoupper($_POST['blood_group']);
	$profession =$_POST['profession'];
	$designation =$_POST['designation'];
	$organization =$_POST['organization'];

	$dob = strtotime($_POST['dob']);
	$age = (date('Y') - date('Y',$dob));
	if($age <= 60){
		$senior_citizen = 'no';
	}else{
		$senior_citizen = 'yes';
	}

/////////////////////////////////////////////////////////////////////////////////////

	$target_dir = $path['_views'].'asset/images/document/';
	$imageFileType = strtolower(pathinfo($_FILES["document_image"]["name"],PATHINFO_EXTENSION));
	$img = $image['name']. '.'.$imageFileType;
	$target_file = $target_dir. $img;
	$uploadOk = 1;


	if ((isset($_FILES['document_image']) && (file_exists($_FILES['document_image']['tmp_name']) || is_uploaded_file($_FILES['document_image']['tmp_name'])))) {

		$check = getimagesize($_FILES["document_image"]["tmp_name"]);

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
		if ($_FILES["document_image"]["size"] > 10000000) {
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

			if (move_uploaded_file($_FILES["document_image"]["tmp_name"], $target_file)) {

				$qr = $db->prepare("UPDATE `nmba_user` SET `name`= '$name',`mobile`='$mobile',`email`='$email',`gender`='$gender',`dob`='$dob',`blood_group`='$blood_group',`senior_citizen`='$senior_citizen' ,`profession`='$profession',`designation`='$designation',`document_image`='$img',`organization`='$organization' WHERE id = '$uid'");

				$qr->execute();

				if ($qr->rowCount() > 0) {

					$msg .= 'success';
				}else{

					$msg .= 'Invalid input';

				}

			}
		}

	}else{

		$qr = $db->prepare("UPDATE `nmba_user` SET `name`= '$name',`mobile`='$mobile',`email`='$email',`gender`='$gender',`dob`='$dob',`blood_group`='$blood_group',`senior_citizen`='$senior_citizen' ,`profession`='$profession',`designation`='$designation',`document_image`='$img',`organization`='$organization' WHERE id = '$uid'");
		$qr->execute();
		if ($qr->rowCount() > 0) {
			$msg .= 'success';
		}else{
			$msg .= 'Invalid input';
		}
	} 

//////////////////////////////////////////////////////////////
}
///////////////////////


////////SUBMIT FAMILY DETAILS FORM 3/////////

if(isset($_POST['submit_family_member'])){

	$uid = $_POST['uid'];

	$name = $_POST['validate_name'];
	$relation =$_POST['validate_relation'];
	$blood_group =strtoupper($_POST['validate_blood']);
	$gender =$_POST['gender'];
	$occupation =$_POST['occupation'];
	$dependency =$_POST['dependency'];
	$dob =strtotime($_POST['validate_dob']);
	$spouse_id = $_POST['spouce_id'];
	

	$db = conn();
	$qr = $db->prepare("UPDATE `nmba_user_family` SET name = '$name', spouse_member_id = '$spouse_id', relation = '$relation', gender = '$gender', dob = '$dob', blood_group = '$blood_group', dependency = '$dependency', occupation = '$occupation' WHERE id = '$uid' ");
	$qr->execute();

	if ($qr->rowCount() > 0) {	

		$qr = $db->prepare("SELECT id, name, mobile, email, membership_id, password, initial, introduce_by, gender, dob, blood_group, senior_citizen, id_issued, membership_status, profession, designation, area_of_interest, membership_category, voting_right, image, user_account_type, flat_house_no, area , sector, city_node, state, date_of_addmission, organization, yearly_paid_membership_year FROM nmba_user WHERE id ='$uid' ");
		$qr->execute();

		if ($qr->rowCount() > 0) {	

			$edit_member_details = $qr->fetchAll(PDO::FETCH_ASSOC);

		}else{

			$edit_member_details = 'Member doesnt exists';

		}


		$qr = $db->prepare("SELECT `id`, `name`, `spouse_member_id`, `relation`, `gender`, `dob`, `blood_group`, `dependency`, `occupation` FROM `nmba_user_family` WHERE spouse_member_id = '$uid' ORDER BY id DESC ");
		$qr->execute();

		if ($qr->rowCount() > 0) {    

			$res = $qr->fetchAll(PDO::FETCH_ASSOC);

		}else{

			$res = 'No Family member to display. Add New';
		}

		require_once($path['_views'] . 'member_detail.php');
		exit();

	}else{
		
		$msg = 'Invalid input';
		require_once($path['_views'] . 'profile_add_family_member.php');
		exit();
	}

}	

///////SUBMIT ADDRESS DETAILS FORM 3/////////

if(isset($_POST['submit_address'])){

		$uid = $_POST['uid'];
		$house_no =$_POST['house_no'];
		$area =$_POST['area'];
		$sector = $_POST['sector'];
		$city =$_POST['city'];
		$sub_sector = $_POST['sub_sector'];
		$pincode = $_POST['pincode'];
		$nri = $_POST['nri_address'];
		$society_building = $_POST['society_building'];

		$db = conn();
		$qr = $db->prepare("UPDATE `nmba_user` SET `flat_house_no`='$house_no',`society_building`= '$society_building',`area`='$area',`sector`='$sector',`sub_sector`='$sub_sector',`city_node`='$city', `pincode`='$pincode',`nri`='$nri' WHERE id = '$uid'");
		$qr->execute();

		if ($qr->rowCount() > 0) {	

			$msg = 'success';

			if($user_account_type == 'admin' || $user_account_type == 'super-admin'){ 
				$activity = 'Updated Address Details';
				$qr2 = $db->prepare("INSERT INTO nmba_activity(date_time, activity, admin_id) VALUES (UNIX_TIMESTAMP(),'$activity','$id') ");
				$qr2->execute();
			}
		}else{
			$msg = 'Invalid input';
		}
/////////////////////////////
}	

////////////////////////////////////////////////////////////////////////////

if (isset($_POST['search'])) {

	$qr = "";

	if(!empty($_POST['senior_citizen'])){
		$qr .= "(senior_citizen = '". $_POST['senior_citizen'] ."') AND ";
	}

	if(!empty($_POST['gender'])){
		$qr .= "(gender = '". $_POST['gender'] ."') AND ";
	}

	if(!empty($_POST['blood_group'])){
		$qr .= "(blood_group = '". strtoupper( $_POST['blood_group'] ) ."') AND ";
	}

	if(!empty($_POST['mem_status'])){
		$qr .= "(membership_status = '". $_POST['mem_status'] ."') AND ";
	}

	if(!empty($_POST['user_account_type'])){
		$qr .= "(user_account_type = '". $_POST['user_account_type'] ."') AND ";
	}

	if(!empty($_POST['city'])){
		$qr .= "(city_node = '". $_POST['city'] ."') AND ";
	}

	if(!empty($_POST['sector'])){
		$qr .= "(sector = '". $_POST['sector'] ."') AND ";
	}

	if(!empty($_POST['sub_sector'])){
		$qr .= "(sub_sector = '". $_POST['sub_sector'] ."')";
	}

	$qr = rtrim( trim( $qr ) ,"AND");

	if (!empty($qr)) {
		$qr = 'AND '.$qr;
	}

	$qr = $db->prepare("SELECT `id`, `name`, `mobile`, `email`, `membership_id`, `initial`, `gender`, `dob`, `blood_group`, `user_account_type`,`area_of_interest` FROM `nmba_user` WHERE membership_status != 'expired' $qr");
	$qr->execute();

	if ($qr->rowCount() > 0) {
		$res = $qr->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$res = 'Invalid input: User doesnt exists';
	}


}
////////////////show member details////////////////////

if (isset($_POST['show_all'])) {

	$qr = $db->prepare("SELECT `id`, `name`, `mobile`, `email`, `membership_id`, `initial`, `gender`, `dob`, `blood_group`, `user_account_type`,`area_of_interest` FROM `nmba_user` WHERE `membership_status` != 'expired' ORDER BY id DESC");
	$qr->execute();

	if ($qr->rowCount() > 0) {	

		$res = $qr->fetchAll(PDO::FETCH_ASSOC);
		
	}else{
		$res = 'Invalid input: User doesnt exists';
	}
	
}

/////////////////////////////////////////////////////////


require_once($path['_views'] . 'member_manage.php');
exit();