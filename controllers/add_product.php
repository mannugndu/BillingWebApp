<?php
include 'DBConnection.php';
$item_name = $_GET['item_name'];
$item_cost = $_GET['item_cost'];
$item_tax = $_GET['item_tax'];

$query = "INSERT INTO `items` (`sr`, `name`, `cost`, `tax`) VALUES (NULL, '$item_name', '$item_cost', '$item_tax')";

if($con->query($query))
{
	header("location:../panel_admin.php");
}
else
{
	echo "there is a problem in processing your query. please go back and try again";
}

?>