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

<h2>Physical Inventory</h2>

        <table>
            
             <?php
session_start();
$pic="";
$date="";
$mydr="";

   if(isset($_SESSION["txtprno"])==false){
       $_SESSION["txtprno"]="";
   }
   if(isset($_GET["txtprno"])){
       $_SESSION["txtprno"]=$_GET["txtprno"];
   }

             $result=$conn->query("select * from pi where id like '$_SESSION[txtprno]'");
             while($row = $result->fetch_assoc()){
              $pic=$row["id"];
              $date=$row["date"];
              $branch=$row["bid"];
             }
              
             $prod="";
             $quan="";
             $mysave1="save";
  

            

        ?>
                                <form method=get action=pimodal.php>
                                <tr><td>Physical Inventory Code:</td><td><input type=hidden name=txttprno id="txtprno" value='<?php echo $_SESSION["txtprno"];?>'><input type=text value='<?php echo $pic;?>' readonly></td>
                                <td>&nbsp;&nbsp;Date:</td><td><input type=hidden name=txtdate id="txtdate" value='<?php echo $date;?>'><input type=text value='<?php echo $date;?>' readonly></td>
                                <td>&nbsp;&nbsp;Branch:</td><td><input type=hidden name=txtbranch id="txtbranch" value='<?php echo $branch;?>'><input type=text value='<?php echo $branch;?>' readonly></td>
                               <input type=hidden name=txtorderid value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
                               
                                
                                <tr>
                                
                                <td align=middle colspan=9><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Search:<input type=text id="txtsearch" placeholder="Product Code" onkeyup="show()"></td>
                                <td><button onclick="print()">Print</button>
                          
                                </form>
                                
                               
                              </table>
                              
                              
        
          
        <?php
       
    


     
              echo "<table id=customers>";
              echo "<br>";
              echo "<th>Product Code</th><th>Description</th><th>Type</th><th>Quantity</th>";

                echo "</table>";

       
       

       ?>

                        </td>
                        </tr>
    
                        


<!-- The Modal -->
<div id="myprint" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="closeme()">&times;</span>
    <iframe src=print.php width=100% height=50%></iframe>
  </div>

</div>

<script>

    function closeme(){
      document.getElementById("myprint").style.display="none";
    }
    function print(){
        document.getElementById("myprint").style.display="block";
    }




function show(pic) {
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
  xmlhttp.open("GET", "search.php?txtsearch="+search+"&txtpic="+pic+"&txtbranch="+branch, true);
  xmlhttp.send();
}
function shows(myid,count) {

var count;
count=document.getElementById(count).value;
var prno;
prno=document.getElementById("txtprno").value;
var a;
a=document.getElementById("txtdate").value;
var branch;
branch=document.getElementById("txtbranch").value;
//alert(prno);
//alert(a);
var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById(count).value=this.responseText;
      
    }
  }
  xmlhttp.open("GET","save.php?txtin=" + count +"&txtedit="+myid +"&txtprno="+prno +"&txtdate="+a +"&txtbranch="+branch ,true);
  xmlhttp.send();
 
}


</script>
         

     
        

</body>

</html>