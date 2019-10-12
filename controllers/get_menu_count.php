<?php
include 'DBConnection.php';
$query = "SELECT COUNT(sr) AS count_menu from items";
$rs =  $con->query($query)->fetch_assoc();
echo $rs['count_menu'];

$con->close();
?>