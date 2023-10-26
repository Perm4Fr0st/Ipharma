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
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
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
  width: 90%;
  height: 90%;
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
<body>

<h2>History</h2>









<form action=his.php method=get>
           
        </form>




              
        <td>Search:<input type=text id="txtsearch" placeholder="Description" onkeyup="show()"></td>
<?php
 echo "<table id=customers>";
 echo "<br><br>";
 echo "<th>Product Code</th><th>branch</th>";

   echo "</table>";
?>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="closeme()">&times;</span>
	<p id=mylink></p>
  </div>
</div>

<script>
function show(pic) {

var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  if(this.readyState == 4 && this.status == 200){
  document.getElementById("customers").innerHTML = this.responseText;
}
};
var search;
search=document.getElementById("txtsearch").value;

xmlhttp.open("GET", "search1.php?txtsearch="+search+"&txtpic="+pic, true);
xmlhttp.send();

}


    var modal = document.getElementById("myModal");
function showme(txtid){
  //var pics = document.getElementById();
    modal.style.display = "block";
    document.getElementById("mylink").innerHTML="<iframe src=hismodal.php?txttprno="+txtid+" width=100% FrameBorder=1 height=500px></iframe>";
  //alert(txtid);  
  }
    function closeme(){
        document.getElementById("mylink").style.display="none";
        window.location="his.php";
    }
</script>

</body>

</html>