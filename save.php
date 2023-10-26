<?php
$pic="";
$picc="";
?>


<?php

include("connect.php");
if(isset($_GET["txtprno"])){
    $result=$conn->query("select * from stocks where id='$_GET[txtedit]'");
            while($row = $result->fetch_assoc()){
             $pic=$row["pid"];
             }
}

if(isset($_GET["txtedit"])){
    if(isset($_GET["txtin"])){
 
    $result=$conn->query("update stocks set stocks='$_GET[txtin]' where id='$_GET[txtedit]'");
    $conn->query("insert into prodhis (code,date1,type1,debit,bal,bid) values ('$pic','$_GET[txtdate]','Phyisical Inventory','$_GET[txtin]','$_GET[txtin]','$_GET[txtbranch]')");
    
    }
}



//if(isset($_GET["txtprno"])){

  //  $conn->query("insert into prodhis (code,date1,type1,debit,bal) values ('$pic','$_GET[txtdate]','Phyisical Inventory','$_GET[txtin]','$_GET[txtin]')");
   // }



    
    ?>