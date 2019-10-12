<?php
//  index starts from 0
include 'DBConnection.php';
date_default_timezone_set('Asia/Kolkata'); 
$date = date("Y-m-d");
$time = date("h:i A");
$i=(int)$_POST["total"]-1;
$order_type = $_POST['order_type'];
$order_table = $_POST['order_table'];
$order_waiter = $_POST['order_waiter'];

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


$o_no_query = "select MAX(order_number) as order_number from orders";
$result_set = $con->query($o_no_query);
$o_no=$result_set->fetch_assoc();
$o_no = $o_no["order_number"]+1;


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


$query_order = "INSERT INTO `orders` (`sr`, `order_number`, `item`, `cost`, `ammount`, `qty`, `tax`, `date`,`time`,`status`,`paid_by`,`service_tax`,`order_type`,`table_no`,`waiter`) VALUES (NULL, '$o_no','$item_name' , '$item_cost', '$order_ammount', '$item_qty', '$item_tax', '$date','$time','active','','$service_tax','$order_type','$order_table','$order_waiter')";

if($con->query($query_order)&&$con->query($query_table))
{
	echo "item added";
}
else
{
	echo $con->error;
}



}



//echo $_POST["item_name".(string)$i].$_POST["qty".(string)$i];
?>

