<?php
include 'DBConnection.php';
$query = "SELECT COUNT(sr) AS count_tables from tables";
$rs =  $con->query($query)->fetch_assoc();
echo $rs['count_tables'];

$con->close();
?>