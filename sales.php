<?php
session_start();
if(isset($_SESSION["user"])==false){
    header("location:index.php");
}

include("connect.php");
include("saleheads.php");
?>
<head>
<title>iPharma</title>
</head>


  