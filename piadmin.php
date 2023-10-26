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
<h2>Physical Inventory</h2>
<?php
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];
 $branch=$row["branch"];

}

?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbase = "dbpharma";

$date="";
$status="Select Status";
$mysave2="Generate";  

if (isset($_GET["txtedit"])){
    if ($_GET["txtedit"]!=""){
        $result=$conn->query("select * from pi where id=$_GET[txtedit]");
        while($row=$result->fetch_assoc()){
            $date=$row["date"];
            $status=$row["status"];
            $branch=$row["bid"];
            $mysave1="update";
        }
    }
}


?>



<form action=piadmin.php method=get>
  <table>
            <tr><td>Date:</td><td><input type=date name=txtdate value='<?php echo $date;?>'></td></tr>
            <tr><td>Status:</td><td>
                <select size=1 name=txtstatus value=<?php echo $status;?>> 
                    <option>Posted</option>
                    <option>Pending</option>
                    <?php
                    echo "<option selected>$status</option>";
                    ?>
                </select>
                </td></tr>
            <tr><td></td><td><input type=hidden name=txtbranch value='<?php echo $branch;?>'readonly></td></tr>
            
            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave2;?>></td></tr> 
            <tr><td align=right colspan=2><button type="button" onclick=pdf()> History</button></td></tr>
            
        </table>
        </form><br><br>

        

                            <?php
                            if(isset($_GET["txtedit"])){
                                if ($_GET["txtedit"]==""){
                                    $conn->query("insert into pi (date,status,bid) values ('$_GET[txtdate]','$_GET[txtstatus]','$_GET[txtbranch]')"); 
                                    header("Refresh:0; url=piadmin.php");
                                }
                                else{
                                    if (isset($_GET["txtdate"])){
                                    $conn->query("update pi set date='$_GET[txtdate]',status='$_GET[txtstatus]' where id=$_GET[txtedit]");
                                    header("Refresh:0; url=piadmin.php");
                                    }
                                }
                                
                            }
                            if (isset($_GET["txtdel"])){
                                $conn->query("delete from pi where id=$_GET[txtdel]");
                                header("Refresh:0; url=piadmin.php");
                            }

                            ?>
                            <?php
                            if (isset($_GET["txtedit"])){
                                if($_GET["txtedit"]!=""){
                                    echo "<a href=piadmin.php><button>Add New</button></a>";
                                }
                            }
                            ?>


                                <?php
                                echo "<table id=customers>";
                                echo "<th>Delete/Edit</th><th>Entry</th><th>Date</th><th>Status</th><th>Branch</th>";
                                $result=$conn->query("select * from pi where bid like '$branch'");
                                while($row=$result->fetch_assoc()){
                                   
                                    echo "<tr><td><a href=piadmin.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=piadmin.php?txtedit=$row[id]><img src=edit.png width=20></a></td><td><a href=# onclick=showme($row[id])>Generate</a></td><td>$row[date]</td><td>$row[status]</td><td>$row[bid]</td></tr>";
                                }
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

 <!-- The Modal -->
 <div id="myModal1" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="closeme()">&times;</span>
	<p id=mylink1></p>
  </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var modal1 = document.getElementById("myModal1");
     function showme(txtprno){
      modal.style.display = "block";
    document.getElementById("mylink").innerHTML="<iframe src=pimodal.php?txtprno="+txtprno+" width=100% FrameBorder=1 height=360px></iframe>";
    }
    function closeme(){
        document.getElementById("mylink").style.display="none";
        document.getElementById("mylink1").style.display="none";
        window.location="piadmin.php";
    }
    
    function pdf(){
      modal1.style.display = "block";
    document.getElementById("mylink1").innerHTML="<iframe src=pipdf.php? width=100% FrameBorder=1 height=500px></iframe>";

    }
</script>

</body>

</html>