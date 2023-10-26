
<?php

include("connect.php");
$result=$conn->query("select * from stocks where id like '$_GET[txtcode1]' and bid like '$_GET[txtbranch]'");
  
while($row=$result->fetch_assoc()){
$stocks=$row["stocks"];  
$pid=$row["pid"]; 
$sid=$row["id"];   
$bid=$row["bid"];    
}
$code1=$_REQUEST["txtcode1"];
$qty=$_REQUEST["txtqty"];
$date=$_REQUEST["txtdate"];
$branch=$_REQUEST["txtbranch"];
$stockss=$stocks-$qty;
$type1="Pull-Out";
if(isset($_GET["txtqty"])){

 
    $result=$conn->query("update stocks set stocks='$stockss' where id like '$_GET[txtcode1]'");
    $result=$conn->query("insert into prodhis (code,date1,type1,credit,bal,bid) values ('$pid','$date','$type1','$qty','$stockss','$branch')");
    
}





    
    ?>