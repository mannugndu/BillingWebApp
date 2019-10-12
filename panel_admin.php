<?php
session_start();
if(!isset($_SESSION['login_flag_a'])||$_SESSION['login_flag_a']==0)
{
  header("location:index.php");
}

include 'controllers/DBConnection.php';


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





@media screen and (min-width: 800px) 
{
    #tab_container
  {
    overflow-x: hidden;
    overflow-y:scroll;
    height: 630px;
  }
}



  .login-form {
    width: 80%;
      margin: 50px auto;
  }
    .login-form form {
      margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }

  .btn:focus,.btn:hover
    {
      background-color:#C9302C;
     
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
        <label style="font-weight:bold;text-decoration: underline;">INFO</label>
        <li>--</li>
               
        <li><a href="controllers/log_out_admin.php"><button type="button" class="btn btn-primary">LOG OUT</button></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav hidden-xs">
      <h2><?php echo $row_business['name']; ?></h2><hr>
      <ul class="nav nav-pills nav-stacked">
        <label style="font-weight:bold;text-decoration: underline;"></label>


             <li> 
                <div class="panel panel-primary">
                  <div class="panel-heading">MENU</div>
                  <div class="panel-body">
                     <span id="show_menu_count" style="font-size: 2em" class="badge"></span>
                    <button type="button" onclick="menu_show()">MANAGE</button>
                  </div>
                </div>
            </li>

         <li> 
                <div class="panel panel-primary">
                  <div class="panel-heading">WAITERS</div>
                  <div class="panel-body">
                     <span id="show_waiters_count" style="font-size: 2em" class="badge"></span>
                    <button type="button" onclick="waiters_show()">MANAGE</button>
                  </div>
                </div>
          </li>

             <li> 
                <div class="panel panel-primary">
                  <div class="panel-heading">TABLES</div>
                  <div class="panel-body">
                     <span id="show_tables_count" style="font-size: 2em" class="badge"></span>
                    <button type="button" onclick="edit_tables()">UPDATE</button>
                  </div>
                </div>              
              </li>
        
         <li> 
                 <div class="panel panel-primary">
                  <div class="panel-heading">SERVICE TAX</div>
                  <div class="panel-body">
                     <span id="show_service_tax" style="font-size: 2em" class="badge"></span>
                    <button type="button" onclick="edit_service_tax()">UPDATE</button>
                  </div>
                </div>         
          </li>


        <li><a href="controllers/log_out_admin.php"><button type="button" class="btn btn-primary">LOG OUT</button></a></li>
      </ul><br>
    </div>
    <br>
<div class="col-sm-10">












<div class="well">



<div class="container-fluid" id="new_form">
  <div class="row">
    <h2 style="text-align: center">ADD NEW MENU</h2>
<form action="controllers/add_product.php">
    <div class="col-sm-3">
       <label for="comment">NAME OF PRODUCT</label>         
       <input type="text" class="form-control" name="item_name" required>
    </div>
    <div class="col-sm-2">
      <label for="comment">COST</label>         
       <input type="number" class="form-control" name="item_cost" required>
    </div>
    <div class="col-sm-2">
      <label for="comment">TAX (%)</label>         
       <input type="number" class="form-control" name="item_tax" required>
    </div>
    <div class="col-sm-2">
      <label for="comment"></label>         
       <button type="submit" class="btn btn-primary btn-block">ADD</button>
    </div>
</form>
    <div class="col-sm-3">       
    </div>  
  </div>
</div>







<div class="container-fluid" id="edit_form">
  <div class="row">
    <h2 style="text-align: center">EDIT EXISTING MENU</h2>
<form action="controllers/edit_product.php">
    <div class="col-sm-3">
       <label for="comment">NAME OF PRODUCT</label>         
       <input type="text" class="form-control" name="item_name_edit" id="item_name_edit" required>
    </div>
    <div class="col-sm-3">
      <label for="comment">COST</label>         
       <input type="number" class="form-control" name="item_cost_edit" id="item_cost_edit" required>
    </div>
    <div class="col-sm-2">
      <label for="comment">TAX (%)</label>         
       <input type="number" class="form-control" name="item_tax_edit" id="item_tax_edit" required>
    </div>
    <div class="col-sm-2">
      <label for="comment"></label>         
       <button type="submit" class="btn btn-primary btn-block">SAVE</button>
    </div>
    <input type="hidden" id="edit_serial" name="edit_serial">
</form>
    <div class="col-sm-2">
      <label for="comment"></label> 
       <button class="btn btn-primary btn-block" onclick="cancel()">CANCEL</button>
    </div>
  
  </div>
</div>




<div class="container-fluid" id="edit_service">
  <div class="row">
    <h2 style="text-align: center">UPDATE SERVICE TAX</h2>
<form action="controllers/edit_service_tax.php">
    <div class="col-sm-3">
       <label for="comment">TAX (%)</label>         
       <input type="number" class="form-control" name="service_tax" required>
    </div>
    <div class="col-sm-2">
      <label for="comment"></label>         
       <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
       
    </div></form>
    <div class="col-sm-2">
      <label for="comment"></label>
      <button class="btn btn-primary btn-block" onclick="cancel()">CANCEL</button>
    </div>

        <div class="col-sm-5">       
    </div>
  </div>
</div>




<div class="container-fluid" id="edit_table">
  <div class="row">
    <h2 style="text-align: center">UPDATE TABLES</h2>
<form action="controllers/edit_table_count.php">
    <div class="col-sm-3">
       <label for="comment">OPERATION</label>         
       <select class="form-control" name="table_operation" required>
       <option value="add">ADD</option>
       <option value="delete">DELETE</option>
       </select>

    </div>
    <div class="col-sm-2">
      <label for="comment">NUMBER OF TABLES</label>         
       <input type="number" class="form-control" name="table_number" required>
       
    </div>
    <div class="col-sm-2">
      <label for="comment"></label>         
      <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
    </div>
 </form>
      <div class="col-sm-2"> 
        <label for="comment"></label>         
        <button type="submit" class="btn btn-primary btn-block" onclick="cancel()">CANCEL</button>      
       </div>
       <div class="col-sm-3">
       </div>
  </div>
</div>




<div class="container-fluid" id="new_waiter">
  <div class="row">
    <h2 style="text-align: center">ADD NEW WAITER</h2>
<form action="controllers/add_new_waiter.php">
    <div class="col-sm-3">
       <label for="comment">NAME</label>         
       <input type="text" class="form-control" name="waiter_name" required>
       

    </div>
    <div class="col-sm-2">
      <label for="comment">MOBILE NUMBER</label>         
       <input type="number" class="form-control" name="waiter_number" required>
       
    </div>
    <div class="col-sm-2">
      <label for="comment">ADDRESS</label>         
       <input type="text" class="form-control" name="waiter_address" required>
    </div>

    <div class="col-sm-2">
      <label for="comment"></label>         
      <button type="submit" class="btn btn-primary btn-block">ADD</button>
    </div>
 </form>
      <div class="col-sm-2"> 
        <label for="comment"></label>         
              
       </div>
       <div class="col-sm-1">
       </div>
  </div>
</div>




<div class="container-fluid" id="edit_waiter">
  <div class="row">
    <h2 style="text-align: center">UPDATE WAITER's DATA</h2>
<form action="controllers/update_waiter.php">
    <div class="col-sm-3">
       <label for="comment">NAME</label>         
       <input type="text" class="form-control" id="edit_waiter_name" name="edit_waiter_name" required>
       

    </div>
    <div class="col-sm-2">
      <label for="comment">MOBILE NUMBER</label>         
       <input type="number" class="form-control" id="edit_waiter_number" name="edit_waiter_number" required>
       
    </div>
    <div class="col-sm-2">
      <label for="comment">ADDRESS</label>         
       <input type="text" class="form-control" id="edit_waiter_address" name="edit_waiter_address" required>
    </div>

    <div class="col-sm-2">
      <label for="comment"></label>         
      <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
    </div>
    <input type="hidden" id="edit_serial_waiter" name="edit_serial_waiter">
 </form>
      <div class="col-sm-2"> 
        <label for="comment"></label>         
        <button type="submit" class="btn btn-primary btn-block" onclick="cancel_waiter_edit()">CANCEL</button>      
       </div>
       <div class="col-sm-1">
       </div>
  </div>
</div>


</div><!-- well-->






<table class="table table-hover" id="items_table">
    <thead>
      <tr>
        <th>PRODUCT NAME</th>
        <th>COST</th>
        <th>TAX (%)</th>
        <th>EDIT</th>
        <th>DELETE</th>
      </tr>
    </thead>
    <tbody id="items">
        <!-- ajax will load the values -->
    </tbody>
  </table>


<table class="table table-hover" id="waiters_table">
    <thead>
      <tr>
        <th>WAITER NAME</th>
        <th>MOBILE</th>
        <th>ADDRESS</th>
        <th>EDIT</th>
        <th>DELETE</th>
      </tr>
    </thead>
    <tbody id="waiters">
        <!-- ajax will load the values -->
    </tbody>
  </table>














  </div><!-- col sm 10 -->



  </div>
</div>



</body>
<script type="text/javascript">
$(document).ready(function(){
  $("#waiters_table").fadeOut();
  $("#new_form").css("display","block");
  $("#edit_form").css("display","none");
  $("#edit_service").css("display","none");
  $("#edit_table").css("display","none");
  $("#new_waiter").css("display","none"); 
  $("#edit_waiter").css("display","none");


 
  get_items();  
  get_waiters_list()
  get_service_tax();
  get_tables_count();
  get_waiters_count();
  get_menu_count();

});

function get_items()
{
     var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            document.getElementById("items").innerHTML=xhttp.responseText;
          }
        };
        xhttp.open("GET", "controllers/get_items.php", true);
        xhttp.send();
}
function get_waiters_list()
{
       var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            document.getElementById("waiters").innerHTML=xhttp.responseText;
          }
        };
        xhttp.open("GET", "controllers/get_waiters.php", true);
        xhttp.send();
}

function get_service_tax()
{
       var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            document.getElementById("show_service_tax").innerHTML=xhttp.responseText+" %";
          }
        };
        xhttp.open("GET", "controllers/get_service_tax.php", true);
        xhttp.send();
}

function get_tables_count()
{
       var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            document.getElementById("show_tables_count").innerHTML=xhttp.responseText;
          }
        };
        xhttp.open("GET", "controllers/get_tables_count.php", true);
        xhttp.send();
}

function get_waiters_count()
{
         var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            document.getElementById("show_waiters_count").innerHTML=xhttp.responseText;
          }
        };
        xhttp.open("GET", "controllers/get_waiters_count.php", true);
        xhttp.send();
}

function get_menu_count()
{
  var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200)
          {
            document.getElementById("show_menu_count").innerHTML=xhttp.responseText;
          }
        };
        xhttp.open("GET", "controllers/get_menu_count.php", true);
        xhttp.send();
}

function edit_tables()
{
  $("#waiters_table").fadeOut();
  $("#items_table").fadeOut();
  $("#new_form").css("display","none");
  $("#edit_form").css("display","none");
  $("#edit_service").css("display","none");
  $("#edit_table").css("display","block");
  $("#new_waiter").css("display","none"); 
  $("#edit_waiter").css("display","none");

}

function edit_product(e)
{

    
    $.ajax({
        type:'GET',
        data:"serial="+e.id,
        url:'controllers/get_item_detail.php',
        dataType: 'json',
        success:function(data) {
        document.getElementById("item_name_edit").value=data[0];
        document.getElementById("item_cost_edit").value=parseInt(data[1]);
        document.getElementById("item_tax_edit").value=parseInt(data[2]);
        }
      });

  document.getElementById("edit_serial").value=e.id;
  $("#waiters_table").fadeOut();
  $("#new_form").css("display","none");
  $("#edit_form").css("display","block");
  $("#edit_service").css("display","none");
  $("#edit_table").css("display","none");
  $("#new_waiter").css("display","none"); 
  $("#edit_waiter").css("display","none");
  //alert(e.id);
}
function edit_waiter(e)
{

    
    $.ajax({
        type:'GET',
        data:"serial="+e.id,
        url:'controllers/get_waiter_detail.php',
        dataType: 'json',
        success:function(data) {
        document.getElementById("edit_waiter_name").value=data[0];
        document.getElementById("edit_waiter_number").value=data[1];
        document.getElementById("edit_waiter_address").value=data[2];
        }
      });

  document.getElementById("edit_serial_waiter").value=e.id;
  $("#waiters_table").fadeIn();
  $("#new_form").css("display","none");
  $("#edit_form").css("display","none");
  $("#edit_service").css("display","none");
  $("#edit_table").css("display","none");
  $("#new_waiter").css("display","none"); 
  $("#edit_waiter").css("display","block");
  //alert(e.id);
}




function edit_service_tax()
{
  $("#items_table").fadeOut();
  $("#waiters_table").fadeOut();
  $("#new_form").css("display","none");
  $("#edit_form").css("display","none");
  $("#edit_service").css("display","block");
  $("#edit_table").css("display","none");
  $("#new_waiter").css("display","none"); 
  $("#edit_waiter").css("display","none");
  
}


function waiters_show()
{

  $("#waiters_table").fadeIn();
  $("#items_table").fadeOut();
  $("#new_form").css("display","none");
  $("#edit_form").css("display","none");
  $("#edit_service").css("display","none");
  $("#edit_table").css("display","none");
  $("#new_waiter").css("display","block"); 
  $("#edit_waiter").css("display","none");
}


function menu_show()
{
  $("#waiters_table").fadeOut();
  $("#items_table").fadeIn();
  $("#new_form").css("display","block");
  $("#edit_form").css("display","none");
  $("#edit_service").css("display","none");
  $("#edit_table").css("display","none");
  $("#new_waiter").css("display","none"); 
  $("#edit_waiter").css("display","none");
}

function cancel()
{
  $("#waiters_table").fadeOut();
  $("#items_table").fadeIn();
  $("#new_form").css("display","block");
  $("#edit_form").css("display","none");
  $("#edit_service").css("display","none");
  $("#edit_table").css("display","none");
  $("#new_waiter").css("display","none"); 
  $("#edit_waiter").css("display","none");
}

function cancel_waiter_edit()
{
  $("#new_waiter").css("display","block"); 
  $("#edit_waiter").css("display","none");
}
</script>

</html>