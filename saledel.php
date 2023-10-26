<?php

$price="";
$amount="";
?>


<?php

include("connect.php");
if(isset($_GET["txta"])){

  $info = array();
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
    //$myid="";
      $myid=$info[1][$a];
    $stocks=0;
  //  $myid=str_replace(' ', '%20', $myid);
    $result=$conn->query("select * from product where code like '$myid'");
  
      while($row=$result->fetch_assoc()){
      $stocks=$row["stocks"];  
               
      }
      
      $stocks=$stocks-$info[2][$a];
      $conn->query("update product set stocks=$stocks where code like '$myid'");  
     
     // $conn->query("insert into salesavetoday (cashname,total,payment,change1) values ('$_GET[txtname]','$_GET[txta]','$_GET[txtb]','$_GET[txtc]')");
     // $conn->query("TRUNCATE TABLE salestoday");
    }
  
        }
    
    ?>