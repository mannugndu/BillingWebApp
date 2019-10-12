<?php
include 'DBConnection.php';
date_default_timezone_set('Asia/Kolkata'); 
$date = date("Y-m-d");
$time = date("h:i A");
$i=(int)$_POST["total"]-1;
$order_table = $_POST['order_table'];
$order_waiter = $_POST['order_waiter'];
$order_id = $_POST['order_id'];



$query_get_table = "SELECT table_no,order_type,time from orders where order_number = '$order_id'";
$rs_query_get_table = $con->query($query_get_table)->fetch_assoc();
$table_to_free = $rs_query_get_table['table_no'];
$order_type = $rs_query_get_table['order_type'];
$time = $rs_query_get_table['time'];
$query_free_table = "UPDATE tables set status = 'free' where t_name = '$table_to_free'";
if($con->query($query_free_table)){}else{ echo $con->error; }

$query_delete_order = "DELETE FROM orders where order_number = '$order_id'";
if($con->query($query_delete_order)){}else{ echo $con->error; }



$query_table="UPDATE tables set status = 'booked' where t_name = '$order_table'";





$query_s_tax = "SELECT service_tax from business_info";
$rs_st = $con->query($query_s_tax);
$r_tx = $rs_st->fetch_assoc();
$service_tax = $r_tx['service_tax'];


$order_ammount=0;
for($j=$i;$j>=0;$j--)
{
$item = $_POST['item_name'.$j];
$item_qty = $_POST['qty'.$j];
$query_item = "select * from items where name = '$item'";
$result_set_item = $con->query($query_item);
$row_item = $result_set_item->fetch_assoc(); 
$item_name = $row_item['name'];
$item_cost=$row_item['cost'];
$item_tax=$row_item['tax'];
$order_ammount += ($item_cost*$item_qty*$item_tax/100)+$item_cost*$item_qty;
}



for($j=$i;$j>=0;$j--)
{
$item = $_POST['item_name'.$j];
$item_qty = $_POST['qty'.$j];
$query_item = "select * from items where name = '$item'";
$result_set_item = $con->query($query_item);
$row_item = $result_set_item->fetch_assoc(); 

$item_name = $row_item['name'];
$item_cost=$row_item['cost'];
$item_tax=$row_item['tax'];


$query_order = "INSERT INTO `orders` (`sr`, `order_number`, `item`, `cost`, `ammount`, `qty`, `tax`, `date`,`time`,`status`,`paid_by`,`service_tax`,`order_type`,`table_no`,`waiter`) VALUES (NULL, '$order_id','$item_name' , '$item_cost', '$order_ammount', '$item_qty', '$item_tax', '$date','$time','active','','$service_tax','$order_type','$order_table','$order_waiter')";

if($con->query($query_order)&&$con->query($query_table))
{
	echo "item added";
}
else
{
	echo $con->error;
}

}





?>