<?php


	include 'DBConnection.php';
	$item = $_POST['item_name'];	
	$query = "select * from items where name = '$item'";
	$result_set = $con->query($query);
	$row = $result_set->fetch_assoc();
$con->close();

$array = array($row['cost'],$row['tax']);
echo json_encode($array);

?>