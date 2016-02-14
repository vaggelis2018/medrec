<?php
	session_start();

	include_once 'dbconnect.php';


	$user_id = $_SESSION['user'];		
	$medrec_id = $row['medrec_id'];
	$sql_identification="DELETE FROM identifications WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_identification);
	$sql_addresses="DELETE FROM addresses WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_addresses);
	$sql_icontacts="DELETE FROM icontacts WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_icontacts);
	$sql_insurance="DELETE FROM insurances WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_insurance);
	$sql_mhistory="DELETE FROM mhistory WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_mhistory);
	$sql_indiseases="DELETE FROM indiseases WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_indiseases);
	$sql_immunizations="DELETE FROM immunizations WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_immunizations);
	$sql_fmhistory="DELETE FROM fmhistory WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_fmhistory);
	$sql_current_status="DELETE FROM current_status WHERE users_id='$user_id'";
	mysqli_query($sql_link,$sql_current_status);
	$requests = mysqli_query($sql_link,("DELETE FROM requests WHERE doctor = '$user_id'"));
	$friends = mysqli_query($sql_link,("DELETE FROM friends WHERE doctor_id = '$user_id'"));
	$messages = mysqli_query($sql_link,("DELETE FROM messages WHERE (sender = '$user_id')||(reciever = '$user_id')"));
	$markers =  mysqli_query($sql_link,("DELETE FROM markers WHERE users_id = '$user_id'"));
	$office =  mysqli_query($sql_link,("DELETE FROM office WHERE users_id = '$user_id'"));
	$image = mysqli_query($sql_link,("SELECT * FROM profile WHERE users_id = '$user_id'"));
	$image = mysqli_fetch_assoc($image);
	if($image['image']!="uploads/avatar.png"){
		unlink("../".$image['image']);
	}
	$profile =  mysqli_query($sql_link,("DELETE FROM profile WHERE users_id = '$user_id'"));
	$users =  mysqli_query($sql_link,("DELETE FROM users WHERE users_id = '$user_id'"));


	session_destroy();
	unset($_SESSION['user']);

    unset($_COOKIE['type']);
    setcookie('type', '', time() - 3600, '/'); // empty value and old timestamp

    unset($_COOKIE['visit']);
    setcookie('visit', '', time() - 3600, '/');

?>