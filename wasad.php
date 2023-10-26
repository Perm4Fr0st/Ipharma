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
$conn=mysqli_connect($servername, $username, $password, $dbase);
$result=$conn->query("select * from stocks where id like '$_SESSION[txtcode1]'");
while($row = $result->fetch_assoc()){
    $myproduct=$row["pid"];
   
}
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
    $branch=$row["branch"];
}
$result=$conn->query("select * from tbldate where id like '$_SESSION[txtid]'");
while($row = $result->fetch_assoc()){
    $idate=$row["flddate"];
    $dateid=$row["id"];
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
                        $qty=$row["qty"];
                        $branch=$row["bid"];
                        $mysave1="update";
                    }
                }
            }
        ?>

<table>
        <form action=wasad.php method=get>
          <h2>Pull-Out</h2>
            
            <tr><td>Product:</td><td><input type=hidden name=txtcode1 id="txtcode1" value='<?php echo $_SESSION["txtcode1"];?>'><input type=text value='<?php echo $myproduct;?>' readonly><a href=# onclick="product()" >Search</a></td>
            </tr>
            <tr><td>Branch:</td><td><input type=text name=txtbranch id=txtbranch value='<?php echo $branch;?>'readonly></td></tr>
            <tr><td> Receipt No:</td><td><input type=text name=txtpcode readonly value=
                        <?php
                            $var = 1;
                            $result=$conn->query("select * from pullout order by id desc limit 1");
                            while($row=$result->fetch_assoc()){
                                $var=$row["id"]+1;
                            }
                            echo sprintf('%08d', $var);
                        ?>
                        ></td></tr>

            <tr><td>Quantity:</td><td><input type=text name=txtqty id=txtqty value='<?php echo $qty;?>'></td></tr>
            <tr><td>Reason:</td><td><input type=text name=txtreason id=txtreason value='<?php echo $reason;?>'></td></tr>
            <tr><td>Date Requested:</td><td><input type=text name=txtdate id=txtdate value='<?php echo $idate;?>'readonly></td></tr>
            <tr><td>Date To Be Pull-Out:</td><td><input type=date name=txtdate1 id=txtdate1 ></td></tr>
            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?> onclick=showme()>
            </td></tr>
        </table>
        </form>
        <?php
            if (isset($_GET["txtedit"])){
                if($_GET["txtedit"]!=""){
                    echo "<a href=wasad.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txtedit"])){
            if ($_GET["txtedit"]==""){
                $conn->query("insert into pullout (date1,date2,reason,code,qty,bid) values ('$_GET[txtdate]','$_GET[txtdate1]','$_GET[txtreason]','$myproduct','$_GET[txtqty]','$_GET[txtbranch]')");
           
                $idmy=$myproduct;
                $qty1=$_GET["txtqty"];
                $branchh=$branch;
                $date2=$_GET["txtdate"];

  $info = array();
  $counter=0;
  $result=$conn->query("select * from pullout where code like '$idmy' and bid like '$branchh'");
  while($row = $result->fetch_assoc()){
     $counter++;
      $info[$counter][1]=$row["date1"];
      $info[$counter][2]=$row["reason"];
      $info[$counter][3]=$row["code"];
      $info[$counter][4]=$row["qty"];
      $info[$counter][5]=$row["bid"];
  }


  $a=0;
  $code=0;

  for($a=1;$a<=$counter;$a++){
    $date1=0;
    $reas=0;
    $stocks=0;
    $qty2=0;
    $bid=0;

      $date1=$info[$a][1];
      $reas=$info[$a][2];
      $code=$info[$a][3];
      $qty2=$info[$a][4];
      $bid=$info[$a][5];
 $result=$conn->query("select * from prodhis where code like '$code' and bid like '$bid' order by id desc limit 1");
      while($row=$result->fetch_assoc()){
      $stocks=$row["bal"];             
      }
      
      
      
      

    }
    $stocks=$stocks - $qty1;
      $type1="Pullout";
      $conn->query("update stocks set stocks=$stocks where pid like '$code' and bid like '$bid'");  
      $conn->query("insert into prodhis (code,date1,type1,credit,bal,bid) values ('$code','$date2','$type1','$qty2','$stocks','$bid')");
   


                header("Refresh:0; url=wasad.php");
           
              }
            else{
                if (isset($_GET["txtreason"])){
                    
                $conn->query("update pullout set date1='$_GET[txtdate]',reason='$_GET[txtreason]',code='$_GET[txtcod1]',qty='$_GET[txtqty]',bid='$_GET[txtbranch]' where id=$_GET[txtedit]");
                header("Refresh:0; url=wasad.php");
               
                }
            }
        }
        
        if (isset($_GET["txtdel"])){


$result=$conn->query("select * from pullout where id=$_GET[txtdel]");
while($row = $result->fetch_assoc()){
    $myid=$row["code"];
    $qty=$row["qty"];
    $branchh=$row["bid"];
}

          
$info = array();
$counter=0;
$result=$conn->query("select * from pullout where code like '$myid' and bid like '$branchh'");
while($row = $result->fetch_assoc()){
 $counter++;
  $info[$counter][1]=$row["date1"];
  $info[$counter][2]=$row["reason"];
  $info[$counter][3]=$row["code"];
  $info[$counter][4]=$row["qty"];
  $info[$counter][5]=$row["bid"];
}


$a=0;
$date1=0;
$reas=0;
for($a=1;$a<=$counter;$a++){

$stocks=0;
$debit=0;
$code=0;
$bid=0;
  $date1=$info[$a][1];
  $reas=$info[$a][2];
  $code=$info[$a][3];
  $debit=$info[$a][4];
  $bid=$info[$a][5];
$result=$conn->query("select * from prodhis where code like '$code' and bid like '$bid' order by id desc limit 1");
  while($row=$result->fetch_assoc()){
  $stocks=$row["bal"];             
  }

}
$stocks=$stocks + $qty;
  $type1="PullOut Mistake";
  $conn->query("update stocks set stocks=$stocks where pid like '$code' and bid like '$bid'");  
  $conn->query("insert into prodhis (code,date1,type1,debit,bal,bid) values ('$code','$date1','$type1','$debit','$stocks','$bid')");

           $conn->query("delete from pullout where id=$_GET[txtdel]");
            header("Refresh:0; url=wasad.php");
        }

        echo "<table id=customers>";
        echo "<th>Delete</th><th>Date Requested</th><th>Date To Be PullOut</th><th>Reason</th><th>Product</th><th>Quantity</th><th>Branch</th>";
        $result=$conn->query("select * from pullout where date1 like '$idate' and bid like '$branch'");
        
        while($row=$result->fetch_assoc()){
            $branch=str_replace(' ', '%20', $branch);
            echo "<tr><td><a href=wasad.php?txtdel=$row[id]><img src=delete.png width=30></a></td><td>$row[date1]</td><td>$row[date2]</td><td>$row[reason]</td><td>$row[code]</td><td>$row[qty]</td><td>$row[bid]</td></tr>";
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
        document.getElementById("mylink").innerHTML="<iframe src=wasmodaladmin.php?txtbranch="+txtid+" width=100% FrameBorder=1 height=200px></iframe>";
    }
function closeme(){
  document.getElementById("mylink").style.display="none";
  window.location="wasad.php";
}

</script>
</body>

</html>