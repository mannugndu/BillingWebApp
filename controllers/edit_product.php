<?php
$serial = $_GET['edit_serial'];
$name = $_GET['item_name_edit'];
$cost = $_GET['item_cost_edit'];
$tax = $_GET['item_tax_edit'];

include 'DBConnection.php';

$query = "UPDATE items SET name='$name',cost='$cost',tax='$tax' where sr='$serial'";
if($con->query($query))
{
	header("location:../panel_admin.php");
}
else
{
 echo "there is some problem in processing your query please try again";
}
$con->close();
?>

