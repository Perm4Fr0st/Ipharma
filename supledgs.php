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
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "dbpharma";
?>
<?php

if(isset($_SESSION["txtcode1"])==false){
    $_SESSION["txtcode1"]="";
}
if(isset($_GET["txtcode1"])){
    $_SESSION["txtcode1"]=$_GET["txtcode1"];
}
if(isset($_SESSION["txtid"])==false){
  $_SESSION["txtid"]="";
}
if(isset($_GET["txtid"])){
  $_SESSION["txtid"]=$_GET["txtid"];
}

$myproduct="";
$stocks="";
$branch="";
$branchh="";
$conn=mysqli_connect($servername, $username, $password, $dbase);
$result=$conn->query("select * from stocks where id like '$_SESSION[txtcode1]'");
while($row = $result->fetch_assoc()){
    $myproduct=$row["pid"];
    $branch=$row["bid"];
}
$result=$conn->query("select * from company where id like '$_GET[txtid]'");
while($row=$result->fetch_assoc()){    
    $myname=$row["comname"];;
    $myid=$row["id"];
}

?>

<table>


        <center><h2>Supplier Payment</h2></center>
            <form method=get action=supledger.php>
               
                <input type=text size=113 id=txtlname name=txtlname value='<?php echo $myname;?>'  readonly>
                <input type=hidden size=100 id=txtpid name=txtpid value='<?php echo $myid;?>' readonly>

                <div style="border:1px solid brown; height:50px; width:850px;position:relative;background-color:powderblue">
                
                    <table>
                   <tr><td>Date:</td> <td><input type=date name=txtpdate></td><td>Check Date:</td> <td><input type=date name=txtcdate onchange="show()"></td></tr>
                   <tr><td>Receipt No:</td> <td><input type=text name=txtpcode readonly value=
                        <?php
                            $var = 1;
                            $result=$conn->query("select * from tblpayment order by id desc limit 1");
                            while($row=$result->fetch_assoc()){
                                $var=$row["id"]+1;
                            }
                            echo sprintf('%08d', $var);
                        ?>
                        ></td><td>Check No.:</td> <td><input type=text disabled="true" id=txtcn name=txtcn></td></tr><br>
                        <tr><td>Amount:</td> <td><input type=text name=txtpamount></td><td>Account No.:</td> <td><input type=text disabled="true" id=txtan name=txtan></td></tr>
                       <tr><td></td><td></td>
                        <td>Bank:</td><td><input type=text disabled="true" id=txtbank name=txtbank></td></tr>
                        <tr><td><input type=submit value=Add></td><td></td><td>Branch:</td> <td><input type=text disabled="true" id=txttbranch name=txttbranch></td></tr>
                         <tr></tr>
                </div>
                
                </table>  
                <br> 
                </form>    


                <script>

    function show(){
        //alert("aw");
        document.getElementById("txtcn").disabled = false;
        document.getElementById("txtan").disabled = false;
        document.getElementById("txtbank").disabled = false;
        document.getElementById("txttbranch").disabled = false;
        }
    </script>
    </body>
</html>