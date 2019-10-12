<?php
session_start();
include 'controllers/DBConnection.php';
$user = $_POST['username_a'];
$pass = $_POST['password_a'];

$query = "SELECT * FROM business_info where user_name_a = '$user' AND password_a='$pass'";
$result_set = $con->query($query);
echo $user.$pass;

if($result_set->num_rows==1)
{
	$_SESSION['login_flag']=0;
	$_SESSION['login_flag_a']=1;
	header("location:panel_admin.php");
}
else
{
	$_SESSION['login_flag_a']=0;
	header("location:index.php");
}


?>