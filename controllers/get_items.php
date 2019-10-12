<?php
include 'DBConnection.php';
$query = "SELECT * FROM items";
$result_set = $con->query($query);

while($row = $result_set->fetch_assoc())
	{
?>		<tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['cost']; ?></td>
        <td><?php echo $row['tax']; ?></td>
        <td><span style="cursor:pointer;font-size: 1.5em" id="<?php echo $row['sr']; ?>" onclick="edit_product(this)">&#9998;</span></td>
        <td><a  style="color:red;font-size: 1.5em" href="controllers/delete_item.php?serial=<?php echo $row['sr']; ?>">&#10008;</a></td>
    </tr>

 	<?php
 		}
 		$con->close();
	 ?>