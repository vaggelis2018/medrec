<?php
    include_once "dbconnect.php";

	$uname = mysqli_real_escape_string($sql_link,$_POST['uname']);
    $email = $_POST['email2'];
    $upass = mysqli_real_escape_string($sql_link,$_POST['upass']);
    $upass2 = mysqli_real_escape_string($sql_link,$_POST['upass2']);
    $type = (isset($_POST['type'])?($_POST['type']):''); 
    $sql="SELECT * FROM users";
    $res=mysqli_query($sql_link,$sql);
    $userRow=mysqli_fetch_array($res);
    if(empty($uname)){
    	echo "Please give a username!";
    }
    elseif(empty($email)){
    	echo "Please give an email!";
    }
    elseif(strlen($uname)<="5"){
        echo "Username has to be more than 5 characters";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		echo  "Invalid email format";	
    }
    elseif(empty($upass)){
    	echo "Please give a password!";
    }
    elseif(strlen($upass)<="5"){
        echo "Password has to be more than 5 characters";
    }
    elseif(empty($upass2)){
    	echo "Please type again your password!";
    }
    elseif($uname == $userRow['username']) {
    	echo "Username already taken!";
    }    
    elseif($email == $userRow['email']){
    	echo "E-mail already exists!";
    }
    elseif(empty($type)){
    	echo "Please choose your account type!";
    }
    elseif(($upass) == ($upass2)){    	

        if($type == "doctor"){
        		$upass = md5($upass);
            	$type = "1";  
            	$sql="INSERT INTO users(username,email,password,type,status) VALUES('$uname','$email','$upass','$type','online')"; 
                mysqli_query($sql_link,$sql);
                $sql="SELECT id FROM users WHERE username='$uname' and password='$upass' limit 1";
                $result = mysqli_query($sql_link,$sql);
                $resultarr = mysqli_fetch_assoc($result);
                $user_id = $resultarr["id"];
                session_start();
                $_SESSION['user'] = $user_id;
                $cookie_name = "type";
                $cookie_value = $type;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                echo "doctor";
        }
        elseif($type == "patient")
        {
        		$upass = md5($upass);
            	$type = "0";
            	$sql="INSERT INTO users(username,email,password,type,status) VALUES('$uname','$email','$upass','$type','online')"; 
                mysqli_query($sql_link,$sql);
                $sql="SELECT id FROM users WHERE username='$uname' AND password='$upass' LIMIT 1";
                $result = mysqli_query($sql_link,$sql);
                $resultarr = mysqli_fetch_assoc($result);
                $user_id = $resultarr["id"];
                session_start();
                $_SESSION['user'] = $user_id;
                $cookie_name = "type";
                $cookie_value = $type;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
                echo "patient";
        }   
    }       
    else
	{    
	    echo "Passwords not match";
    }           
?>