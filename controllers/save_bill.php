<?php
include 'DBConnection.php';
$disc=$_GET['discount'];
$pay_by=$_GET['pay_by'];
$order_id=$_GET['order_id'];

$query_get_table = "SELECT table_no from orders WHERE order_number='$order_id'";
$rs_table= $con->query($query_get_table);
$row_table = $rs_table->fetch_Assoc();
$table_number = $row_table['table_no'];

$query_table_update = "UPDATE tables set status = 'free' where t_name = '$table_number'";


$query = "UPDATE orders SET status='completed',paid_by='$pay_by',discount_given='$disc' WHERE order_number='$order_id'";
if($con->query($query)&&$con->query($query_table_update))
{
 echo "success";
}
else
{
	echo "failed".mysqli_error($con);
}
$con->close();

?>