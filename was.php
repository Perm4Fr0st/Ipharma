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


$myproduct="";
$stocks="";
$branch="";
$conn=mysqli_connect($servername, $username, $password, $dbase);
$result=$conn->query("select * from stocks where id like '$_SESSION[txtcode1]'");
while($row = $result->fetch_assoc()){
    $myproduct=$row["pid"];
    $branch=$row["bid"];
}

?>


<?php
            include("connect.php");
                    $date="";
                    $reason="";
                    
                    $reason="";
                    $qty="";
                    
                    $mysave1="save";
            if (isset($_GET["txtedit"])){
                if ($_GET["txtedit"]!=""){
                    $result=$conn->query("select * from wastages where id=$_GET[txtedit]");
                    while($row=$result->fetch_assoc()){
                        $date=$row["date1"];
                        $reason=$row["reason"];
                        $myproduct=$row["code"];
                        $qty=$row["branch"];
                        $branch=$row["bid"];
                        $mysave1="update";
                    }
                }
            }
        ?>

<table>
        <form action=was.php method=get>
          <h2>PULL-OUT</h2>
            
            <tr><td>Product:</td><td><input type=hidden name=txtcode1 id="txtcode1" value='<?php echo $_SESSION["txtcode1"];?>'><input type=text value='<?php echo $myproduct;?>' readonly><a href=# onclick="product()" >Search</a></td>
            </tr>
            <tr><td>Branch:</td><td><input type=text name=txtbranch id=txtbranch value='<?php echo $branch;?>'readonly></td></tr>
            <tr><td>Quantity:</td><td><input type=text name=txtqty id=txtqty value='<?php echo $qty;?>'></td></tr>
            <tr><td>Reason:</td><td><input type=text name=txtreason id=txtreason value='<?php echo $reason;?>'></td></tr>
            <tr><td>Date:</td><td><input type=date name=txtdate id=txtdate value='<?php echo $date;?>'></td></tr>
            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?> onclick=showme()>
            </td></tr>
        </table>
        </form>
        <?php
            if (isset($_GET["txtedit"])){
                if($_GET["txtedit"]!=""){
                    echo "<a href=was.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txtedit"])){
            if ($_GET["txtedit"]==""){
                $conn->query("insert into wastages (date1,reason,code,qty,bid) values ('$_GET[txtdate]','$_GET[txtreason]','$myproduct','$_GET[txtqty]','$_GET[txtbranch]')");
            }
            else{
                if (isset($_GET["txtreason"])){
                    
                $conn->query("update wastages set date1='$_GET[txtdate]',reason='$_GET[txtreason]',code='$_GET[txtcod1]',qty='$_GET[txtqty]',bid='$_GET[txtbranch]' where id=$_GET[txtedit]");
                header("Refresh:0; url=was.php");
               
                }
            }
        }
        
        if (isset($_GET["txtdel"])){
            $conn->query("delete from wastages where id=$_GET[txtdel]");
        }

        echo "<table id=customers>";
        echo "<th>Delete/Edit</th><th>Date</th><th>Reason</th><th>Product</th><th>Quantity</th><th>Branch</th>";
        $result=$conn->query("select * from wastages");
        
        while($row=$result->fetch_assoc()){
            $branch=str_replace(' ', '%20', $branch);
            echo "<tr><td><a href=was.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=was.php?txtedit=$row[id]><img src=edit.png width=20></a></td><td>$row[date1]</td><td>$row[reason]</td><td>$row[code]</td><td>$row[qty]</td><td>$row[bid]</td></tr>";
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
        //document.getElementById("myproduct").style.display="block";
        modal.style.display = "block";
        var txtid=document.getElementById("txtbranch").value;
        document.getElementById("mylink").innerHTML="<iframe src=wasmodal.php?txtbranch="+txtid+" width=100% FrameBorder=1 height=200px></iframe>";
    }
function closeme(){
  document.getElementById("mylink").style.display="none";
  window.location="was.php";
}
function showme(){
  var qty=document.getElementById("txtqty").value;
  var branch=document.getElementById("txtbranch").value;
  var code1=document.getElementById("txtcode1").value;
  var date=document.getElementById("txtdate").value;
  //alert(code1);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  if(this.readyState == 4 && this.status == 200){
  //document.getElementById("customers").innerHTML = this.responseText;
}
};

xmlhttp.open("GET", "wasupdate.php?txtqty="+qty+"&txtbranch="+branch+"&txtcode1="+code1+"&txtdate="+date, true);
xmlhttp.send();
}
</script>
</body>

</html>