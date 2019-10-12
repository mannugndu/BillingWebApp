<?php
include 'DBConnection.php';
$order_id = $_GET['order_id'];
$query = "select * from orders where order_number = '$order_id'";
$rs = $con->query($query);
$row = $rs->fetch_assoc();
$items_count = $rs->num_rows+1;

$array = array($row['table_no'],$row['waiter'],$items_count);

echo json_encode($array);
$con->close();
?>


