<?php
 date_default_timezone_set('Asia/Kolkata');
 $date = date("Y-m-d");
include 'DBConnection.php';
$query_active_orders = "SELECT COUNT(DISTINCT order_number) AS active_orders FROM orders where date = '$date' AND status = 'active'";
$query_completed_orders = "SELECT COUNT(DISTINCT order_number) AS completed_orders FROM orders where date = '$date' AND status = 'completed'";

$query_free_tables = "SELECT COUNT(t_name) AS free_tables FROM tables where status = 'free'";
$query_occupied_tables = "SELECT COUNT(t_name) AS occupied_tables FROM tables where status = 'booked'";




$active_orders = $con->query($query_active_orders)->fetch_assoc();
$active_orders = $active_orders['active_orders'];

$completed_orders = $con->query($query_completed_orders)->fetch_assoc();
$completed_orders = $completed_orders['completed_orders'];

$free_tables = $con->query($query_free_tables)->fetch_assoc();
$free_tables = $free_tables['free_tables'];


$occupied_tables = $con->query($query_occupied_tables)->fetch_assoc();
$occupied_tables = $occupied_tables['occupied_tables'];





$array = array("active_orders_resp"=>$active_orders,"completed_orders_resp"=>$completed_orders,"free_tables_resp"=>$free_tables,"occupied_tables_resp"=>$occupied_tables);

echo json_encode($array);

$con->close();
?>