<?php
$conn=new mysqli("localhost","root","","dbpharma");

if($conn->connect_error){
    die("Connection failed: " .$conn->connect_error);
}
?>