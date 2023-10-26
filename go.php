<?php
include("connect.php");
$interest="";
if(isset($_GET["txtinterest"])){
    if ($_GET["txtinterest"]!=""){
        $result=$conn->query("select * from percent where type1 like '$_GET[txtinterest]'");
                while($row = $result->fetch_assoc()){
                    $interest=$row["percent"];
                }
       }
    }
?>