<?php

include_once 'dbconnect.php';

if(empty($_POST['fname'])){
	echo "Please insert patient's full name!";
}
else
{ 

	    ////medrecid
    function generate_random_letters($length) 
        {
            $random = '';
            for ($i = 0; $i < $length; $i++) 
            {
                $random .= chr(rand(ord('a'), ord('z')));
            }
            return $random;
        } 

    $medrecid = mysqli_real_escape_string($sql_link,$_POST['medrecid']);     
    if($medrecid=='')	
    {
        do 
        {   
            $unique = generate_random_letters(10);
            $rsql = "SELECT * FROM identification WHERE medrecid=$unique";
            $result=mysqli_query($sql_link,$rsql);
        } 
        while ($result="");
        $medrecid=$unique;
    }   
     


                  ///////A.Identification
    $users_id = $_POST['userid'];
    $fname = mysqli_real_escape_string($sql_link,$_POST['fname']);
    $dob = mysqli_real_escape_string($sql_link,$_POST['dob']);
    $sex = (isset($_POST['sex'])?($_POST['sex']):'');
    $btype = mysqli_real_escape_string($sql_link,$_POST['btype']);
    $height = mysqli_real_escape_string($sql_link,$_POST['height']);
    $weight = mysqli_real_escape_string($sql_link,$_POST['weight']);
    $occupation = mysqli_real_escape_string($sql_link,$_POST['occupation']);
    $language = mysqli_real_escape_string($sql_link,$_POST['language']);
   
              //////addresses
    $country = mysqli_real_escape_string($sql_link,$_POST['country']);
    $city = mysqli_real_escape_string($sql_link,$_POST['city']);
    $postal_code = mysqli_real_escape_string($sql_link,$_POST['postal_code']);
    $address = mysqli_real_escape_string($sql_link,$_POST['address']);
    
            ////alternate addresses
    $acountry = mysqli_real_escape_string($sql_link,$_POST['acountry']);
    $acity = mysqli_real_escape_string($sql_link,$_POST['acity']);
    $apostal_code = mysqli_real_escape_string($sql_link,$_POST['apostal_code']);
    $aaddress = mysqli_real_escape_string($sql_link,$_POST['aaddress']);
    
    
         ////contacts 
    $hphone = mysqli_real_escape_string($sql_link,$_POST['hphone']);
    $wphone = mysqli_real_escape_string($sql_link,$_POST['wphone']);
    $cphone = mysqli_real_escape_string($sql_link,$_POST['cphone']);
    $email = mysqli_real_escape_string($sql_link,$_POST['email']);
    $fax = mysqli_real_escape_string($sql_link,$_POST['fax']);
    
            /////alternate contacts
    $ahphone = mysqli_real_escape_string($sql_link,$_POST['ahphone']);
    $awphone = mysqli_real_escape_string($sql_link,$_POST['awphone']);
    $acphone = mysqli_real_escape_string($sql_link,$_POST['acphone']);
    $aemail = mysqli_real_escape_string($sql_link,$_POST['aemail']);
    $afax = mysqli_real_escape_string($sql_link,$_POST['afax']);
   
    
    $sql = "SELECT * FROM identifications WHERE medrecid='$medrecid' LIMIT 1";
    if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    {
         $sql = "UPDATE identifications SET fname='$fname',dob='$dob',sex='$sex',btype='$btype',height='$height',weight='$weight',occupation='$occupation',language='$language' WHERE medrecid='$medrecid'";
         mysqli_query($sql_link, $sql);
    }
    else
    {
    	$sql = "INSERT INTO identifications(users_id, medrecid, fname, dob, sex, btype, height, weight, occupation, language) VALUES('$users_id', '$medrecid', '$fname', '$dob', '$sex','$btype','$height','$weight','$occupation','$language')";
    	mysqli_query($sql_link, $sql);
    }

    $sql = "SELECT * FROM addresses WHERE medrecid='$medrecid' AND alternate=0 LIMIT 1";
    if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    {
         $sql = "UPDATE addresses SET country='$country',city='$city',postalcode='$postal_code',address='$address' WHERE medrecid='$medrecid' AND alternate=0";
         mysqli_query($sql_link, $sql);
    }
    else
    {
    	$sql = "INSERT INTO addresses(users_id, medrecid, country, city, postalcode,address, alternate) VALUES('$users_id', '$medrecid', '$country', '$city', '$postal_code','$address',0)";
    	mysqli_query($sql_link, $sql);
    }

    $sql = "SELECT * FROM addresses WHERE medrecid='$medrecid' AND alternate= 1 LIMIT 1";
    if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    {
         $sql = "UPDATE addresses SET country='$acountry',city='$acity',postalcode='$apostal_code',address='$aaddress' WHERE medrecid='$medrecid' AND alternate= 1";
         mysqli_query($sql_link, $sql);
    }
    else
    {
    	$sql = "INSERT INTO addresses(users_id, medrecid, country, city, postalcode,address, alternate) VALUES('$users_id', '$medrecid', '$acountry', '$acity', '$apostal_code','$aaddress',1)";
    	mysqli_query($sql_link, $sql);
    }

    $sql = "SELECT * FROM icontacts WHERE medrecid='$medrecid' AND alternate= 0 LIMIT 1";
    if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    {
         $sql = "UPDATE icontacts SET hphone='$hphone',wphone='$wphone',cphone='$cphone',email='$email',fax='$fax' WHERE medrecid='$medrecid' AND alternate=0";
         mysqli_query($sql_link, $sql);
    }
    else
    {
    	$sql = "INSERT INTO icontacts(users_id, medrecid, hphone, wphone, cphone,email,fax, alternate) VALUES('$users_id', '$medrecid', '$hphone', '$wphone', '$cphone','$email','$fax',0)";
    	echo mysqli_error($sql_link);
    	mysqli_query($sql_link, $sql);
    }

    $sql = "SELECT * FROM icontacts WHERE medrecid='$medrecid' AND alternate= 1 LIMIT 1";
    if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    {
         $sql = "UPDATE icontacts SET hphone='$ahphone',wphone='$awphone',cphone='$acphone',email='$aemail',fax='$afax' WHERE medrecid='$medrecid' AND alternate=1";
         mysqli_query($sql_link, $sql);
    }
    else
    {
    	$sql = "INSERT INTO icontacts(users_id, medrecid, hphone, wphone, cphone,email,fax, alternate) VALUES('$users_id', '$medrecid', '$ahphone', '$awphone', '$acphone','$aemail','$afax',1)";
    	mysqli_query($sql_link, $sql);
    }

  
           ////B.Insurance Provider
    $iptype = mysqli_real_escape_string($sql_link,$_POST['iptype']);
    $ipcname = mysqli_real_escape_string($sql_link,$_POST['ipcname']);
    $ipaddress = mysqli_real_escape_string($sql_link,$_POST['ipaddress']);
    $ipcity = mysqli_real_escape_string($sql_link,$_POST['ipcity']);
    $ipzcode = mysqli_real_escape_string($sql_link,$_POST['ipzcode']);
    $ipcountry = mysqli_real_escape_string($sql_link,$_POST['ipcountry']);
    $ipphone = mysqli_real_escape_string($sql_link,$_POST['ipphone']);
    $ipemail = mysqli_real_escape_string($sql_link,$_POST['ipemail']);
    $ipfax = mysqli_real_escape_string($sql_link,$_POST['ipfax']);
    $ipwaddress = mysqli_real_escape_string($sql_link,$_POST['ipwaddress']);
    $ipmnumber = mysqli_real_escape_string($sql_link,$_POST['ipmnumber']);
    $ipssnumber = mysqli_real_escape_string($sql_link,$_POST['ipssnumber']);

    $sql = "SELECT * FROM insurances WHERE medrecid='$medrecid' LIMIT 1";
    if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    {
         $sql = "UPDATE insurances SET iptype='$iptype',ipcname='$ipcname',ipaddress='$ipaddress',ipcity='$ipcity',ipzcode='$ipzcode',ipcountry='$ipcountry',ipphone='$ipphone',ipemail='$ipemail',ipfax='$ipfax',ipwaddress='$ipwaddress',ipmnumber='$ipmnumber',ipssnumber='$ipssnumber' WHERE medrecid='$medrecid'";
         mysqli_query($sql_link, $sql);
    }
    else
    {
        $sql="INSERT INTO insurances(users_id,medrecid,iptype,ipcname,ipaddress,ipcity,ipzcode,ipcountry,ipphone,ipemail,ipfax,ipwaddress,ipmnumber,ipssnumber) VALUES('$users_id','$medrecid','$iptype','$ipcname','$ipaddress','$ipcity','$ipzcode','$ipcountry','$ipphone','$ipemail','$ipfax','$ipwaddress','$ipmnumber','$ipssnumber')";
    	mysqli_query($sql_link, $sql);
    }
    


    
      /////C.Medical History
    if(isset($_POST['mh_date'])){
    	$mh_date = $_POST['mh_date'];
    	foreach($mh_date as $key=>$value)
    	{
    		$sql ="SELECT * FROM mhistory WHERE medrecid='$medrecid' AND mh_options_id='$key' LIMIT 1";
    		if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    		{
    			$sql = "UPDATE mhistory SET donset='$value' WHERE medrecid='$medrecid' AND mh_options_id='$key'";
    			mysqli_query($sql_link, $sql);
    		}
    		else
    		{
	    		$sql = "INSERT INTO mhistory(users_id,medrecid,mh_options_id,donset) VALUES('$users_id','$medrecid','$key','$value')";
	    		mysqli_query($sql_link, $sql);
	    	}
	    }
    }
    
    /////D.Infectious Diseases
    if(isset($_POST['ind_age']))
    {
	    $ind_age = $_POST['ind_age'];
	    foreach($ind_age as $key=>$value)
	    {
	       	$ind_date = isset($_POST["ind_date_".$key]) ? $_POST["ind_date_".$key] : '';	
	        $ind_remarks = isset($_POST["ind_remarks_".$key]) ? $_POST["ind_remarks_".$key] : '';	
	        $sql ="SELECT * FROM indiseases WHERE medrecid='$medrecid' AND dis_options_id='$key' LIMIT 1";	
	        if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    		{
    			$sql = "UPDATE indiseases SET age='$value',indate='$ind_date',remarks='$ind_remarks' WHERE medrecid='$medrecid' AND dis_options_id='$key'";
    			mysqli_query($sql_link, $sql);
    		}
    		else
    		{
    			$sql = "INSERT INTO indiseases(users_id,medrecid,dis_options_id,age,indate,remarks ) VALUES('$users_id','$medrecid','$key','$value','$ind_date','$ind_remarks')";
	    		mysqli_query($sql_link, $sql);
    		}
	    }
	}
	////E.Immunizations
	if(isset($_POST['im_agea']))
    {
	    $im_agea = $_POST['im_agea'];
	    foreach($im_agea as $key=>$value)
	    {
	       	$im_datea = isset($_POST["im_datea_".$key]) ? $_POST["im_datea_".$key] : '';	
	       	$im_ageb  = isset($_POST["im_ageb_".$key]) ? $_POST["im_ageb_".$key] : '';	
	        $im_dateb = isset($_POST["im_dateb_".$key]) ? $_POST["im_dateb_".$key] : '';
	        $im_agec  = isset($_POST["im_agec_".$key]) ? $_POST["im_agec_".$key] : '';	
	        $im_datec = isset($_POST["im_datec_".$key]) ? $_POST["im_datec_".$key] : '';	
	        $sql ="SELECT * FROM immunizations WHERE medrecid='$medrecid' AND im_options_id='$key' LIMIT 1";	
	        if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    		{
 				$sql = "UPDATE immunizations SET agea='$value',datea='$im_datea',ageb='$im_ageb',dateb='$im_dateb',agec='$im_agec',datec='$im_datec' WHERE medrecid='$medrecid' AND im_options_id='$key'";
    			mysqli_query($sql_link, $sql);
    		}
    		else
    		{
    			$sql = "INSERT INTO immunizations(users_id,medrecid,im_options_id,agea,datea,ageb,dateb,agec,datec) VALUES('$users_id','$medrecid','$key','$value','$im_datea','$im_ageb','$im_dateb','$im_agec','$im_datec')";
	    	    mysqli_query($sql_link, $sql);
    		}
	    }
	}
    	  
		
	//////F.FAMILY MEMBER HISTORY
	if(isset($_POST['fm_mother']))
    {
	    $fm_mother = $_POST['fm_mother'];
	    foreach($fm_mother as $key=>$value)
	    {
	       	$fm_father = isset($_POST["fm_father_".$key]) ? $_POST["fm_father_".$key] : '';	
	       	$fm_sibling = isset($_POST["fm_sibling_".$key]) ? $_POST["fm_sibling_".$key] : '';	
	        $fm_grandparent = isset($_POST["fm_grandparent_".$key]) ? $_POST["fm_grandparent_".$key] : '';
	        $fm_children  = isset($_POST["fm_children_".$key]) ? $_POST["fm_children_".$key] : '';	
	        $sql ="SELECT * FROM fmhistory WHERE medrecid='$medrecid' AND fmh_options_id='$key' LIMIT 1";	
	        if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    		{
    			$sql = "UPDATE fmhistory SET mother='$value',father='$fm_father',siblings='$fm_sibling',grandparents='$fm_grandparent',children='$fm_children' WHERE medrecid='$medrecid' AND fmh_options_id='$key'";
    			mysqli_query($sql_link, $sql);
    		}
    		else
    		{
    			$sql = "INSERT INTO fmhistory(users_id,medrecid,fmh_options_id,mother,father,siblings,grandparents,children) VALUES('$users_id','$medrecid','$key','$value','$fm_father','$fm_sibling','$fm_grandparent','$fm_children')";
	    	    mysqli_query($sql_link, $sql);
    		}
	    }
	}

		//////G.Current Status
	$diagnosis = mysqli_real_escape_string($sql_link,$_POST['diagnosis']);
	$m_treatment = mysqli_real_escape_string($sql_link,$_POST['m_treatment']);
	$start = mysqli_real_escape_string($sql_link,$_POST['start']);
    $end = mysqli_real_escape_string($sql_link,$_POST['end']);

    $sql = "SELECT * FROM currentstatus WHERE medrecid='$medrecid' LIMIT 1";
    if(mysqli_num_rows(mysqli_query($sql_link, $sql))>0)
    {
         $sql = "UPDATE currentstatus SET diagnosis='$diagnosis',mtreatment='$m_treatment',start='$start',end='$end' WHERE medrecid='$medrecid'";
         mysqli_query($sql_link, $sql);
    }
    else
    {
        $sql="INSERT INTO currentstatus(users_id,medrecid,diagnosis,mtreatment,start,end) VALUES('$users_id','$medrecid','$diagnosis','$m_treatment','$start','$end')";
    	mysqli_query($sql_link, $sql);
    }
}
?> 	