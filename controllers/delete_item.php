<?php
$item_sr = $_GET['serial'];
include 'DBConnection.php';
$query = "DELETE FROM items where sr = '$item_sr'";
if($con->query($query))
{
	header("location:../panel_admin.php");
}
else
{
	echo "there is a problem in processing your query pease go back and try again";
}
$con->close();

?>