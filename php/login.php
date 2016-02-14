<?php
	include_once "dbconnect.php";


	$email = $_POST['email1'];
	$upass = mysqli_real_escape_string($sql_link,$_POST['pass']);
	$sql=mysqli_query($sql_link,("SELECT * FROM users WHERE email='$email'"));
	$row=mysqli_fetch_array($sql);
	
	
	if($row['password']==md5($upass))
	{
		session_start();
		$_SESSION['user'] = $row['id'];
		$user_id = $row['id'];
		if($row['type']=="1")
		{
			$status_sql=mysqli_query($sql_link,("UPDATE users SET status='online' WHERE id='$user_id'"));
			$cookie_name = "type";
            $cookie_value = $row['type'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
            echo "doctor";
            exit();
        }
        else
        {
        	$status_sql=mysqli_query($sql_link,("UPDATE users SET status='online' WHERE id='$user_id'"));
        	$cookie_name = "type";
            $cookie_value = $row['type'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
        	echo "patient";
        	exit();
        }
	}
	else
	{
		echo "wrong details!";
	}
?>