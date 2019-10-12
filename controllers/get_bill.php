<?php
include 'DBConnection.php';
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$order_id = $_GET['target_bill_id'];
$discount = $_GET['target_bill_discount'];
$query = "select DISTINCT * from orders where order_number = '$order_id'";
$result_set = $con->query($query);
$amt = 0;
$query_business="select service_tax from business_info";
$query_result_business = $con ->query($query_business);
$row_business= $query_result_business->fetch_assoc();




?>


<div class="container">
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>ITEM</strong></td>
        							<td class="text-center"><strong>UNIT PRICE (Rs.)</strong></td>
        							<td class="text-center"><strong>QUANTITY</strong></td>
        							<td class="text-right"><strong>TAX (%)</strong></td>
        							<td class="text-right"><strong>AMMOUNT</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php
                                while($row=$result_set->fetch_assoc())
                                {
                                    ?>
                                
    							<tr>
    								<td><?php echo $row['item']; ?></td>
    								<td class="text-center"><?php echo $row['cost']; ?></td>
    								<td class="text-center"><?php echo $row['qty']; ?></td>
    								<td class="text-right"><?php echo $row['tax']; ?></td>
    								<td class="text-right"><?php echo ($row['cost']*$row['qty']*$row['tax']/100)+$row['cost']*$row['qty']; ?></td>
    							</tr>
                                
                              <?php
                              $amt=$row['ammount'];
                          }
                          ?>
                              
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right"><?php echo $amt; ?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="thick-line"></td>
    								<td class="no-line text-center"><strong>Service Tax</strong></td>
    								<td class="no-line text-right"><?php $s_tax=$row_business['service_tax'];
                                        $s_tax_price = ($amt*$s_tax/100);
                                     echo "(".$s_tax."%) +".$s_tax_price;
                                       $amt= $amt +$s_tax_price; 
                                       ?></td>
    							</tr>
    								<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="thick-line"></td>
    								<td class="no-line text-center"><strong>Discount</strong></td>
    								<td class="no-line text-right">
                                     <?php       
                                     
                                     $discount_price = ($amt*$discount/100);
                                    echo "(".$discount."%) -".$discount_price;
                                    ?>

                                </td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td><td class="thick-line"></td>
    								<td class="no-line text-center"><strong>Grand Total</strong></td>
    								<td class="no-line text-right" style="font-weight:bold;font-size: 1.6em">&#8377; <span id="to_pay"><?php echo round($amt-$discount_price,2); ?></span></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
