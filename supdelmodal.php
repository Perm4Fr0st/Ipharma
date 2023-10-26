<?php
include("connect.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Price</title>

     <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Make the display compatible with phones -->

	<!-- Bootstrap and JQuery -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	  




    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
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
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
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
</style>




</head>
<body style="margin:20px">

        <table>
            
             <?php
session_start();

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbase = "dbpharma";

   if(isset($_SESSION["txtmyid"])==false){
       $_SESSION["txtmyid"]="";
   }
   if(isset($_GET["txtmyid"])){
       $_SESSION["txtmyid"]=$_GET["txtmyid"];
   }


if(isset($_SESSION["txtcode1"])==false){
    $_SESSION["txtcode1"]="";
}
if(isset($_GET["txtcode1"])){
    $_SESSION["txtcode1"]=$_GET["txtcode1"];
}

$conn=mysqli_connect($servername, $username, $password, $dbase);
$myproduct="";
$result=$conn->query("select * from tblledger where id like '$_SESSION[txtmyid]'");
             while($row = $result->fetch_assoc()){
              $myid=$row["id"];
              $date1=$row["flddate"];
              $branch=$row["branch"];
             }
$totalqty="";
  $result=$conn->query("select sum(qty) as total from supdel where delid like '$myid'");
  while($row = $result->fetch_assoc()){
     $totalqty=$row["total"];
  }
  $totalam="";
  $totalam1="";
  $result=$conn->query("select sum(price) as totals from supdel where delid like '$myid'");
  while($row = $result->fetch_assoc()){
     $totalam=$row["totals"];
     //$totalam1=$totalam*$totalqty;
   // $conn->query("update delivery set amount='$totalam' where id='$_SESSION[txtmyid]'");
  }
$stocks="";
$result=$conn->query("select * from stocks where id like '$_SESSION[txtcode1]'");
while($row = $result->fetch_assoc()){
    $myproduct=$row["pid"];
    $stocks=$row["stocks"];
}
             

            $price="";
            $qty="";
             $mysave1="Add";
             if (isset($_GET["txteditid"])){
                if ($_GET["txteditid"]!=""){
                    $result=$conn->query("select * from supdel where id=$_GET[txteditid]");
                    while($row=$result->fetch_assoc()){
                        $myproduct=$row["prod"];
                        $qty=$row["qty"];
                        $price=$row["price"];
                        $mysave1="update";
                    }
                }
            }

            

        ?>
                                <form method=get action=supdelmodal.php>
                                <table>
                                <tr><td>Delivery Code:</td><td><input type=hidden name=txtmyid id="txtmyid" value='<?php echo $_SESSION["txtmyid"];?>'><input type=text value='<?php echo $myid;?>' readonly></td></tr>
                                <tr><td>Branch:</td><td><input type=hidden name=txtbranch id="txtbranch" value='<?php echo $branch;?>'><input type=text value='<?php echo $branch;?>' readonly></td></tr>
                                <tr><td>Product:</td><td><input type=hidden name=txtcode1 id="txtcode1" value='<?php echo $_SESSION["txtcode1"];?>'><input type=text value='<?php echo $myproduct;?>' readonly><a href=# onclick="product()" >Search</a></td></tr>
                                <tr><td>Price:</td><td><input type=text name=txtprice value='<?php echo $price;?>'></td></tr>
                                <tr><td>Quantity:</td><td><input type=text name=txtqty id="txtqty" onfocusout="showme()" value='<?php echo $qty;?>'></td></tr>
                                
                                <tr><td>stocks:</td><td><input type=text name=txtstocks id="txtstocks" value='<?php echo $stocks;?>'readonly> </td></tr>

                               <input type=hidden name=txteditid value=<?php if (isset($_GET["txteditid"])){echo $_GET["txteditid"];} ?>>
                               <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?>></td></tr>
                               </table><br><br>
                                </form>
            <?php
            if (isset($_GET["txteditid"])){
                if($_GET["txteditid"]!=""){
                    echo "<a href=supdelmodal.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txteditid"])){
            if ($_GET["txteditid"]==""){
                
                $conn->query("insert into supdel (delid,prod,qty,price,bid) values ('$_GET[txtmyid]','$myproduct','$_GET[txtqty]','$_GET[txtprice]','$_GET[txtbranch]')");
                //$conn->query("insert into prodhis (code) values ('$_GET[txtcode]')");



                
                $idmy=$_GET["txtmyid"];
                $qty1=$_GET["txtqty"];
                $branchh=$_GET["txtbranch"];
  $info = array();
  $counter=0;
  $result=$conn->query("select * from supdel where delid like '$idmy' and bid like '$branchh'");
  while($row = $result->fetch_assoc()){
     $counter++;
      $info[$counter][1]=$row["delid"];
      $info[$counter][2]=$row["prod"];
      $info[$counter][3]=$row["qty"];
      $info[$counter][4]=$row["price"];
      $info[$counter][5]=$row["bid"];
  }


  $a=0;
  $myids=0;
  $myidd=0;
  for($a=1;$a<=$counter;$a++){
    //$myid="";
    $stocks=0;
    $debit=0;
    $price=0;
    $branchhh=0;
      $myidd=$info[$a][1];
      $myids=$info[$a][2];
      $debit=$info[$a][3];
      $price=$info[$a][4];
      $branchhh=$info[$a][5];
    //$myids=str_replace(' ', '%20', $myids);
    //$result=$conn->query("select product.code,product.stocks,delprod.delid from product,delprod where delprod.delid='$myidd' and product.code='$myid'");
    $result=$conn->query("select * from prodhis where code like '$myids' and bid like '$branchhh' order by id desc limit 1");
      while($row=$result->fetch_assoc()){
      $stocks=$row["bal"];             
      }
      
      
      
      
     // $conn->query("insert into salesavetoday (cashname,total,payment,change1) values ('$_GET[txtname]','$_GET[txta]','$_GET[txtb]','$_GET[txtc]')");

    }
    $stocks+=$qty1;
      $type1="Delivery";
      $conn->query("update stocks set stocks=$stocks where pid like '$myids' and bid like '$branchhh'");  
      $conn->query("insert into prodhis (code,date1,type1,debit,bal,bid) values ('$myids','$date1','$type1','$debit','$stocks','$branchhh')");
   


                header("Refresh:0; url=supdelmodal.php");
            }
            else{
                if (isset($_GET["txtcode1"])){
                    
                $conn->query("update supdel set prod='$_GET[txtcode1]',qty='$_GET[txtqty]',price='$_GET[txtprice]' where id=$_GET[txteditid]");
                header("Refresh:0; url=supdelmodal.php");
               
                }
            }
        }
       
      
        if (isset($_GET["txtdel"])){

          //$idmy=$_GET["txtmyid"];
          //$qty1=$_GET["txtqty"];
         // $branchh=$_GET["txtbranch"];

$result=$conn->query("select * from supdel where id=$_GET[txtdel]");
while($row = $result->fetch_assoc()){
    $qty1=$row["qty"];
    $idmy=$row["delid"];
    $branchh=$row["bid"];
}

          
$info = array();
$counter=0;
$result=$conn->query("select * from supdel where delid like '$idmy' and bid like '$branchh'");
while($row = $result->fetch_assoc()){
 $counter++;
  $info[$counter][1]=$row["delid"];
  $info[$counter][2]=$row["prod"];
  $info[$counter][3]=$row["qty"];
  $info[$counter][4]=$row["price"];
  $info[$counter][5]=$row["bid"];
}


$a=0;
$myids=0;
$myidd=0;
for($a=1;$a<=$counter;$a++){
//$myid="";
$stocks=0;
$debit=0;
$price=0;
$branchhh=0;
  $myidd=$info[$a][1];
  $myids=$info[$a][2];
  $debit=$info[$a][3];
  $price=$info[$a][4];
  $branchhh=$info[$a][5];
//$myids=str_replace(' ', '%20', $myids);
//$result=$conn->query("select product.code,product.stocks,delprod.delid from product,delprod where delprod.delid='$myidd' and product.code='$myid'");
$result=$conn->query("select * from prodhis where code like '$myids' and bid like '$branchhh' order by id desc limit 1");
  while($row=$result->fetch_assoc()){
  $stocks=$row["bal"];             
  }
  
  
  
  
 // $conn->query("insert into salesavetoday (cashname,total,payment,change1) values ('$_GET[txtname]','$_GET[txta]','$_GET[txtb]','$_GET[txtc]')");

}
$stocks=$stocks-$qty1;
  $type1="Mistake";
  $conn->query("update stocks set stocks=$stocks where pid like '$myids' and bid like '$branchhh'");  
  $conn->query("insert into prodhis (code,date1,type1,credit,bal,bid) values ('$myids','$date1','$type1','$debit','$stocks','$branchhh')");


  $conn->query("delete from supdel where id=$_GET[txtdel]");

            header("Refresh:0; url=supdelmodal.php");
        }
      

        echo "<table id=customers>";
        echo "<th width=20%>Delete/Edit</th><th>Product Name</th><th>Quantity</th><th>Price</th>";
        $result=$conn->query("select * from supdel where delid like '$_SESSION[txtmyid]'");
        
        while($row=$result->fetch_assoc()){
           //$desc=str_replace(' ', '%20', $desc);
            echo "<tr><td><a href=supdelmodal.php.php?txtdel=$row[id]><img src=delete.png width=40px></a><a href=supdelmodal.php.php?txteditid=$row[id]><img src=edit.png width=30px></a></td><td>$row[prod]</td><td>$row[qty]</td><td>$row[price]</td></tr>";
        }
       echo "</table>";

       
       

       ?>
    <table>
    <tr><td>Total Quantity:</td><td><input type=hidden name=txttotalqty id="txttotalqty" value='<?php echo $_SESSION["txttotalqty"];?>'><input type=text value='<?php echo $totalqty;?>' readonly></td>
    <td>Total Amount:</td><td><input type=hidden name=txttotalam id="txttotalam" value='<?php echo $_SESSION["txttotalam"];?>'><input type=text value='<?php echo $totalam;?>' readonly></td></tr>
    </table>
               


    <div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="closeme()">&times;</span>
	<p id=mylink></p>
  </div>
</div>

</div>

<script>
  var modal = document.getElementById("myModal");
function closeme(){
  document.getElementById("mylink").style.display="none";
  window.location="delmodaladmin.php";
    }
    function product(){
        //document.getElementById("myproduct").style.display="block";
        modal.style.display = "block";
        var txtid=document.getElementById("txtbranch").value;
        document.getElementById("mylink").innerHTML="<iframe src=productmodal.php?txtbranch="+txtid+" width=100% FrameBorder=1 height=200px></iframe>";
    }
function showme(){
  var qty=document.getElementById("txtqty").value;
  var stocks=document.getElementById("txtstocks").value;
  var code=document.getElementById("txtcode1").value;
  var total=parseInt(qty)+parseInt(stocks);
  //alert(code);
  var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  if(this.readyState == 4 && this.status == 200){
  //document.getElementById("customers").innerHTML = this.responseText;
}
};

xmlhttp.open("GET", "delupdate.php?txttotal="+total+"&txtid="+code, true);
xmlhttp.send();


}




</script>
         

     
        

</body>

</html>