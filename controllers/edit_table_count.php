<?php
include 'DBConnection.php';

$operation = $_GET['table_operation'];
$number = (int)$_GET['table_number'];
$query;
if($operation == "add")
{
	$query_max_table = "SELECT IFNULL(MAX(t_name),0) AS last_table from tables";
	$rs = $con->query($query_max_table)->fetch_assoc();
	$last_table = (int)$rs['last_table'];
	
	while($number!=0)
	{
		$last_table++;
		$query = "INSERT INTO `tables` (`sr`, `t_name`, `status`) VALUES (NULL, '$last_table', 'free')";
		$con->query($query);
		$number--;

	}
}
if($operation == "delete")
{
	$query_max_table = "SELECT IFNULL(MAX(t_name),0) AS last_table from tables";
	$rs = $con->query($query_max_table)->fetch_assoc();
	$last_table = (int)$rs['last_table'];

while($number!=0)
	{
		$query = "DELETE FROM tables where t_name = '$last_table'";
		$con->query($query);
		$last_table--;
		$number--;
	}

}

header("location:../panel_admin.php");
$con->close();
?>