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
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Make the display compatible with phones -->

<!-- Bootstrap and JQuery -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<style>
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
</style>

</head>

<body>



<?php
            include("connect.php");

        ?>
<?php
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];
 $bidd=$row["branch"];

}

?>
<table>

          <h2>Transfer Received</h2>
        

            
        <?php
        
       
        if (isset($_GET["txtdel"])){

            $result=$conn->query("select * from pendtransfer where id=$_GET[txtdel]");
            while($row = $result->fetch_assoc()){
                $myid=$row["code"];
                $qty=$row["qty"];
                $branch=$row["bid"];
                $branchh=$row["bidd"];
            }


            $info = array();
$counter=0;
$result=$conn->query("select * from pendtransfer where code like '$myid' and bid like '$branch' and bidd like '$branchh'");
while($row = $result->fetch_assoc()){
 $counter++;
  $info[$counter][1]=$row["date1"];
  $info[$counter][2]=$row["code"];
  $info[$counter][3]=$row["qty"];
  $info[$counter][4]=$row["bid"];
  $info[$counter][5]=$row["bidd"];
  $info[$counter][6]=$row["status1"];
}
$a=0;
$date1=0;
$reas=0;
for($a=1;$a<=$counter;$a++){

$stocks=0;
$debit=0;
$code=0;
$qty1=0;
$bid=0;
$bidd=0;
$satus1=0;
  $date1=$info[$a][1];
  $code=$info[$a][2];
  $qty1=$info[$a][3];
  $bid=$info[$a][4];
  $bidd=$info[$a][5];
  $status1=$info[$a][6];
$result=$conn->query("select * from prodhis where code like '$code' and bid like '$bidd' order by id desc limit 1");
  while($row=$result->fetch_assoc()){
  $stocks=$row["bal"];             
  }

}
$stocks=$stocks + $qty1;
$type1="Transfer Received";
$conn->query("update stocks set stocks=$stocks where pid like '$code' and bid like '$bidd'"); 
    $conn->query("update pendtransfer set status1='Received' where id like '$_GET[txtdel]'");
    $conn->query("insert into prodhis (code,date1,type1,debit,bal,bid) values ('$code','$date1','$type1','$qty1','$stocks','$bidd')");
           // $conn->query("update from pendtransfer where status='Received' and id=$_GET[txtdel]");
        }

        echo "<table id=customers>";
        echo "<th>Accept</th><th>Date</th><th>Product</th><th>Quantity</th><th>Branch From</th><th>Status</th>";
        $result=$conn->query("select * from pendtransfer where status1 like 'Pending' and bidd like '$bidd'");
        
        while($row=$result->fetch_assoc()){
       
            echo "<tr><td><a href=transrec.php?txtdel=$row[id]><img src=delete.png width=30></a><td>$row[date1]</td><td>$row[code]</td><td>$row[qty]</td><td>$row[bid]</td><td>$row[status1]</td></tr>";
        }
       echo "</table>";

       
       

       ?>

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
function product(){
        modal.style.display = "block";
        var txtid=document.getElementById("txtbranch").value;
        document.getElementById("mylink").innerHTML="<iframe src=transmodal.php?txtbranch="+txtid+" width=100% FrameBorder=1 height=200px></iframe>";
    }
function closeme(){
  document.getElementById("mylink").style.display="none";
  window.location="trans.php";
}
</script>
</body>

</html>