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



/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 50px; /* Location of the box */
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
  height: 500px;
  overflow-y: scroll;
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
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];
 $branch=$row["branch"];

}


?>

<?php
            include("connect.php");
                    $code="";
                    $desc="";
                    $type="Select Type";
                    $capital="";
                    $interest="";
                    $status="";
                    $price="";

                    $mysave1="save";
            if (isset($_GET["txtedit"])){
                if ($_GET["txtedit"]!=""){
                    $result=$conn->query("select * from product where id=$_GET[txtedit]");
                    while($row=$result->fetch_assoc()){
                        $code=$row["code"];
                        $desc=$row["flddesc"];
                        $type=$row["type"];
                        $capital=$row["capital"];
                        $interest=$row["interest"];
                        $status=$row["status"];
                        $price=$row["price"];

                        $mysave1="update";
                    }
                }
            }
        ?>

<table>
        <form action=productadmin.php method=get>
            <tr><td>Code:</td><td><input type=text name=txtcode value='<?php echo $code;?>'></td></tr>
            <tr><td>Description:</td><td><input type=text name=txtdesc value='<?php echo $desc;?>'></td></tr>
            <tr><td>Type:</td><td>
                                <select name="txttype" id="txttype" onchange="shows()">
                                <?php
                                $conn = mysqli_connect($servername, $username, $password, $dbase);
                                $query = "select type1 from percent";
                                $result1 = mysqli_query($conn, $query);
                               
                                while($row = mysqli_fetch_array($result1)):;
                                
                                ?>
                                <option value="<?php echo $row['type1'];?>"><?php echo $row['type1'];?></option>
                               
                                <?php endwhile;?>
                                <?php
                    echo "<option selected>$type</option>";
                    ?>
                                </select>  
        </tr>
            <tr><td>Capital:</td><td><input type=text name=txtcapital id=txtcapital onfocusout=show(); value='<?php echo $capital;?>'></td></tr>
            <tr><td>Interest:</td><td><input type=text name=txtinterest id=txtinterest value='<?php echo $interest;?>' readonly></td></tr>
            <tr><td>Status:</td><td>
                <select size=1 name=txtstatus value=<?php echo $status;?>>
                    <option>Active</option>
                    <option>Inactive</option>
                    <?php
                    echo "<option selected>$status</option>";
                    ?>
                </select></tr>
            <tr><td>Price:</td><td><input type=text name=txtprice id=txtprice value='<?php echo $price;?>' readonly></td></tr>
            <input type=hidden name=txtbranch id=txtbranch value='<?php echo $branch;?>'>

            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?>>
            <a href="mainadmin.php">Back</a>
            <a href="#" onclick=showprint();>print</a>
            </td></tr>

        </table>
        </form>
        <?php
            if (isset($_GET["txtedit"])){
                if($_GET["txtedit"]!=""){
                    echo "<a href=productadmin.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txtedit"])){

            if ($_GET["txtedit"]==""){
                $conn->query("insert into product (code,flddesc,type,capital,interest,status,price,bid) values ('$_GET[txtcode]','$_GET[txtdesc]','$_GET[txttype]','$_GET[txtcapital]','$_GET[txtinterest]','$_GET[txtstatus]','$_GET[txtprice]','$_GET[txtbranch]')");
                $conn->query("insert into stocks (pid,bid) values ('$_GET[txtcode]','$_GET[txtbranch]')");

               

            }
            else{
                if (isset($_GET["txtcode"])){   
                $conn->query("update product set code='$_GET[txtcode]',flddesc='$_GET[txtdesc]',type='$_GET[txttype]',capital='$_GET[txtcapital]',interest='$_GET[txtinterest]',status='$_GET[txtstatus]',price='$_GET[txtprice]',bid='$_GET[txtbranch]' where id=$_GET[txtedit]");
                $conn->query("update stocks set pid='$_GET[txtcode]' where id=$_GET[txtedit]");
              

                }
                
            }
            
        }
        
        if (isset($_GET["txtdel"])){
            $conn->query("delete from product where id=$_GET[txtdel]");
            $conn->query("delete from stocks where id=$_GET[txtdel]");
        }

        echo "<table id=customers>";
        echo "<th width=20%>Delete/Edit/History/Physical Inventory</th><th>Code</th><th>Description</th><th>Type</th><th>Capital</th><th>Interest</th><th>Status</th><th>Price</th>";
        $result=$conn->query("select * from product where bid like '$branch'");
        
        while($row=$result->fetch_assoc()){
            $desc=str_replace(' ', '%20', $desc);
            echo "<tr><td><a href=productadmin.php?txtdel=$row[id]><img src=delete.png width=40px></a><a href=productadmin.php?txtedit=$row[id]><img src=edit.png width=30px></a><a href=# onclick=showme($row[id]);><img src=history.png width=25px></a><a href=# onclick=showmee($row[id]);><img src=pi.png width=25px></a></td><td>$row[code]</td><td>$row[flddesc]</td><td>$row[type]</td><td>$row[capital]</td><td>$row[interest]</td><td>$row[status]</td><td>$row[price]</td></tr>";
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

<div id="myModal1" class="modal">

<!-- Modal content -->
<div class="modal-content">
<span class="close" onclick="closemee()">&times;</span>
  <p id=mylink1></p>
</div>

</div>




<script>
    function shows(){
        
        var type;
        type=document.getElementById("txttype").value;
        var cap;
        cap=document.getElementById("txtcapital").value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtinterest").value = this.responseText;
                
            }
        };
        xmlhttp.open("GET", "interest.php?txttype=" + type, true);
        xmlhttp.send();
       
       
         
        var price;
        price=document.getElementById("txtinterest").value;
        
       // alert("price");
      // document.getElementById("txtprice").value=price;
        
    
    }

    function show(){
        
        var price;
        price=document.getElementById("txtinterest").value;
        var cap;
        cap=document.getElementById("txtcapital").value;
       
        var price1;
        price1=(price/100)*cap;
        
        
       //alert(price1);
      document.getElementById("txtprice").value=price1;
        
    
    }


var modal = document.getElementById("myModal");
function showme(myid){  
     modal.style.display = "block";
    document.getElementById("mylink").innerHTML="<iframe src=hismodal.php?txttprno="+myid+" width=100% FrameBorder=1 height=380px></iframe>";
    }

function closeme(){
      document.getElementById("mylink").style.display="none";
      document.getElementById("mylink1").style.display="none";
      location.reload();
    }

 var modal1 = document.getElementById("myModal1");
function showmee(myidd){  
     modal1.style.display = "block";
    document.getElementById("mylink1").innerHTML="<iframe src=pi.php?txttprno="+myidd+" width=100% FrameBorder=1 height=450px></iframe>";
    }
    function closemee(){
      document.getElementById("mylink1").style.display="none";
      location.reload();
    }
    function showprint(){
      window.open('print.php');
    }
</script>

</body>

</html>