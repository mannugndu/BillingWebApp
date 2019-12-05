<?php
session_start();
if(!isset($_SESSION['login_flag']))
{
  header("location:index.php");
}
if($_SESSION['login_flag']==0)
{
 header("location:index.php"); 
}
include 'controllers/DBConnection.php';
$query = "select * from items";
$result_set = $con->query($query);
$query_business="select name from business_info";
$query_result_business = $con ->query($query_business);
$row_business= $query_result_business->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $row_business['name']; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>




<style>
@media print {
  body * {
    visibility: hidden;
  }
  #bill_content, #bill_content * {
    visibility: visible;
  }
  #bill_content {
    position: absolute;
    left: 0;
    top: 0;
  }
}

    * {
      font-family: 'Exo', sans-serif;
    }
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 750px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
    .btn:focus,.btn:hover
    {
      background-color:#C9302C;
     
    }
  
#snackbar, #snackbar2, #snackbar3 {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show,#snackbar2.show,#snackbar3.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

.form-group select option
{
  font-size:1.3em;
}



@media screen and (min-width: 800px) 
{
    #tab_container
  {
    overflow-x: hidden;
    overflow-y:scroll;
    height: 630px;
  }
}




  </style>





</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><?php echo $row_business['name']; ?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="color:white">
        <label style="font-weight:bold;text-decoration: underline;">Shortcuts</label>
        <li>N - New Order</li>
        <li>B - Generate Bill</li>
        <li><a href="controllers/log_out.php"><button type="button" class="btn btn-primary">LOG OUT</button></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav hidden-xs">
      <h2><?php echo $row_business['name']; ?></h2><hr>
      <ul class="nav nav-pills nav-stacked" style="margin-top:50px;">
        <label style="font-weight:bold;text-decoration: underline;">  </label>
        <li>
            <div class="panel panel-primary">
              <div class="panel-heading">ORDERS SUMMARY</div>
              <div class="panel-body" style="font-weight:bold;margin:6px;padding:0px">ACTIVE: <span id="active_orders" style="font-size:1.5em"></span></div>
              <div class="panel-body" style="font-weight:bold;margin:6px;padding:0px">COMPLETED: <span id="completed_orders" style="font-size:1.5em"></span></div>
            </div>
        </li>
        <li>
            <div class="panel panel-primary">
              <div class="panel-heading">TABLES</div>
                 <div class="panel-body" style="font-weight:bold;margin:6px;padding:0px">FREE: <span id="free_tables" style="font-size:1.5em"></span></div>
              <div class="panel-body" style="font-weight:bold;margin:6px;padding:0px">OCCUPIED: <span id="occupied_tables" style="font-size:1.5em"></span></div>
            </div>
        </li>
        <li><a href="controllers/log_out.php"><button type="button" class="btn btn-primary">LOG OUT</button></a></li>
         <li></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-10">
      
      <div class="well">
       <ul class="nav nav-pills">
      

        <li style="background:#c3daee;border-radius: 10px 10px 0px 0px;">
          <a id="orders_nav" data-toggle="pill" href="#orders" style="border-radius: 10px 10px 0px 0px;width:150px">
            ORDERS  <span  style="float: right"></span>
          </a>
        </li>
        <li style="background:#c3daee;border-radius: 10px 10px 0px 0px;">
          <a id="new_order_nav" data-toggle="pill" href="#new_order" style="border-radius: 10px 10px 0px 0px;width:150px">
            NEW ORDER <span  style="float: right"></span>
          </a>
        </li>
        <li style="background:#c3daee;border-radius: 10px 10px 0px 0px">
          <a id="bill_nav" data-toggle="pill" href="#bill" style="border-radius: 10px 10px 0px 0px;width:150px">
            BILL <span style="float: right"></span>
          </a>
        </li>
       <li style="background:#c3daee;border-radius: 10px 10px 0px 0px">
          <a id="edit_nav" data-toggle="pill" href="#edit_order" style="border-radius: 10px 10px 0px 0px;width:150px">
            MODIFY ORDER
          </a>
        </li>
        <li style="background:#c3daee;border-radius: 10px 10px 0px 0px">
          <a id="reports_nav" data-toggle="pill" href="#reports" style="border-radius: 10px 10px 0px 0px;width:150px">
            REPORTS
          </a>
        </li>
      </ul><div style="height:5px;width:100%;background-color: #337AB7;"></div>
      </div>



















<div class="tab-content" id="tab_container">


<!-- orders-->
  <div id="orders" class="tab-pane fade in active">
            <div id="loading_orders" style="width:50%;margin:auto;text-align:center">
              <img src="image/loading.gif">
              <h2 id="loading_orders_text"></h2>
            </div>
      <div id="order_content">
             <!-- the orders will be fetched by ajax-->
      </div>
              <div class="row">
                <div class="col-sm-1">           
                  </div>
                    <div class="col-sm-10">        
                      <div class="well">
                        <center>
                          <a data-toggle="pill">
                          <button id="new_order_button" type="button" class="btn btn-primary" style="font-size: 2em;"> NEW ORDER</button>
                          </a>
                        </center>
                      </div>
                    </div>
                    <div class="col-sm-1">
                  </div>
              </div>
    </div>







<!------------new order form ----------------------------->
  
    <div id="new_order" class="tab-pane fade">
      
   <div class="well">
<div class="container">
  <div class="row">
    <div class="col-md-3">
        <div class="form-group">
           <label for="comment">ORDER TYPE</label>
            
            <select class="form-control" id="order_type" onchange="order_type_changer()">
              <option value="table" selected>TABLE</option>
              <option value="packing">PACKING</option>
            </select>
      </div>
    </div>

      <div class="col-md-3">
        <label for="comment">SELECT TABLE</label>
            
             <select id="order_table" class="form-control" required>
                </select>
                     
      </div>


    <div class="col-md-2">
        <div class="form-group">
            <label for="comment">WAITER</label>
            
             <select id="order_waiter" class="form-control" required>
                </select>
                     
      </div>    
    </div>
    </div>

  </div>
</div>

 
                       <table class="table table-hover" style="width:90%;margin:auto;">
                          <thead>
                            <tr>
                              <th>ITEM(S)</th>
                              <th>QTY.</th>
                              <th>UNIT COST</th>
                              <th>TAX (%)</th>
                              <th>AMMOUNT</th>
                            </tr>
                          </thead>
                          <tbody id="items_container">

                            <tr id="item_row">
                                  <td>
                                    <div class="form-group">
                                      
                                      <input type="text" list="items" class="form-control" id="item1" name="item" style="width:90%" required onblur="item_adder(this)" onkeyup="check_item_val(this)" onfocus="reset_me(this)">
                                      <datalist id="items">
                                        <?php
                                        while ($row = $result_set->fetch_assoc())
                                        {
                                        ?>
                                         <option><?php echo $row["name"] ?></option>
                                        
                                        <?php
                                          }
                                        ?>
                                      </datalist>
                                   </div>
                                  </td>
                                  <td>
                                     <div class="form-group">

                                       <input type="text" list="qtys" class="form-control" id="qty1" name="qty" style="width:100px" required onblur="item_adder(this)" onkeyup="check_qty_val(this)" onfocus="reset_me(this)">
                                       <datalist id="qtys">
                                        
                                        <?php
                                        for($i=1;$i<1000;$i++)
                                        {
                                          echo "<option>".$i."</option>";
                                        }
                                        ?>

                                      </datalist>
                                     </div>
                                  </td>
                                  <td id="unit1" name="unit">0</td>
                                  <td id="tax1" name="tax">0 %</td>
                                  <td id="ammount1" name="ammount">Rs.0</td>
                            </tr>




                          </tbody>

                        </table>
                    
             
                            <center>
                              <button type="button" id="add_item" class="btn btn-primary btn-lg">Add Item</button>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <button type="button" id="new_order_form_button" class="btn btn-primary btn-lg">Save Order</button>
                            </center>
    </div>





<!------------    bill payment   ----------------------------->

    <div id="bill" class="tab-pane fade">
      <div class="well">
<div class="container">
  <div class="row">
    <div class="col-md-3">
        <div class="form-group">
           <label for="comment">Select Order Number</label>
            
             <input type="text" list="orders_list" class="form-control" id="bill_order" name="bill_order" onblur="show_bill(this)" onkeyup="check_disc_val(this)">
              <datalist id="orders_list">
                
              </datalist>
      </div>
    </div>

      <div class="col-md-3">
        <label for="comment">Discount (%)</label>
            
             <input type="text" placeholder="0" list="discount_val_list" class="form-control" id="bill_discount" name="bill_discount" onblur="show_bill(this)" onkeyup="check_disc_val(this)">
                    <datalist id="discount_val_list">
                    
                     <?php
                      for($i=0;$i<100;$i++)
                      {
                        echo "<option>".$i."</option>";
                      }
                      ?>
                    </datalist>
                     
      </div>


    <div class="col-md-2">
        <div class="form-group">
            <label for="comment">Pay By</label>
            
             <select class="form-control" id="bill_pay_by" name="bill_pay_by">
                      <option>CASH</option>
                      <option>CARD</option>
                     
                  </select>
      </div>    
    </div>

      <div class="col-md-2">
        <label for="comment">Received</label>
        <input type="text" class="form-control" id="received" name="received" onkeyup="refund_calculator(this)">
        <label for="comment" id="refund_show" style="margin:2px;color:#DC143C;font-weight: bold;font-size:1.2em"></label>
    </div>


      <div class="col-md-2">
<button id="" type="button" class="btn btn-primary" style="margin:5px" onclick="save_only()">
Save Only
</button>
<button id="" type="button" class="btn btn-primary" style="margin:5px" onclick="save_and_print()">
Save & Print
</button>
    </div>

  </div>
</div>
</div>
 
      <div id="bill_content">
        
      </div>
    </div>


<!-- bill pay ment tab ends-->


<!-- reports tab -->
<div id="reports" class="tab-pane fade">
      <div class="well">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                     <label for="comment">Select Date</label>
                     <input type="date" id="report_date" class="form-control">                     
              </div>
            </div>
            <div class="col-md-1">
              
               <button id="" type="button" class="btn btn-primary" style="margin:5px" onclick="show_report_content_date_go()">
                GO
              </button>
               <button id="" type="button" class="btn btn-primary" style="margin:5px" onclick="show_report_content_date()">
               TODAY
              </button>
            </div>
            <div class="col-md-4">
              <div class="well">
              <label for="comment">Total sales on this date:</label>
              <span id="total_sales" style="font-size: 2em;font-weight: bold"></span>
            </div>
            </div>
            <div class="col-md-4">

            <div class="well">
              <label for="comment">Total orders completed:</label>
              <span id="total_orders_completed_show" style="font-size: 2em;font-weight: bold"></span>
            </div>
               
            </div>

          </div>
        </div>
      </div>
             <div id="loading_reports" style="width:50%;margin:auto;text-align:center">
              <img src="image/loading.gif">
              <h2 id="loading_reports_text"></h2>
            </div> 
    <div id="report_content">
    <!-- ajax will load content here -->
             

    </div>
</div>
     <!-- reports tab ends -->




<!-- edit order tab -->

  <div id="edit_order" class="tab-pane fade">
    
      
<div class="well">
  <div class="container">
    <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="comment">ORDER NUMBER</label>
            <input type="text" class="form-control" id="edit_order_number" readonly="readonly">
          </div>
        </div>

        <div class="col-md-3">
          <label for="comment">TABLE NUMBER</label>
          <input type="text" id="edit_order_table" class="form-control" required readonly="readonly">
          
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="comment">WAITER</label>
            <select id="edit_order_waiter" class="form-control" onfocus="get_waiter_list()" required>
            </select>
          </div>    
        </div>

         <div class="col-md-2">
          <div class="form-group">
            <label for="comment">CANCEL UPDATE</label>
            <button style="font-size:15px" type="button" class="btn btn-primary btn-lg" onclick="$('#orders_nav').click()">CANCEL</button>
            </select>
          </div>    
        </div>

    </div>
  </div>
</div>
  



<table class="table table-hover" style="width:90%;margin:auto;">
  <thead>
    <tr>
      <th>ITEM(S)</th>
      <th>QTY.</th>
      <th>UNIT COST</th>
      <th>TAX (%)</th>
      <th>AMMOUNT</th>
    </tr>
  </thead>
  <tbody id="edit_items_container">
   <!-- ajax will load here -->
  </tbody>
</table>

<center>
<button type="button" id="edit_add_item" class="btn btn-primary btn-lg">Add Item</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" id="edit_order_form_button" class="btn btn-primary btn-lg">Save Order</button>
</center>

  </div>
<!-- edit order ends -->





  
</div>

<!-- end of tab contents-->

<div id="snackbar">Please fill all fields or close unused rows</div>

<div id="snackbar2">Please select the order from the list</div>

<div id="snackbar3">Please enter the money received first</div>

  </div>
  </div>
</div>

</body>

<script type="text/javascript">

function update_side_panels() {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var myObj = JSON.parse(this.responseText);
      document.getElementById("active_orders").innerHTML = myObj.active_orders_resp;
      document.getElementById("completed_orders").innerHTML = myObj.completed_orders_resp;
      document.getElementById("free_tables").innerHTML = myObj.free_tables_resp;
      document.getElementById("occupied_tables").innerHTML = myObj.occupied_tables_resp;
     // alert(this.responseText);

    }
  };
  xhttp.open("GET", "controllers/side_panels_data.php", true);
  xhttp.send();   
}



var x=1;//x of total items on the new order
var bill_id="";
var discount="0";
var item_selected_flag = false;
var edit_items_count = 0;
get_waiter_list();

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// CODE EXECUTEED ON TAB TOGGLE ///////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {

 var str = e.target;
 str = " "+str;
 var click_id=str.slice(45);
alert(click_id);
 
update_side_panels();


  if(click_id=="orders")
  {
    document.getElementById("edit_order_number").value="";
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
       {

        if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
              $("#loading_orders").fadeOut();
              document.getElementById("order_content").innerHTML =xhttp.responseText;
            }
        if(xhttp.readyState == 1)
        {
          document.getElementById("order_content").innerHTML = "";
         $("#loading_orders").fadeIn();
          document.getElementById("loading_orders_text").innerHTML = "server connection established";
          
        }
        if(xhttp.readyState == 2)
        {

        $("#loading_orders").fadeIn();
          document.getElementById("loading_orders_text").innerHTML = "request received";
        }
        if(xhttp.readyState == 3)
        {
        $("#loading_orders").fadeIn();
          document.getElementById("loading_orders_text").innerHTML = "processing request";
        }

          };
      xhttp.open("GET", "controllers/get_orders.php", true);
      xhttp.send();
  } 

  if(click_id=="new_order")
  {document.getElementById("edit_order_number").value="";
    var item_initial=document.getElementsByName("item");
    var qty_initial=document.getElementsByName("qty");
    item_initial[0].value="";
    qty_initial[0].value="";
    document.getElementById("order_type").focus();
    var x_temp=x;
    while(x_temp!=1)
    {
      $("#close_row").click();
      x_temp--;
      if(x_temp==1||x_temp<1)
      {
        break;
      }
    }
    document.getElementById("order_type").value="table";
    order_type_changer();
    get_table_list();
    get_waiter_list();
  } 

  if(click_id=="bill")
  {
document.getElementById("edit_order_number").value="";
    open_bill_panel();
  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
              document.getElementById("orders_list").innerHTML = xhttp.responseText;
            }
          };
      xhttp.open("GET", "controllers/get_orders_list.php", true);
      xhttp.send();

  }

  if(click_id=="reports")
  {document.getElementById("edit_order_number").value="";
    document.getElementById("report_date").value="";
      show_report_content_date();
  }
  

  if(click_id=="edit_order")
  {

    if(document.getElementById("edit_order_number").value=="")
    {
      alert("please select the order from the orders tab to edit");
      $("#orders_nav").click();
      return;
    }
  }

  
});

 


$('#new_order_button').click(function(){
    var x_temp=x;
    while(x_temp!=1)
    {
      $("#close_row").click();
      x_temp--;
      if(x_temp==1||x_temp<1)
      {
        break;
      }
    }

  $('#new_order_nav').click();
});


$('#new_order_button').keypress(function(event){
  if(event.keyCode==13)
  {
   $('#new_order_nav').click();
  }
});


 
////////////////////////////////////////////////////////////////////////////////////////////////
//////////// delete the order////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function delete_the_order(e)
{
var del_order_id = e.id;
var conf = confirm("are you sure ?");

if(conf) 
{   
  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
              if(xhttp.responseText=="1")
               window.location.reload();
            }
          };
      xhttp.open("GET", "controllers/delete_order.php?order_id="+del_order_id, true);
      xhttp.send();
}


}








/*
//add new order form
function submit_order_form()
{
  alert("df");
}

  $( '#new_order_form' ).submit(function( event ) {
  alert( "Handler for .submit() called." );
  event.preventDefault();
  });
*/



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// whole code onwards is about adding new order //////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////whole code onwards is about adding new order//////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$("#new_order_form_button").click(function(e) {


var item_array = document.getElementsByName("item");
var qty_array = document.getElementsByName("qty");
var dataString="";
var items_length = item_array.length;
var validity = true;


 for(var i=0;i<items_length;i++)
  {
    if(!item_array[i].checkValidity()||!qty_array[i].checkValidity())
    {
      validity=false;break;
    }
  }
  if(!document.getElementById("order_table").checkValidity()||!document.getElementById("order_waiter").checkValidity())
  {
    validity=false;
  }
 

if(validity == true)
{
   var confirm_order = confirm("are you sure ?");
  
var order_type =  document.getElementById("order_type").value;
var order_table = document.getElementById("order_table").value;
var order_waiter = document.getElementById("order_waiter").value;
   

  for(var i=0;i<items_length;i++)
  {
  dataString += 'item_name'+i+'='+item_array[i].value+"&";
  dataString += 'qty'+i+'='+qty_array[i].value+"&";
  }
  dataString += "total="+items_length+"&order_type="+order_type+"&order_table="+order_table+"&order_waiter="+order_waiter;

if(confirm_order)
{
  $.ajax({
    type:'POST',
    data:dataString,
    url:'controllers/store_order.php',
    success:function(data) {
 
 var x_temp=x;
    while(x_temp!=1)
    {
      $("#close_row").click();
      x_temp--;
      if(x_temp==1||x_temp<1)
      {
        break;
      }
    }
//alert(data);
            //return to orders
          
         $('#orders_nav').click();
                  
    
    }
  });
}
}
else
{
  myFunction();
}

});




$(document).ready(function() {


  $('#orders_nav').click();
    var id=2;
    var max_fields = 200;
    var wrapper = $("#items_container");
    var add_button = $("#add_item");
    var item_row=""; 
  

  
    $(add_button).click(function(e) {


      item_row = "<tr id=\"item_row\"><td><div class=\"form-group\"><input type=\"text\" list=\"items\" class=\"form-control\" id=\"item"+id+"\" name=\"item\" style=\"width:90%\" required onblur=\"item_adder(this)\" onkeyup=\"check_item_val(this)\" onfocus=\"reset_me(this)\"></div></td><td><div class=\"form-group\"><input type=\"text\" list=\"qtys\" class=\"form-control\" id=\"qty"+id+"\" name=\"qty\" style=\"width:100px\" required onkeyup=\"check_qty_val(this)\" onblur=\"item_adder(this)\" onfocus=\"reset_me(this)\"></div></td><td id=\"unit"+id+"\" name=\"unit\">0</td><td id=\"tax"+id+"\" name=\"tax\">0 %</td><td id=\"ammount"+id+"\" name=\"ammount\">Rs.0</td><td style=\"cursor:pointer;color:#8B0000;font-size:1.5em;font-weight:bold\" id=\"close_row\">X</td></tr>";



        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append(item_row);id++;
            var item_array = document.getElementsByName("item");
            var qty_array = document.getElementsByName("qty");
            var last_index = item_array.length-1;
            qty_array[last_index].value="0";
            item_array[last_index].focus();
             //add input box
        } else {
            alert('You Reached the limits')
        }
    });


 $(wrapper).on("click", "#close_row", function(e) {
        e.preventDefault();
        $(this).parent('tr').remove();
        x--;
    });



});


function reset_me(e)
{
  e.value="";
}
//toast or snackbar error function
function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
//toast2 or snackbar2 error function for order list
function myFunction2() {
  var xx = document.getElementById("snackbar2");
  xx.className = "show";
  setTimeout(function(){ xx.className = xx.className.replace("show", ""); }, 3000);
}
//toast3 or snackbar3 error function for order list
function myFunction3() {
  var xx = document.getElementById("snackbar3");
  xx.className = "show";
  setTimeout(function(){ xx.className = xx.className.replace("show", ""); }, 3000);
}


function check_item_val(e)
{

if(e.value.length<3)
e.value="";

}

function check_qty_val(e)
{
if(isNaN(e.value))
e.value="";
}


function item_adder(e)
{
  var this_serial=e.id.substring(2,3);
  if(this_serial == "e")
  {  
    this_serial = e.id.slice(4);
  }
  if(this_serial == "y")
  {
    this_serial = e.id.slice(3);
  }

  var this_item = document.getElementById("item"+this_serial).value;
  var this_qty="qty"+this_serial;
  var this_tax="tax"+this_serial;
  var this_cost = "unit"+this_serial;
  var this_ammount="ammount"+this_serial;
  


          $.ajax({
        type:'POST',
        data:"item_name="+this_item,
        url:'controllers/item_added_data.php',
        dataType: 'json',
        success:function(data) {
          var cost = parseInt(data[0]);
          var tax = parseInt(data[1]);
          var qty = parseFloat(document.getElementById(this_qty).value);
          var ammount = (cost*qty*tax/100)+cost*qty;
          document.getElementById(this_cost).innerHTML=data[0];
          document.getElementById(this_tax).innerHTML=data[1];
          document.getElementById(this_ammount).innerHTML=ammount;

        }
      });
    
  
}

function order_type_changer()
{
  if(document.getElementById("order_type").value=="table")
  {
    get_table_list();
    get_waiter_list();
    document.getElementById("order_table").disabled=false;
    document.getElementById("order_waiter").disabled=false;
     document.getElementById("order_table").value="";
    document.getElementById("order_waiter").value="";
  }
  else
  {

    document.getElementById("order_table").value="N/A";
    document.getElementById("order_waiter").value="N/A";
    document.getElementById("order_table").disabled=true;
    document.getElementById("order_waiter").disabled=true;
  }
}

function get_table_list()
{

 var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
              document.getElementById("order_table").innerHTML=xhttp.responseText;
            }
          };
      xhttp.open("GET", "controllers/get_table_list.php", true);
      xhttp.send();

}

function get_waiter_list()
{

 var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
             document.getElementById("order_waiter").innerHTML=xhttp.responseText; 
             document.getElementById("edit_order_waiter").innerHTML=xhttp.responseText; 
             
            }
          };
      xhttp.open("GET", "controllers/get_waiter_list.php", true);
      xhttp.send();

}


////////////// new order code ends ////////////



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////bill code/////bill code////bill code//////bill code///////bill code///////bill code////////bill code//////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function open_bill_panel()
{

document.getElementById("bill_discount").value="0";
   document.getElementById("bill_pay_by").options[0].selected = true;
   
              document.getElementById("bill_content").innerHTML="";
              document.getElementById("refund_show").innerHTML="";
              document.getElementById('bill_order').value=bill_id;
              document.getElementById("received").value="";
              bill_id="";
              document.getElementById('bill_order').focus();
    
}

function create_bill(e)
{
      bill_id=e.id;
     $('#bill_nav').click();
    document.getElementById("bill_content").innerHTML = xhttp.responseText;
    document.getElementById('bill_order').value=bill_id;

}

function show_bill(e)
{
    bill_id=document.getElementById('bill_order').value;
    discount = document.getElementById('bill_discount').value;
    if(discount=="")
    {
        document.getElementById('bill_discount').value="0";
    }
    var selected_order_flag = false;

      var o_list = document.getElementById("orders_list");
      var o_list_length = o_list.options.length;
      for(var j = 0; j < o_list_length;j++)
      {
      
       if(bill_id!=o_list.options[j].value)
        {
          selected_order_flag = false;
        }
        else
        {
          selected_order_flag = true;
          break;
          
        }
      }
if(!selected_order_flag)
{
  myFunction2();
  document.getElementById('bill_order').value="";
  document.getElementById("bill_content").innerHTML="";
}

      if(bill_id!=""&&discount!=""&&selected_order_flag)
      {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) 
          {
           document.getElementById("bill_content").innerHTML = xhttp.responseText;
          }
        };
        xhttp.open("GET", "controllers/get_bill.php?target_bill_id="+bill_id+"&target_bill_discount="+discount, true);
        xhttp.send(); 
      }
}



function refund_calculator(e)
{
  var check_value = document.getElementById("received").value;
  if(isNaN(check_value))
  {
    document.getElementById("received").value="";
  }
var refund_show = document.getElementById("refund_show");
var to_pay = document.getElementById("to_pay").innerHTML;
var refund_cal = e.value-to_pay;
refund_cal = refund_cal.toFixed(2);
refund_show.innerHTML="Refund: &#8377;"+refund_cal;
}

function check_disc_val(e)
{
if(isNaN(e.value))
e.value="";
}




// functions of bill page buttons
function save_only()
{
  //alert("saving");
  var this_pay_by = document.getElementById("bill_pay_by").value;
  var this_o_id=document.getElementById('bill_order').value;
  var this_disc=document.getElementById("bill_discount").value;
  var this_received=document.getElementById("received").value;
  var this_to_pay="";
  if(this_o_id=="")
  {
    myFunction2();
  }
 if(document.getElementById('bill_order').value!="")
 {
     this_to_pay = document.getElementById("to_pay").innerHTML;
 }

 if(this_received==""&&document.getElementById('bill_order').value!="")
 {
  myFunction3();
 }
 if(document.getElementById('bill_order').value!=""&&document.getElementById("received").value!="")
 {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) 
          {
            
           if(xhttp.responseText=="success")
            $("#orders_nav").click();
          else
            {
              alert(xhttp.responseText+"problem in system detected");
            }
          }
        };
        xhttp.open("GET", "controllers/save_bill.php?pay_by="+document.getElementById("bill_pay_by").value+"&discount="+document.getElementById("bill_discount").value+"&order_id="+document.getElementById('bill_order').value, true);
        xhttp.send(); 
 }
}


function save_and_print()
{
  var this_pay_by = document.getElementById("bill_pay_by").value;
  var this_o_id=document.getElementById('bill_order').value;
  var this_disc=document.getElementById("bill_discount").value;
  var this_received=document.getElementById("received").value;
  var this_to_pay="";
  if(this_o_id=="")
  {
    myFunction2();
  }
 if(document.getElementById('bill_order').value!="")
 {
     this_to_pay = document.getElementById("to_pay").innerHTML;
 }
 if(this_received==""&&document.getElementById('bill_order').value!="")
 {
  myFunction3();
 }
 if(document.getElementById('bill_order').value!=""&&document.getElementById("received").value!="")
 {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) 
          {
            
           if(xhttp.responseText=="success")
           {
              window.print();
             alert("Bill receipt has been generated");
             window.location.reload();
          }
          else
            {alert(xhttp.responseText+"there's and error in your system, please request for help");}
          }
        };
        xhttp.open("GET", "controllers/save_and_print_bill.php?pay_by="+document.getElementById("bill_pay_by").value+"&discount="+document.getElementById("bill_discount").value+"&order_id="+document.getElementById('bill_order').value, true);
        xhttp.send(); 
 }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////reports////////////////reports///////////reports/////reports///////////reports//////////reports///////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



function show_report_content_date_go()
{
if(document.getElementById("report_date").value=="")
{
  alert("please select the date first");
}
else
{
 var date = document.getElementById("report_date").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            
          $("#loading_reports").fadeOut();
           document.getElementById("report_content").innerHTML = xhttp.responseText;
           document.getElementById("total_sales").innerHTML="&#8377; "+document.getElementById("total_sales_val").value; 
           document.getElementById("total_orders_completed_show").innerHTML=document.getElementById("total_orders_completed").value;
          }
           if(xhttp.readyState == 1)
        {
          document.getElementById("report_content").innerHTML = " ";
         $("#loading_reports").fadeIn();
          document.getElementById("loading_reports_text").innerHTML = "server connection established";
        }
        if(xhttp.readyState == 2)
        {
         $("#loading_reports").fadeIn();
          document.getElementById("loading_reports_text").innerHTML = "request received";
        }
        if(xhttp.readyState == 3)
        {
         $("#loading_reports").fadeIn();
          document.getElementById("loading_reports_text").innerHTML = "processing request";
        }
        };
        xhttp.open("GET", "controllers/get_report.php?date="+date, true);
        xhttp.send();
}
}

function show_report_content_date()
{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            $("#loading_reports").fadeOut();
             document.getElementById("report_content").innerHTML = xhttp.responseText;
             document.getElementById("total_sales").innerHTML="&#8377; "+document.getElementById("total_sales_val").value; 
             
             document.getElementById("total_orders_completed_show").innerHTML=document.getElementById("total_orders_completed").value; 
          }
          if(xhttp.readyState == 1)
        {
          document.getElementById("report_content").innerHTML = "";
         $("#loading_reports").fadeIn();
          document.getElementById("loading_reports_text").innerHTML = "server connection established";
        }
        if(xhttp.readyState == 2)
        {
         $("#loading_reports").fadeIn();
          document.getElementById("loading_reports_text").innerHTML = "request received";
        }
        if(xhttp.readyState == 3)
        {
        $("#loading_reports").fadeIn();
          document.getElementById("loading_reports_text").innerHTML = "processing request";
        }
        };
        xhttp.open("GET", "controllers/get_report.php?date=today", true);
        xhttp.send();
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////// EDIT ORDER ///////////////EDIT ORDER//////////EDIT ORDER/////////////EDIT ORDER//////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function edit_order(e)
{

  document.getElementById("edit_order_number").value=e;
  set_waiter_table(e);
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
              document.getElementById("edit_items_container").innerHTML=xhttp.responseText;
          }
        };
        xhttp.open("GET", "controllers/get_order_edit.php?order_id="+e, true);
        xhttp.send();

 $("#edit_nav").click();

}


function edit_item_adder(e)
{
  var this_serial=e.id.slice(2);
  var this_item = document.getElementById("ei"+this_serial).value;
  var this_qty="eq"+this_serial;
  var this_tax="etax"+this_serial;
  var this_cost = "eunit"+this_serial;
  var this_ammount="eammount"+this_serial;
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            var myObj = JSON.parse(this.responseText);       
            var cost = parseInt(myObj.cost);
            var tax = parseInt(myObj.tax);
            var qty = parseFloat(document.getElementById(this_qty).value);
            var ammount = ((cost*tax/100)+cost)*qty;
            document.getElementById(this_cost).innerHTML=myObj.cost;
            document.getElementById(this_tax).innerHTML=myObj.tax;
            document.getElementById(this_ammount).innerHTML=ammount;
          }
        };
        xhttp.open("GET", "controllers/edit_item_added_data.php?item_name="+this_item, true);
        xhttp.send();

}


function set_waiter_table(order_no)
{   
  $.ajax({
    type:'GET',
    data:"order_id="+order_no,
    url:'controllers/get_waiter_table_edit.php',
    dataType: 'json',
    success:function(data) {
        document.getElementById("edit_order_table").value=data[0];
        document.getElementById("edit_order_waiter").value=data[1];
        edit_items_count = data[2];
        if(document.getElementById("edit_order_waiter").value=="N/A")
        {
         document.getElementById("edit_order_waiter").disabled=true;
         document.getElementById("edit_order_table").disabled=true; 
        }
        else
        {
         document.getElementById("edit_order_waiter").disabled=false;
         document.getElementById("edit_order_table").disabled=false;          
        }
    }
  });
}





$("#edit_order_form_button").click(function(e) {
 
  var item_array = document.getElementsByName("edit_item");
  var qty_array = document.getElementsByName("edit_qty");
  var dataString="";
  var items_length = item_array.length;
  var validity = true;
  for(var i=0;i<items_length;i++)
  {
      if(!item_array[i].checkValidity()||!qty_array[i].checkValidity())
    {

      validity=false;break;
    }
  }
  if(!document.getElementById("edit_order_table").checkValidity()||!document.getElementById("edit_order_waiter").checkValidity())
  {
    validity=false;
  }

  if(validity == true)
  {
    var order_num = document.getElementById("edit_order_number").value;
    var confirm_order = confirm("are you sure ?");
   var order_table = document.getElementById("edit_order_table").value;
    var order_waiter = document.getElementById("edit_order_waiter").value;
    for(var i=0;i<items_length;i++)
    {
      dataString += 'item_name'+i+'='+item_array[i].value+"&";
      dataString += 'qty'+i+'='+qty_array[i].value+"&";
    }
    dataString += "total="+items_length+"&order_type="+order_type+"&order_table="+order_table+"&order_waiter="+order_waiter+"&order_id="+order_num;

    if(confirm_order)
    {
        $.ajax({
        type:'POST',
        data:dataString,
        url:'controllers/edit_store_order.php',
        success:function(data) {
            //write code to close opened rows here important also set the counters here///
            edit_items_count=0;
          //alert(data);
          document.getElementById("edit_order_number").value="";
        //return to orders
         $('#orders_nav').click();
        }
        });
    }
  }
  else
  {
    myFunction();
  }
});











    
    var edit_wrapper = $("#edit_items_container");
    var edit_add_button = $("#edit_add_item");
    var edit_item_row=""; 

    $(edit_add_button).click(function(e) {
      edit_item_row = "<tr id=\"edit_item_row\"><td><div class=\"form-group\"><input type=\"text\" list=\"items\" class=\"form-control\" id=\"ei"+edit_items_count+"\" name=\"edit_item\" style=\"width:90%\" onkeyup=\"check_item_val(this)\" required onblur=\"edit_item_adder(this)\"></div></td><td><div class=\"form-group\"><input type=\"text\" list=\"qtys\" class=\"form-control\" id=\"eq"+edit_items_count+"\" name=\"edit_qty\" style=\"width:100px\" onkeyup=\"check_qty_val(this)\" required onblur=\"edit_item_adder(this)\"></div></td><td id=\"eunit"+edit_items_count+"\" name=\"unit\">0</td><td id=\"etax"+edit_items_count+"\" name=\"tax\">0 %</td><td id=\"eammount"+edit_items_count+"\" name=\"ammount\">Rs.0</td><td style=\"cursor:pointer;color:#8B0000;font-size:1.5em;font-weight:bold\" id=\"edit_close_row\">X</td></tr>";
        edit_items_count++;
        
         e.preventDefault();
           $(edit_wrapper).append(edit_item_row);
          
        $(edit_wrapper).on("click", "#edit_close_row", function(e) {
        e.preventDefault();
        $(this).parent('tr').remove();
    });
          
    });




////////////////////////////////////////////////////
//////////// SHORTCUTS ////////////////////////////
///////////////////////////////////////////////////

$("#orders_nav").keypress(function(event){
  
alert(event.keyCode);
  if(event.keyCode==110)
  {
     //$('#new_order_nav').click();
  }
});

//////////////////////////////////////////////////////////
/////////collapse me/////////////////////////////////
///////////////////////////////////////////////////////
function collapse_me(e)
{
  var this_serial = e.id.slice(24);
  $("#report_order_panel_body_"+this_serial).slideToggle();
}






</script>






</html>