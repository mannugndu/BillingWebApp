<?php
include 'DBConnection.php';
$order_id = $_GET['order_id'];
$query = "select * from orders where order_number = '$order_id'";
$rs = $con->query($query);
$i=1;
while($row = $rs->fetch_assoc())
{

?>
<tr id="edit_item_row">
      <td>
      <div class="form-group">
      <input type="text" list="items" id="ei<?php echo $i; ?>" name="edit_item" value="<?php echo $row['item']; ?>" class="form-control" style="width:90%" onblur="edit_item_adder(this)" onkeyup="check_item_val(this)" required>

      </div>
      </td>

      <td>
      <div class="form-group">
      <input type="text" list="qtys" id="eq<?php echo $i; ?>" name="edit_qty" value="<?php echo $row['qty']; ?>" class="form-control" style="width:100px" onblur="edit_item_adder(this)" onkeyup="check_qty_val(this)" required>

      </div>
      </td>

      <td id="eunit<?php echo $i; ?>" name="edit_unit"><?php echo $row['cost']; ?></td>

      <td id="etax<?php echo $i; ?>" name="edit_tax"><?php echo $row['tax']; ?> %</td>

      <td id="eammount<?php echo $i; ?>" name="edit_ammount"><?php 
      $cost = $row['cost'];
      $qty = $row['qty'];
      $tax = $row['tax'];

      $amount = (($cost*$tax/100)+$cost)*$qty;
      echo round($amount,2);
       ?></td>


    </tr>

    <?php
    $i++;
}
$con->close();

    ?>