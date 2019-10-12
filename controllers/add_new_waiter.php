<?php
include 'DBConnection.php';
$name = $_GET['waiter_name'];
$mobile = $_GET['waiter_number'];
$address = $_GET['waiter_address'];

$query = "INSERT INTO `waiters` (`sr`, `name`, `mobile`, `address`,`status`) VALUES (NULL, '$name', '$mobile', '$address','free')";

if($con->query($query))
{
	header("location:../panel_admin.php");
}
else
{
	echo "there is a problem in processing your query. please go back and try again";
}

?>