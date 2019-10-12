<?php
include 'DBConnection.php';
$serial = $_GET['serial'];
$query = "SELECT * FROM waiters where sr = '$serial'";


$result_set = $con->query($query);
$row = $result_set->fetch_assoc();
$con->close();
$array = array($row['name'],$row['mobile'],$row['address']);



echo json_encode($array);
?>



