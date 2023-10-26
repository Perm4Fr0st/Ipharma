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
<a href="main.php">Back</a>
<h2>Supplier Delivery</h2>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbase = "dbpharma";

$date="";
$sup="Select Company";
$del="";
$delby="";
$branch="Select Branch";
$amount="";
$mysave1="Save";  
 
if (isset($_GET["txtedit"])){
    if ($_GET["txtedit"]!=""){
        $result=$conn->query("select * from tblsales where id=$_GET[txtedit]");
        while($row=$result->fetch_assoc()){
            $date=$row["flddate"];
            $sup=$row["cid"];
            $del=$row["fldcode"];
            $branch=$row["branch"];
            $delby=$row["delby"];
            $amount=$row["fldamount"];
            $mysave1="update";
        }
    }
}



?>



            <form action=supdel.php method=get>
              <table>
            <tr><td>Date:</td><td><input type=date name=txtdate value='<?php echo $date;?>'></td></tr>
            <tr><td>Supplier:</td><td>
                                <select name="txtsup" id="txtsup" onchange="selectClient()">
                                
                                <?php
                                $conn = mysqli_connect($servername, $username, $password, $dbase);
                                $query = "select comname from company";
                                $result1 = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($result1)):;
                                ?>
                                <option value="<?php echo $row['comname'];?>"><?php echo $row['comname'];?></option>

                                <?php endwhile;?>
                                <?php
                                   echo "<option selected>$sup</option>";
                                ?>
                                </select>  
        </tr>
        <tr><td>Delivery Receipt:</td><td><input type=text name=txtdel value='<?php echo $del;?>'></td></tr>

        <tr><td>Branch:</td><td>
                                <select name="txtbranch" id="txtbranch" onchange="selectClient()">
                                <?php
                                $conn = mysqli_connect($servername, $username, $password, $dbase);
                                $query = "select branch from branch";
                                $result1 = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($result1)):;
                                ?>
                                <option value="<?php echo $row['branch'];?>"><?php echo $row['branch'];?></option>

                                <?php endwhile;?>
                                <?php
                                echo "<option selected>$branch</option>";
                                  ?>
                                </select>  
        </tr>
        <tr><td>Delivered by:</td><td><input type=text name=txtdelby value='<?php echo $delby;?>'></td></tr>
        <tr><td>Amount:</td><td><input type=text name=txtamount value='<?php echo $amount;?>'></td></tr>

            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?>>
            
            </td></tr>
        </table><br><br>
         
        </form>

                            <?php
                            if(isset($_GET["txtedit"])){
                                if ($_GET["txtedit"]==""){
                                   $conn->query("insert into tblsales (flddate,fldamount,fldcode,cid,branch,delby) values ('$_GET[txtdate]','$_GET[txtamount]','$_GET[txtdel]','$_GET[txtsup]','$_GET[txtbranch]','$_GET[txtdelby]')");
                                   $balance=$_GET["txtamount"];
                        $result=$conn->query("select * from tblledger where cid like '$_GET[txtsup]' and branch like '$_GET[txtbranch]' order by id desc limit 1");
                        while($row=$result->fetch_assoc()){
                        $balance+=$row["fldbalance"];
                                }
                                   $conn->query("insert into tblledger (flddate,fldcode,fldtype,fldbill,fldbalance,cid,branch) values ('$_GET[txtdate]','Sales No: $_GET[txtdel]','Sales','$_GET[txtamount]','$balance','$_GET[txtsup]','$_GET[txtbranch]')"); 
                                   header("Refresh:0; url=supdel.php");
                                }
                                else{
                                    if (isset($_GET["txtdate"])){
                                    $conn->query("update tblsales set flddate='$_GET[txtdate]',fldamount='$_GET[txtamount]',fldcode='$_GET[txtdel]',cid='$_GET[txtsup]',branch='$_GET[txtbranch]',delby='$_GET[txtdelby]' where id=$_GET[txtedit]");
                                    header("Refresh:0; url=supdel.php");
                                    }
                                }
                                
                            }
                            if (isset($_GET["txtdel"])){
                                $conn->query("delete from tblsales where id=$_GET[txtdel]");
                                header("Refresh:0; url=supdel.php");
                            }

                            ?>
                            <?php
                            if (isset($_GET["txtedit"])){
                                if($_GET["txtedit"]!=""){
                                    echo "<a href=supdel.php><button>Add New</button></a>";
                                }
                            }
                            ?>


                                <?php
                                echo "<table id=customers>";
                                echo "<th>Delete/Edit</th><th>Date</th><th>Supplier</th><th>Delivery Receipt</th><th>Branch</th><th>Delivered By</th><th>Amount</th>";
                                $result=$conn->query("select * from tblsales");
                                while($row=$result->fetch_assoc()){
                                   
                                    echo "<tr><td><a href=supdel.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=supdel.php?txtedit=$row[id]><img src=edit.png width=20></a><a href=# onclick=showme($row[id])>ADD</a></td><td>$row[flddate]</td><td>$row[cid]</td><td>$row[fldcode]</td><td>$row[branch]</td><td>$row[delby]</td><td>$row[fldamount]</td></tr>";
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


<script>
    var modal = document.getElementById("myModal");
                         
 function showme(myid){
      //alert(myid);
     modal.style.display = "block";
    document.getElementById("mylink").innerHTML="<iframe src=supdelmodal.php?txtmyid="+myid+" width=100% FrameBorder=1 height=460px></iframe>";
    }
    function closeme(){
        document.getElementById("mylink").style.display="none";
        window.location="supdel.php";
    }
</script>

</body>

</html>