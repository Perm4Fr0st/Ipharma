<?php
$myid="";
$price="";
$amount="";
?>


<?php

include("connect.php");
if(isset($_GET["txtmyid"])){
    $result=$conn->query("select * from product where id='$_GET[txtmyid]'");
            while($row = $result->fetch_assoc()){
             $myid=$row["code"];
             $price=$row["price"];
             }
}


if(isset($_GET["txtmyid"])){
    if(isset($_GET["txtqty"])){
        if(isset($_GET["txtmode"])){
            if(isset($_GET["txtname"])){
                if(isset($_GET["txtdate"])){
                    if(isset($_GET["txttime"])){

    //$result=$conn->query("update product set stocks='$_GET[txtin]' where id='$_GET[txtedit]'");
    $amount=($_GET["txtqty"])*$price;
    
    $conn->query("insert into salestoday(code,qty,cashname,date1,time1,mode1,price,amount,bid) values ('$myid','$_GET[txtqty]','$_GET[txtname]','$_GET[txtdate]','$_GET[txttime]','$_GET[txtmode]','$price','$amount','$_GET[txtbranch]')");
    
        }
    }
}
}
    }
}
//if(isset($_GET["txtmyid"])){
   // if(isset($_GET["txtmode"])){
    
    //$result=$conn->query("update product set stocks='$_GET[txtin]' where id='$_GET[txtedit]'");
    //$conn->query("insert into salestoday(mode1) values ('$_GET[txtmode]')");
    
   // }
//}
//if(isset($_GET["txtmyid"])){
   // if(isset($_GET["txtname"])){
    
    //$result=$conn->query("update product set stocks='$_GET[txtin]' where id='$_GET[txtedit]'");
   // $conn->query("insert into salestoday(cashname) values ('$_GET[txtname]')");
    
   // }
//}


//if(isset($_GET["txtprno"])){

  //  $conn->query("insert into prodhis (code,date1,type1,debit,bal) values ('$pic','$_GET[txtdate]','Phyisical Inventory','$_GET[txtin]','$_GET[txtin]')");
   // }



    
    ?>