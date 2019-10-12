<?php
session_start();
if(isset($_SESSION['login_flag'])&&$_SESSION['login_flag']==1)
{
  header("location:main.php");
}
if(isset($_SESSION['login_flag_a'])&&$_SESSION['login_flag_a']==1)
{
  header("location:panel_admin.php");
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
        <li>--</li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav hidden-xs">
      <h2><?php echo $row_business['name']; ?></h2><hr>
      <ul class="nav nav-pills nav-stacked" style="margin-top:50px;">
        <label style="font-weight:bold;text-decoration: underline;">INFO</label>
        <li>--</li>
        <li>--</li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-10">
      <br><br>
<div class="container">
<div class="row">

<div class="col-md-3">
</div>

<div class="col-md-6">
    <div style="border:2px solid #DCDCDC;border-radius: 10px 10px 2px 2px;">

                      <ul class="nav nav-pills nav-justified">
                        <li class="active">
                          <a data-toggle="tab" href="#counter_login" style="border-radius: 10px 10px 0 0">COUNTER</a>
                        </li>
                        <li>
                          <a data-toggle="tab" href="#admin_login" style="border-radius: 10px 10px 0 0">ADMIN</a>
                        </li>
                      </ul>
                      <div style="background-color:#337AB7;width:100%;height:5px;"></div>

                      <div class="tab-content">

                        <div id="counter_login" class="tab-pane fade in active">
                              <div class="login-form">
                                <form action="counter_login.php" method="post">
                                  <h2 class="text-center">COUNTER Log in</h2>       
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="username_c" id="Username_c" placeholder="Username" required="required">
                                  </div>
                                  <div class="form-group">
                                      <input type="password" name="password_c" placeholder="Username" class="form-control" placeholder="Password" required="required">
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary btn-block">Log in</button>
                                  </div>
                                     
                                  </form>
                             </div>
                        </div>

                        <div id="admin_login" class="tab-pane fade">
                                <div class="login-form">
                                <form action="admin_login.php" method="post">
                                  <h2 class="text-center">ADMIN Log in</h2>       
                                  <div class="form-group">
                                      <input type="text" name="username_a" class="form-control" placeholder="Username" required="required">
                                  </div>
                                  <div class="form-group">
                                      <input type="password" name="password_a" class="form-control" placeholder="Password" required="required">
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary btn-block">Log in</button>
                                  </div>
                                     
                                  </form>
                             </div>
                        </div>
                      
                      </div>



    </div>
  </div>

</div>

<div class="col-md-3">
</div>


</div>
</div>















  </div>
  </div>
</div>



</body>
<script type="text/javascript">

</script>

</html>