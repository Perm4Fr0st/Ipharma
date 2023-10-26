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

<h2>Delivery</h2>
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
$com="Select Company";
$term="";
$delcode="";

$mysave1="Save";  
 
if (isset($_GET["txtedit"])){
    if ($_GET["txtedit"]!=""){
        $result=$conn->query("select * from delivery where id=$_GET[txtedit]");
        while($row=$result->fetch_assoc()){
            $date=$row["date1"];
            $com=$row["com"];
            $term=$row["term"];
            $delcode=$row["delcode"];

            $mysave1="update";
        }
    }
}



?>



            <form action=deladmin.php method=get>
              <table>
            <tr><td>Date:</td><td><input type=date name=txtdate value='<?php echo $date;?>'></td></tr>
            <tr><td>Company:</td><td>
                                <select name="txtcom" id="txtcom" onchange="selectClient()">
                                
                                <?php
                                $conn = mysqli_connect($servername, $username, $password, $dbase);
                                $query = "select comname from company";
                                $result1 = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($result1)):;
                                ?>
                                <option value="<?php echo $row['comname'];?>"><?php echo $row['comname'];?></option>

                                <?php endwhile;?>
                                <?php
                                   echo "<option selected>$com</option>";
                                ?>
                                </select>  
        </tr>
        <tr><td>Terms:</td><td><input type=text name=txtterm value='<?php echo $term;?>'></td></tr>
        <tr><td>Delivery Code:</td><td><input type=text name=txtdelcode value='<?php echo $delcode;?>'></td></tr>
        <tr><td></td><td><input type=hidden name=txtbranch value='<?php echo $branch;?>'readonly></td></tr>
        

            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?>>
            
            </td></tr>
        </table><br><br>
         
        </form>

                            <?php
                            if(isset($_GET["txtedit"])){
                                if ($_GET["txtedit"]==""){
                                    $conn->query("insert into delivery (date1,com,term,delcode,bid) values ('$_GET[txtdate]','$_GET[txtcom]','$_GET[txtterm]','$_GET[txtdelcode]','$_GET[txtbranch]')"); 
                                    
                                    header("Refresh:0; url=deladmin.php");
                                }
                                else{
                                    if (isset($_GET["txtdate"])){
                                    $conn->query("update delivery set date1='$_GET[txtdate]',com='$_GET[txtcom]',term='$_GET[txtterm]',delcode='$_GET[txtdelcode]' where id=$_GET[txtedit]");
                                    header("Refresh:0; url=deladmin.php");
                                    }
                                }
                                
                            }
                            if (isset($_GET["txtdel"])){
                                $conn->query("delete from delivery where id=$_GET[txtdel]");
                                header("Refresh:0; url=deladmin.php");
                            }

                            ?>
                            <?php
                            if (isset($_GET["txtedit"])){
                                if($_GET["txtedit"]!=""){
                                    echo "<a href=deladmin.php><button>Add New</button></a>";
                                }
                            }
                            ?>


                                <?php
                                echo "<table id=customers>";
                                echo "<th>Delete/Edit</th><th>Date</th><th>Company</th><th>Terms</th><th>Delivery Code</th><th>Branch</th><th>Amount</th>";
                                $result=$conn->query("select * from delivery where bid like '$branch'");
                                while($row=$result->fetch_assoc()){
                                   
                                    echo "<tr><td><a href=deladmin.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=deladmin.php?txtedit=$row[id]><img src=edit.png width=20></a><a href=# onclick=showme($row[id])>Buy</a></td><td>$row[date1]</td><td>$row[com]</td><td>$row[term]</td><td>$row[delcode]</td><td>$row[bid]</td><td>$row[amount]</td></tr>";
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
    document.getElementById("mylink").innerHTML="<iframe src=delmodal.php?txtmyid="+myid+" width=100% FrameBorder=1 height=460px></iframe>";
    }
    function closeme(){
        document.getElementById("mylink").style.display="none";
        window.location="deladmin.php";
    }
</script>

</body>

</html>