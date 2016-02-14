<?php
	include_once 'dbconnect.php';
    $user_id = $_POST['user_id'];
    if(isset($_POST['oname'])){
		$oname = mysqli_real_escape_string($sql_link,$_POST['oname']);}
	else{
		$oname = "-";}
	if(isset($_POST['pfservice'])){
		$pfservice = mysqli_real_escape_string($sql_link,$_POST['pfservice']);}
	else{
		$pfservice = "-";}
	if(isset($_POST['trnumber'])){	
		$trnumber = mysqli_real_escape_string($sql_link,$_POST['trnumber']);}
	else{
		$trnumber = "-";}
	if(isset($_POST['ozcode'])){
		$ozcode = mysqli_real_escape_string($sql_link,$_POST['ozcode']);}
	else{
		$ozcode = "-";}
	if(isset($_POST['director'])){
		$director = mysqli_real_escape_string($sql_link,$_POST['director']);}
	else{
		$director = "-";}
	if(isset($_POST['oaddress'])){
		$oaddress = mysqli_real_escape_string($sql_link,$_POST['oaddress']);}
	else{
		$oaddress = "-";}
	if(isset($_POST['ofax'])){
		$ofax = mysqli_real_escape_string($sql_link,$_POST['ofax']);}
	else{
		$ofax = "-";}
	if(isset($_POST['ophone'])){
		$ophone = mysqli_real_escape_string($sql_link,$_POST['ophone']);}
	else{
		$ophone = "-";}
	if(isset($_POST['oemail'])){
		$oemail = mysqli_real_escape_string($sql_link,$_POST['oemail']);}
	else{
		$oemail = "-";}
	$fmonday = mysqli_real_escape_string($sql_link,$_POST['fmonday']);
	$tmonday = mysqli_real_escape_string($sql_link,$_POST['tmonday']);
	$amonday = $fmonday. ' ' .$tmonday;
	$ftuesday = mysqli_real_escape_string($sql_link,$_POST['ftuesday']);
	$ttuesday = mysqli_real_escape_string($sql_link,$_POST['ttuesday']);
	$atuesday = $ftuesday. ' ' .$ttuesday;
	$fwednesday = mysqli_real_escape_string($sql_link,$_POST['fwednesday']);
	$twednesday = mysqli_real_escape_string($sql_link,$_POST['twednesday']);
	$awednesday = $fwednesday. ' ' .$twednesday;
	$fthursday = mysqli_real_escape_string($sql_link,$_POST['fthursday']);
	$tthursday = mysqli_real_escape_string($sql_link,$_POST['tthursday']);
	$athursday = $fthursday. ' ' .$tthursday;
	$ffriday = mysqli_real_escape_string($sql_link,$_POST['ffriday']);
	$tfriday = mysqli_real_escape_string($sql_link,$_POST['tfriday']);
	$afriday = $ffriday. ' ' .$tfriday;
	$fsaturday = mysqli_real_escape_string($sql_link,$_POST['fsaturday']);
	$tsaturday = mysqli_real_escape_string($sql_link,$_POST['tsaturday']);
	$asaturday = $fsaturday. ' ' .$tsaturday;
	$fsunday = mysqli_real_escape_string($sql_link,$_POST['fsunday']);
	$tsunday = mysqli_real_escape_string($sql_link,$_POST['tsunday']);
	$asunday = $fsunday. ' ' .$tsunday;


	$sql="SELECT * FROM office WHERE users_id='$user_id' LIMIT 1";
    $result=mysqli_query($sql_link,$sql);

    $update_query=mysqli_fetch_array($result);
    if((!isset($_POST['country']))||($_POST['country']=='')){
	   	$country = $update_query['country'];
	}
	else{
	 	$country = mysqli_real_escape_string($sql_link,$_POST['country']);
	}	    
	if((!isset($_POST['state']))||($_POST['state']=='')){
	    $state = $update_query['state'];
	}
	else{
	    $state = mysqli_real_escape_string($sql_link,$_POST['state']);
	}	  



    if(mysqli_num_rows($result)>0)
    {
    	$sql="UPDATE office SET oname='$oname',pfservice='$pfservice',country='$country',state='$state',trnumber='$trnumber',ozcode='$ozcode',director='$director',oaddress='$oaddress',ofax='$ofax',ophone='$ophone',oemail='$oemail',amonday='$amonday',atuesday='$atuesday',awednesday='$awednesday',athursday='$athursday',afriday='$afriday',asaturday='$asaturday',asunday='$asunday' WHERE users_id='$user_id'";
    }
    else
    {
   		$sql="INSERT INTO office(users_id,oname,pfservice,country,state,trnumber,ozcode,director,oaddress,ofax,ophone,oemail,amonday,atuesday,awednesday,athursday,afriday,asaturday,asunday)VALUES('$user_id','$oname','$pfservice','$country','$state','$trnumber','$ozcode','$director','$oaddress','$ofax','$ophone','$oemail','$amonday','$atuesday','$awednesday','$athursday','$afriday','$asaturday','$asunday')";
	}
	$result=mysqli_query($sql_link,$sql);

?>	