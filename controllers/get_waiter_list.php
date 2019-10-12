<?php
include 'DBConnection.php';
$query = "SELECT name from waiters where status = 'free'";
$result_set = $con->query($query);
while($row= $result_set->fetch_assoc())
{
?>

<option value="<?php echo $row['name']; ?>">
	<?php echo $row['name']; ?>
</option>

<?php
}
$con->close();
?>
<option value="N/A" style="display:none">N/A</option>