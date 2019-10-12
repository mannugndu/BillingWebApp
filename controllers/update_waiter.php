<?php
$serial = $_GET['edit_serial_waiter'];
$name = $_GET['edit_waiter_name'];
$mobile = $_GET['edit_waiter_number'];
$address = $_GET['edit_waiter_address'];

include 'DBConnection.php';

$query = "UPDATE waiters SET name='$name',mobile='$mobile',address='$address' where sr='$serial'";
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
