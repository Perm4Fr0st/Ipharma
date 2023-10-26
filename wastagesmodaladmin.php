<?php
session_start();
if(isset($_SESSION["user"])==false){
    header("location:index.php");
}

include("connect.php");
?>
<style>
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

<html>
    <body>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "dbpharma";
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
    $branch=$row["branch"];
}
?>

    <td>Search:<input type=text id="txtsearch" placeholder="Description" onkeyup="show()"></td>
    <td><input type=hidden id="txtbranch"value='<?php echo $branch;?>'readonly></td>
        <?php

        echo "<table id=customers>";
        echo "<br><br>";
        echo "<th>Product Code</th><th>Stocks</th>";
       
          echo "</table>";
 
        ?>

        <script>
  function show(){
var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  if(this.readyState == 4 && this.status == 200){
  document.getElementById("customers").innerHTML = this.responseText;
}
};
var search;
search=document.getElementById("txtsearch").value;
var branch;
branch=document.getElementById("txtbranch").value;

xmlhttp.open("GET", "wastagessearch.php?txtsearch="+search+"&txtbranch="+branch, true);
xmlhttp.send();
            
          }
          </script>
    </body>
</html>