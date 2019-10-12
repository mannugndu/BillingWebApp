<?php
session_start();
include 'controllers/DBConnection.php';
$user = $_POST['username_c'];
$pass = $_POST['password_c'];

$query = "SELECT * FROM business_info where user_name = '$user' AND password='$pass'";
$result_set = $con->query($query);
$con->close();
if($result_set->num_rows==1)
{
	$_SESSION['login_flag']=1;
	$_SESSION['login_flag_a']=0;
	header("location:main.php");
}
else
{
	$_SESSION['login_flag']=0;
	header("location:index.php");
}


?>