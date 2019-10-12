<?php
include 'DBConnection.php';
$query = "SELECT * FROM waiters";
$result_set = $con->query($query);

while($row = $result_set->fetch_assoc())
	{
?>		<tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['mobile']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><span style="cursor:pointer;font-size: 1.5em" id="<?php echo $row['sr']; ?>" onclick="edit_waiter(this)">&#9998;</span></td>
        <td><a  style="color:red;font-size: 1.5em" href="controllers/delete_waiter.php?serial=<?php echo $row['sr']; ?>">&#10008;</a></td>
    </tr>

 	<?php
 		}
 		$con->close();
	 ?>