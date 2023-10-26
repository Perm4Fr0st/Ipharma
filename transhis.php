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

<h2>Transfer History</h2>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbase = "dbpharma";

$date="";
$date1="";

$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
  while($row = $result->fetch_assoc()){
   $name=$row["name"];
   $branch=$row["branch"];

  }


?>




            <tr><td>Date From:</td><td><input type=date name=txtdate id=txtdate onchange="showmee()" value='<?php echo $date;?>'></td></tr>
            <tr><td>Date To:</td><td><input type=date name=txtdate1 id=txtdate1 onchange="showmee()" value='<?php echo $date1;?>'></td></tr>
            <tr>Branch:<input type=text id=txtbranch value='<?php echo $branch;?>' readonly>
        </tr>

            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
           
            
            </td></tr>
        </table><br><br>
         
      


                                <?php
                                echo "<table id=customers>";
                                echo "<th>Product</th><th>total</th>";
                               
                               echo "</table>";
                                
                                ?>


<script>

    function showmee(){
        //alert("aw");
        var date=document.getElementById("txtdate").value;
        var date1=document.getElementById("txtdate1").value;
        var branch=document.getElementById("txtbranch").value;
        //alert(date);
            if(date == " "|| date == null || date == 0 || date1 == " "|| date1 == null || date1 == 0 || branch == " "|| branch == null || branch == 0 || branch == "Select Branch"){
                   // alert("date");
            }
            else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                if(this.readyState == 4 && this.status == 200){
                        document.getElementById("customers").innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("GET", "transhistory.php?txtdate="+date+"&txtdate1="+date1+"&txtbranch="+branch, true);
                xmlhttp.send();
            }
    }
</script>

</body>

</html>