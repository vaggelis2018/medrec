<?php
	include_once 'dbconnect.php';
    if(empty($_POST['medrecid'])){
    	echo "Medical records are not saved";
    }
    else{
    	$medrecid = mysqli_real_escape_string($sql_link,$_POST['medrecid']); 
		$sql_identification="DELETE FROM identifications WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_identification);
		$sql_addresses="DELETE FROM addresses WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_addresses);
		$sql_icontacts="DELETE FROM icontacts WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_icontacts);
		$sql_insurance="DELETE FROM insurances WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_insurance);
		$sql_mhistory="DELETE FROM mhistory WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_mhistory);
		$sql_indiseases="DELETE FROM indiseases WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_indiseases);
		$sql_immunizations="DELETE FROM immunizations WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_immunizations);
		$sql_fmhistory="DELETE FROM fmhistory WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_fmhistory);
		$sql_current_status="DELETE FROM currentstatus WHERE medrecid='$medrecid'";
		mysqli_query($sql_link,$sql_current_status);
    }
   	
?>