<?php
include 'DBConnection.php';
$query = "SELECT COUNT(sr) AS count_waiters from waiters";
$rs =  $con->query($query)->fetch_assoc();
echo $rs['count_waiters'];

$con->close();
?>