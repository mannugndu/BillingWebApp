<?php


include 'DBConnection.php';
$order_id = $_GET['order_id'];

$query_get_table = "SELECT table_no from orders where order_number = '$order_id'";
$rs_table = $con->query($query_get_table);
$row = $rs_table->fetch_assoc();
$table_number = $row['table_no'];

$query_free_table = "UPDATE tables set status = 'free' where t_name = '$table_number'";

$query = "delete from orders where order_number = '$order_id'";
if($con->query($query)&&$con->query($query_free_table))
{
	
	echo "1";
}
else
{
echo $con->error;	
}


$con->close();

?>