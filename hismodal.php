<?php


include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    

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

<h2>History</h2>

        <table>
    
             <?php
session_start();
$pic="";


   if(isset($_SESSION["txttprno"])==false){
       $_SESSION["txttprno"]="";
   }
   if(isset($_GET["txttprno"])){
       $_SESSION["txttprno"]=$_GET["txttprno"];
   }

             $result=$conn->query("select * from prodhis where id like '$_SESSION[txttprno]'");
             while($row = $result->fetch_assoc()){
              $pic=$row["code"];
              $branch=$row["bid"];
             }
              

  

            

        ?>
                                <form method=get action=hismodal.php>
                                
                                <tr><td>Code:</td><td><input type=hidden name=txttprno id="txttprno" value='<?php echo $_SESSION["txttprno"];?>'><input type=text value='<?php echo $pic;?>' readonly></td>
                               

                               <input type=hidden name=txtorderid value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
                               
                               <input type=hidden name=txtbranch id=txtbranch value='<?php echo $branch;?>'readonly>
                          
                                </form>
                                
                               
                              </table>
                              
                              
        
          
        <?php
       
    


     
              echo "<table id=customers>";
              echo "<br>";
              echo "<th>Date</th><th>type</th><th>debit</th><th>Credit</th><th>Balance</th>";
              $result=$conn->query("select * from prodhis where code like '$pic' and bid like '$branch'");  
              while($row=$result->fetch_assoc()){ 
                  
                echo "<tr><td>$row[date1]</td><td>$row[type1]</td><td>$row[debit]</td><td>$row[credit]</td><td>$row[bal]</td></tr>";
                  
              }
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

  xmlhttp.open("GET", "search.php?txtsearch="+search+"&txtpic="+pic, true);
  xmlhttp.send();
  
}
function shows(myid,count) {

var count;
count=document.getElementById(count).value;
var prno;
prno=document.getElementById("txtprno").value;
var a;
a=document.getElementById("txtdate").value;
//alert(prno);
//alert(a);
var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById(count).value=this.responseText;
      
    }
  }
  xmlhttp.open("GET","save.php?txtin=" + count +"&txtedit="+myid +"&txtprno="+prno +"&txtdate="+a ,true);
  xmlhttp.send();
 
}


</script>
         

     
        

</body>

</html>