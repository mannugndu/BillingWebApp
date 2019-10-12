<?php
$service_tax = $_GET['service_tax'];
include 'DBConnection.php';

$query = "UPDATE business_info SET service_tax = '$service_tax'";
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
