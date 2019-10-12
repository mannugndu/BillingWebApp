<?php

 date_default_timezone_set('Asia/Kolkata');
 $date = date("Y-m-d");
include 'DBConnection.php';

if($_GET['date']=="today")
{
	$date = date("Y-m-d");
}
else
{
	$date = $_GET['date'];
}

$total_sale=0;
$total_sale_one_order=0;
$service_tax=0;
$discount_one_order=0;


$query = "select DISTINCT order_number,discount_given,paid_by,time,service_tax,order_type,waiter from orders where date ='$date' AND status = 'completed' ORDER BY order_number DESC";
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

                                              while($row_o_item=$query_result_item->fetch_assoc())
                                              {
                                                $item_cost=$row_o_item['cost'];
                                                $item_qty=$row_o_item['qty'];
                                                $item_tax=$row_o_item['tax'];
                                                $item_total=(($item_cost*$item_tax/100)+$item_cost)*$item_qty;
                                                $amt=$row_o_item['ammount'];
                                              }
                                  $discount_one_order = $row['discount_given'];
                                  $total_sale_one_order=$amt;
                                  $service_tax = $row['service_tax'];
                                  $total_sale_one_order = ($total_sale_one_order*$service_tax/100)+$total_sale_one_order;
                                  $total_sale_one_order = $total_sale_one_order-($total_sale_one_order*$discount_one_order/100);

                                  

                                              mysqli_data_seek($query_result_item,0);
                                            ?>


                 
                  
                        <div class="panel panel-success" style="cursor:pointer" id="report_order_panel_head_<?php echo $j; ?>" onclick="collapse_me(this)">

                <div class="panel-heading" style="color:black;font-size:1.4em">

        <span class="label label-primary"><?php echo $j; ?></span>
        <span class="label label-danger"><?php echo "ORDER ID : ".$row['order_number']; ?></span>
        <span class="label label-success" style="color:black"><?php echo "WAITER : ".$row['waiter']; ?></span>
        <span class="label label-success" style="color:black"><?php echo "TYPE : ".$row['order_type']; ?></span>
        <span class="label label-success" style="color:black"><?php echo "PAID BY : ".$row['paid_by']; ?></span>
        <span style="font-size:12px"> ORDER AMOUNT : </span><span style="font-weight:bold"><?php echo "&#8377;".round($total_sale_one_order,2); $total_sale_one_order=0 ?></span>
        <span style="float:right;font-weight:bold;"><?php echo "&#128337; ".$row['time']; ?></span>



                          </div>

                          <div style="display:none" class="panel-body" id="report_order_panel_body_<?php echo $j; ?>">
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
                                            $item_total=(($item_cost*$item_tax/100)+$item_cost)*$item_qty;
                                             echo $item_total; ?></td>
                                            </tr>
                                           
                                            <?php
                                              $amt=$row_o_item['ammount'];
                                             
                                              }
                  $discount_one_order = $row['discount_given'];
                  $total_sale_one_order=$amt;
                  $service_tax = $row['service_tax'];
                  $total_sale_one_order = ($total_sale_one_order*$service_tax/100)+$total_sale_one_order;
                  $total_sale_one_order = $total_sale_one_order-($total_sale_one_order*$discount_one_order/100);

                  $total_sale +=$total_sale_one_order;
                  $j++;
                                            ?>
                                            <tr>
                                              <td></td>
                                              <td style="font-weight: bold">TOTAL</td>
                                              <td style="font-weight: bold;font-size: 1.3em"><?php echo "&#8377; ".$amt ?>
                                                
                                              </td>
                                            </tr>

                                             <tr>
                                              <td></td>
                                              <td style="font-weight: bold">SERVICE TAX</td>
                                              <td style="font-weight: bold;font-size: 1.3em"><?php echo $service_tax."%"; ?>
                                                
                                              </td>
                                            </tr>

                                             <tr>
                                              <td></td>
                                              <td style="font-weight: bold">DISCOUNT GIVEN</td>
                                              <td style="font-weight: bold;font-size: 1.3em"><?php echo $row['discount_given']."%"; ?>
                                                
                                              </td>
                                            </tr>

                                             <tr>
                                              <td></td>
                                              <td style="font-weight: bold">GRAND TOTAL</td>
                              <td style="font-weight: bold;font-size: 1.3em"><?php echo "&#8377; ".round($total_sale_one_order,2); ?>
                                                
                                              </td>
                                            </tr>

                                          </tbody>
                                        </table>
                               
                          </div>


                        </div>


                  <?php

                } 
                  ?>
                      
                    </div>
                  <div class="col-sm-1">  
                </div>
              </div>

<input type="hidden" value="<?php echo round($total_sale,2); ?>" id="total_sales_val">
   <input type="hidden" value="<?php echo $j-1; ?>" id="total_orders_completed">
           

