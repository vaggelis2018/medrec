<?php

session_start();

include_once "dbconnect.php";

$user_id=$_SESSION['user'];


$status_sql=mysqli_query($sql_link,("UPDATE users SET status='offline' WHERE user_id='$user_id'"));


	session_destroy();
	unset($_SESSION['user']);

    unset($_COOKIE['type']);
    setcookie('type', '', time() - 3600, '/'); // empty value and old timestamp

    unset($_COOKIE['visit']);
    setcookie('visit', '', time() - 3600, '/');



?>