<?php
include 'DBConnection.php';
$query = "select service_tax from business_info";
$rs = $con->query($query);
$row = $rs->fetch_assoc();

echo $row['service_tax'];

?>