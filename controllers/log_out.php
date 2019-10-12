<?php

session_start();
$_SESSION['login_flag']=0;
$_SESSION['login_flag_a']=0;
header("location:../index.php");

?>