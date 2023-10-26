<?php
session_start();
if(isset($_SESSION["user"])==false){
    header("location:index.php");
}

include("connect.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Cashier</title>
<style>
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
  height: 300px ;
  overflow:scroll;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  overflow:scroll;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
  
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}



   /* The Modal (background) */
   .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 10px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 10px;
  border: 0 solid #888;
  width: 500px;
  height: 500px;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
</head>
<body onload="startTime()">
  <?php
if(isset($_GET["txta"])){
  //$date=$_GET["date"];
  $info = array();
  $counter=0;
  $result=$conn->query("select * from salestoday");
  while($row = $result->fetch_assoc()){
     $counter++;
      $info[1][$counter]=$row["code"];
      $info[2][$counter]=$row["qty"];
      $info[3][$counter]=$row["price"];
      $info[4][$counter]=$row["amount"];
      $info[5][$counter]=$row["date1"];
      $info[6][$counter]=$row["time1"];
      $info[7][$counter]=$row["bid"];
  }


  $a=0;
  
  for($a=1;$a<=$counter;$a++){
    //$myid="";
      $myid=$info[1][$a];
      $credit=$info[2][$a];
      $price=$info[3][$a];
      $amount=$info[4][$a];
      $date=$info[5][$a];
      $time=$info[6][$a];
      $branchh=$info[7][$a];
    $stocks=0;
   
   //$myid=str_replace(' ', '%20', $myid);
    $result=$conn->query("select * from stocks where pid like '$myid' and bid like '$branchh'");
  
      while($row=$result->fetch_assoc()){
      $stocks=$row["stocks"];  
               
      }
      $type1="Sales";
      $mode1="Cash";
      $stocks=$stocks-$info[2][$a];
      $conn->query("update stocks set stocks=$stocks where pid like '$myid' and bid like '$branchh'");  
      $conn->query("insert into prodhis (code,date1,type1,credit,bal,bid) values ('$myid','$date','$type1','$credit','$stocks','$branchh')");
      $conn->query("insert into tblsalesreport (code,qty,price,cashname,date1,time1,mode1,amount,bid) values ('$myid','$credit','$price','$_GET[txtname]','".date("Y-m-d",strtotime($date))."','$time','$mode1','$amount','$branchh')");
      $conn->query("TRUNCATE TABLE salestoday");
      echo '<meta http-equiv="REFRESH" content="2 ; url=saless.php" target="frame">';
      //header('Location: href="saless.php" target="frame"');
     // header('Location: sales.php');
    }
    $conn->query("insert into salesavetoday (date1,time1,cashname,total,mode1,payment,change1,bid) values ('$date','$time','$_GET[txtname]','$_GET[txta]','$mode1','$_GET[txtb]','$_GET[txtc]','$branchh')");
  
        }


  $result=$conn->query("select * from users where userid like '$_SESSION[user]'");
  while($row = $result->fetch_assoc()){
   $name=$row["name"];
   $branch=$row["branch"];

  }
  $result=$conn->query("select sum(amount) as total from salestoday");
  while($row = $result->fetch_assoc()){
     $totalam=$row["total"];
  }
  $mode="Mode of Payment";
  ?>
<center>
<div id="date"></div>
<div id="txt"></div>
</center>
<br><br>
<input type=hidden id=txtname value='<?php echo $name;?>'>
<input type=hidden id=txtbranch value='<?php echo $branch;?>'>
Search:<input type=text id="txtsearch" placeholder="Search Code" onkeyup="show()">
    <br><br>
    
<div class="row">
 
  <div class="column">
    <table>
    <?php
                                 echo "<table id=customers>";
                                 
                                 echo "<th>Product Code</th><th>Description</th><th>Type</th><th>Stocks</th><th>Price</th>";
                   
                                   echo "</table>";
                                
                                ?>
    </table>
  </div>
  <div class="column">
    <table>
    <?php

if (isset($_GET["txtdel"])){
  $conn->query("delete from salestoday where id=$_GET[txtdel]");
  echo '<meta http-equiv="REFRESH" content="2 ; url=saless.php" target="frame">';

}

                                echo "<table id=customers>";
                                echo "<th>ID</th><th>Code</th><th>Quantity</th><th>Mode of Payment</th><th>Price</th><th>Total Price</th><th>Remove</th>";
                                $result=$conn->query("select * from salestoday");
                                while($row=$result->fetch_assoc()){
                                   
                                    echo "<tr><td>$row[id]</td><td>$row[code]</td><td>$row[qty]</td><td>$row[mode1]</td><td>$row[price]</td><td>$row[amount]</td><td><a href=saless.php?txtdel=$row[id]><img src=delete.png width=30></a></td></tr>";
                                }
                               echo "</table>";
                                
                                ?>
    </table>
    
  </div>
  
</div>
<br>
  <center>
    
    Mode Of Payment:
                <select size=1 name=txtmode id=txtmode value=<?php echo $mode;?> >
                    <option>Cash</option>
                    <option>Credit</option>
                    <?php
                    echo "<option selected>$mode</option>";
                    ?>            
                </select>
                Total Amount:</td><td><input type=hidden name=txttotalam id="txttotalam" value='<?php echo $_SESSION["txttotalam"];?>'><input type=text value='<?php echo $totalam;?>' readonly></td></tr>
                          <button type=button onclick=pur();>Pay</button>
                              </center>










<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
<span class="close" onclick="closeme()">&times;</span>
  <p id=mylink></p>
</div>

</div>

<script>




function show() {

var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  if(this.readyState == 4 && this.status == 200){
  document.getElementById("customers").innerHTML = this.responseText;
}
};
var search;
search=document.getElementById("txtsearch").value;
var branch=document.getElementById("txtbranch").value;
xmlhttp.open("GET", "searchsale.php?txtsearch="+search+"&txtbranch="+branch, true);
xmlhttp.send();

}

function showme(myid) {
//alert(myid);
var mode=document.getElementById("txtmode").value;
var name=document.getElementById("txtname").value;
var time=document.getElementById("txt").innerHTML;
var date=document.getElementById("date").innerHTML;
var branch=document.getElementById("txtbranch").value;
let qty = prompt("How Many:", "0");
  if (qty == null || qty == "") {
    alert("User cancelled the prompt.");
  
 } else {
    //alert(qty);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  if(this.readyState == 4 && this.status == 200){
  //document.getElementById("customers").innerHTML = this.responseText;
}
};

xmlhttp.open("GET", "salebuy.php?txtmyid="+myid+"&txtqty="+qty+"&txtmode="+mode+"&txtname="+name+"&txtdate="+date+"&txttime="+time+"&txtbranch="+branch, true);
xmlhttp.send();

}
location.reload();
}



function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  let y = today.getFullYear();
  let mt = today.getMonth();
  let d = today.getDate();
  m = checkTime(m);
  s = checkTime(s);
  mt=mt+1;
  document.getElementById('date').innerHTML =  mt + "/" + d + "/" + y;
  document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}


var modal = document.getElementById("myModal");
var am = document.getElementById("txttotalam").value;
function pur(){  

  var time=document.getElementById("txt").innerHTML;
var date=document.getElementById("date").innerHTML;
    var mode=document.getElementById("txtmode").value;
    if(mode=="Cash"){
     modal.style.display = "block";
    document.getElementById("mylink").innerHTML="<iframe src=salesmodal.php? width=480px FrameBorder=1 height=450px></iframe>";
    }
    else if(mode=="Credit"){
        alert("haha");
    }
    else{
      alert("Select Mode of Payment");
    }
  }
function closeme(){
      document.getElementById("mylink").style.display="none";
      location.reload();
    }
</script>
</body>