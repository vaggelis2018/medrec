
<?php
	include_once 'dbconnect.php';
	if(empty($_POST['fname'])){
		echo "Please give your first name";	
	}elseif(empty($_POST['last_name'])) {
		echo "Please give your last name";	
	}		
	else{
		$user_id = $_POST['user_id'];
		$fname = mysqli_real_escape_string($sql_link,$_POST['fname']);
		$last_name = mysqli_real_escape_string($sql_link,$_POST['last_name']);
		if(!empty($_POST['haddress'])){			
			$haddress = mysqli_real_escape_string($sql_link,$_POST['haddress']);}
		else{
			$haddress = "-";}
		if(!empty($_POST['zcode'])){	
			$zcode = mysqli_real_escape_string($sql_link,$_POST['zcode']);}
		else{
			$zcode = "-";}
		if(!empty($_POST['hphone'])){	
			$hphone = mysqli_real_escape_string($sql_link,$_POST['hphone']);}
		else{
			$hphone = "-";}
		if(!empty($_POST['fax'])){		
			$fax = mysqli_real_escape_string($sql_link,$_POST['fax']);}
		else{
			$fax = "-";}
		if(!empty($_POST['cphone'])){
			$cphone = mysqli_real_escape_string($sql_link,$_POST['cphone']);}
		else{
			$cphone = "-";}
		if(!empty($_POST['pwebsite'])){	
			$pwebsite = mysqli_real_escape_string($sql_link,$_POST['pwebsite']);}
		else{
			$pwebsite = "-";}
		if(!empty($_POST['aochat'])){	
			$aochat= mysqli_real_escape_string($sql_link,$_POST['aochat']);}
		else{
			$aochat = "-";}
		if(!empty($_POST['ospecialities'])){	
			$ospecialities = mysqli_real_escape_string($sql_link,$_POST['ospecialities']);}
		else{
			$ospecialities = "-";}
		if(!empty($_POST['services'])){		
			$services = mysqli_real_escape_string($sql_link,$_POST['services']);}
		else{
			$services = "-";}
		if(!empty($_POST['edu'])){	
			$edu = mysqli_real_escape_string($sql_link,$_POST['edu']);}
		else{
			$edu = "-";}
		if(!empty($_POST['pe'])){	
			$pe = mysqli_real_escape_string($sql_link,$_POST['pe']);}
		else{
			$pe = "-";}
		if(!empty($_POST['specialities'])){
		$specialities = implode(",",$_POST['specialities']);}
		else{
			$specialities = "-";
		}
		
	    $sql="SELECT * FROM profile WHERE users_id='$user_id' LIMIT 1";
	    $result = mysqli_query($sql_link,$sql);

	    $update_query=mysqli_fetch_array($result);
	    if((!isset($_POST['country']))||(empty($_POST['country']))){
	    	$country = $update_query['country'];
	    }
	    else{
	    	$country = mysqli_real_escape_string($sql_link,$_POST['country']);
	    }	    
		if((!isset($_POST['state']))||(empty($_POST['state']))){
	    	$state = $update_query['state'];
	    }
	    else{
	    	$state = mysqli_real_escape_string($sql_link,$_POST['state']);
	    }	  


	    $fileName = $_FILES["uploaded_file"]["name"]; // The file name
	    $fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"]; // File in the PHP tmp folder
	    $fileType = $_FILES["uploaded_file"]["type"]; // The type of file it is
	    $fileSize = $_FILES["uploaded_file"]["size"]; // File size in bytes
	    $fileErrorMsg = $_FILES["uploaded_file"]["error"];
	   


	    if(($fileSize==0)&&(empty($update_query['image']))){
	    	$filepath = "uploads/avatar.png";
	    }
	    elseif (($fileSize==0)&&(!empty($update_query['image']))) {
	    	$filepath = $update_query['image'];
	    }
	    else{
	        if($fileSize > 5242880) 
	    	{ 
	            echo "your file has to be lower than 5mb";
	        	unlink($fileTmpLoc);
	        	exit();
	    	}
	    	elseif (!preg_match("/.(jpg|png)$/i", $fileName) ) 
	    	{   
	            echo "your file has to be jpg or png";
	        	unlink($fileTmpLoc); 
	        	exit();
	    	}
	    	else{
	    		$kaboom = explode(".", $fileName); // Split file name into an array using the dot
	    		$newfilename = $user_id . '.' . end($kaboom);
	    		$filepath = "uploads/" . $newfilename;
	   			$fileExt = end($kaboom);
	    		$moveResult = move_uploaded_file($fileTmpLoc, "../uploads/" . $newfilename);
	    	}	    	
	    }

	    if(mysqli_num_rows($result)>0)
	    {
	    	$sql="UPDATE profile SET fname='$fname',last_name='$last_name',image='$filepath',country='$country',state='$state',haddress='$haddress',zcode='$zcode',hphone='$hphone',fax='$fax',cphone='$cphone',pwebsite='$pwebsite',aochat='$aochat',specialities='$specialities',ospecialities='$ospecialities',services='$services',edu='$edu',pe='$pe' WHERE users_id='$user_id'";
	    }
	    else
	    {
	    	$sql="INSERT INTO profile(users_id,fname,last_name,image,country,state,haddress,zcode,hphone,fax,cphone,pwebsite,aochat,specialities,ospecialities,services,edu,pe) VALUES('$user_id','$fname','$last_name','$filepath','$country','$state','$haddress','$zcode','$hphone','$fax','$cphone','$pwebsite','$aochat','$specialities','$ospecialities','$services','$edu','$pe')";
	    }
	    $result=mysqli_query($sql_link,$sql);
	}	

	    
    
?>	