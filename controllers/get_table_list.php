<?php
include 'DBConnection.php';
$query = "SELECT t_name from tables where status = 'free'";
$result_set = $con->query($query);
while($row= $result_set->fetch_assoc())
{
?>

<option value="<?php echo $row['t_name']; ?>">
	<?php echo $row['t_name']; ?>
</option>

<?php
}
$con->close();
?>
<option value="N/A" style="display:none">N/A</option>