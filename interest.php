<?php

include("connect.php");


if(isset($_GET["txttype"])){
    $result=$conn->query("select * from percent where type1 like '$_GET[txttype]'");
    while($row=$result->fetch_assoc()){
        echo $row["percent"];
    }
}

    
    ?>