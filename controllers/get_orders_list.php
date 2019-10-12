  <?php

date_default_timezone_set('Asia/Kolkata');
include 'DBConnection.php';
$date = date("Y-m-d");
$query_orders = "select DISTINCT order_number from orders where date ='$date' AND status = 'active' ORDER BY order_number DESC";
$result_set_orders = $con->query($query_orders);
$list;

while($row=$result_set_orders->fetch_assoc())
{
	echo "<option>".$row['order_number']."</option>";
}
?>