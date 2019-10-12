 <?php
 date_default_timezone_set('Asia/Kolkata');
 $date = date("Y-m-d");
include 'DBConnection.php';

$query = "select DISTINCT order_number,time,table_no,waiter from orders where date ='$date' AND status = 'active' ORDER BY order_number DESC";
$result_set = $con->query($query);
$amt=0;



 ?>

 <div class="row">
                <div class="col-sm-1">            
                  </div>
                    <div class="col-sm-10">
                  


                  <?php
                  $j=1;
                  while($row = $result_set->fetch_assoc())
                  {
                    $order_num=$row['order_number'];
                    $query_o_item = "select * from orders where order_number = '$order_num' ORDER BY order_number";
                    $query_result_item = $con->query($query_o_item);

                 
                  ?>
                        <div class="panel panel-success">
                  <div class="panel-heading" style="color:black;font-size:1.4em">

<span class="label label-primary"><?php echo $j; ?></span>
<span class="label label-danger"><?php echo "ORDER ID : ".$row['order_number']; ?></span>
<span class="label label-success" style="color:black"><?php echo "TABLE NUMBER : ".$row['table_no']; ?></span>
<span class="label label-success" style="color:black"><?php echo "WAITER : ".$row['waiter']; ?></span>
<span style="float:right;font-weight:bold;"><?php echo "&#128337; ".$row['time']; ?></span>
                          </div>

                          <div class="panel-body">
                                       <table class="table table-condensed">
                                          <thead>
                                            <tr>
                                              <th>ITEM</th>
                                              <th>QUANTITY</th>
                                              <th>AMMOUNT</th>
                                            </tr>
                                          </thead>
                                          <tbody>

                                             <?php
                                              while($row_o_item=$query_result_item->fetch_assoc())
                                              {
                                              ?>
                                              
                                              
                                            <tr>
                                              <td><?php echo $row_o_item['item'] ?></td>
                                              <td><?php echo $row_o_item['qty'] ?></td>
                                              <td><?php 

                                            $item_cost=$row_o_item['cost'];
                                            $item_qty=$row_o_item['qty'];
                                            $item_tax=$row_o_item['tax'];
                                            $item_total=($item_cost*$item_qty*$item_tax/100)+$item_cost*$item_qty;
                                             echo $item_total; ?></td>
                                            </tr>
                                           
                                            <?php
                                              $amt=$row_o_item['ammount'];
                                              }
                                            ?>
                                            <tr>
                                              <td></td>
                                              <td style="font-weight: bold">TOTAL</td>
                                              <td style="font-weight: bold;font-size: 1.3em"><?php echo "&#8377; ".$amt ?></td>
                                            </tr>


                                          </tbody>
                                        </table>
                                  <div class="well">

                                    <button id="<?php echo $order_num; ?>" type="button" class="btn btn-primary" style="margin:5px" onclick="create_bill(this)">
                                     GENERATE BILL
                                   </button>
                                                                       
                                   <button id="<?php echo $order_num; ?>" type="button" class="btn btn-primary" style="margin:5px" onclick="delete_the_order(this)">
                                     DELETE
                                   </button>

                                   <button type="button" class="btn btn-primary" style="margin:5px" onclick="edit_order('<?php echo $order_num; ?>')">
                                     EDIT
                                   </button>
                                  </div>
                          </div>


                        </div>


                  <?php
                  $j++;
                }
                  ?>
                      
                    </div>
                  <div class="col-sm-1">  
                </div>
              </div>


           