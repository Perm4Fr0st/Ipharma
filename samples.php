<?php
$myid="";
$price="";
$amount="";
?>


<?php

include("connect.php");
if(isset($_GET["txta"])){
    if(isset($_GET["txtb"])){
        if(isset($_GET["txtc"])){
            if(isset($_GET["txtname"])){
                
                $info=[[]];
                $counter=0;
                $result=$conn->query("select * from salestoday");
                while($row = $result->fetch_assoc()){
                   $counter++;
                    $info[1][$counter]=$row["code"];
                    $info[2][$counter]=$row["qty"];
                    $info[3][$counter]=$row["price"];
                    $info[4][$counter]=$row["amount"];
                }
                $a=0;
                for($a=1;$a<=$counter;$a++){
                    $myid=($info[1][$a]);
                  $stocks=0;
                  $result=$conn->query("select * from product where id like '$myid'");
                
                    while($row=$result->fetch_assoc()){
                    $stocks=$row["stocks"];
                   
                    }
                    $stocks=$stocks - ($info[2][$a]);
                    
                    $conn->query("update product set stocks=$stocks where id='$info[$a,1]'");
                    $conn->query("insert into salesavetoday (cashname,total,payment,change1) values ('$_GET[txtname]','$_GET[txta]','$_GET[txtb]','$_GET[txtc]')");
                    $conn->query("TRUNCATE TABLE salestoday");
                  }
                
            
  
        }
    }
}
}

     
var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  if(this.readyState == 4 && this.status == 200){
 // document.getElementById("cash").innerHTML = this.responseText;
}
};

xmlhttp.open("GET", "saledel.php?txta="+a+"&txtb="+b+"&txtc="+c+"&txtname="+name, true);
xmlhttp.send();

    
    ?>