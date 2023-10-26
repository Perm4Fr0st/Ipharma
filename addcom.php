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



<?php
            include("connect.php");
                    $comname="";
                    $comadd="";
                    $conper="";
                    $condet="";
                    $note="";
                    $mysave1="save";
            if (isset($_GET["txtedit"])){
                if ($_GET["txtedit"]!=""){
                    $result=$conn->query("select * from company where id=$_GET[txtedit]");
                    while($row=$result->fetch_assoc()){
                        $comname=$row["comname"];
                        $comadd=$row["comadd"];
                        $conper=$row["conper"];
                        $condet=$row["condet"];
                        $note=$row["note"];
                        $mysave1="update";
                    }
                }
            }
        ?>

<table>
        <form action=addcom.php method=get>
            <tr><td>Company Name:</td><td><input type=text name=txtcomname value='<?php echo $comname;?>'></td></tr>
            <tr><td>Company Address:</td><td><input type=text name=txtcomadd value='<?php echo $comadd;?>'></td></tr>
            <tr><td>Contact Person:</td><td><input type=text name=txtconper value='<?php echo $conper;?>'></td></tr>
            <tr><td>Contact Details:</td><td><input type=text name=txtcondet value='<?php echo $condet;?>'></td></tr>
            <tr><td>Note:</td><td><input type=text name=txtnote value='<?php echo $note;?>'></td></tr>
            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?>>
            <button onclick=showprint();>Print</button>
            </td></tr>
        </table>
        </form>
        <?php
            if (isset($_GET["txtedit"])){
                if($_GET["txtedit"]!=""){
                    echo "<a href=addcom.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txtedit"])){
            if ($_GET["txtedit"]==""){
                $conn->query("insert into company (comname,comadd,conper,condet,note) values ('$_GET[txtcomname]','$_GET[txtcomadd]','$_GET[txtconper]','$_GET[txtcondet]','$_GET[txtnote]')");
            }
            else{
                if (isset($_GET["txtcomname"])){
                    
                $conn->query("update company set comname='$_GET[txtcomname]',comadd='$_GET[txtcomadd]',conper='$_GET[txtconper]',condet='$_GET[txtcondet]',note='$_GET[txtnote]' where id=$_GET[txtedit]");
                header("Refresh:0; url=addcom.php");
               
                }
            }
        }
        
        if (isset($_GET["txtdel"])){
            $conn->query("delete from company where id=$_GET[txtdel]");
        }

        echo "<table id=customers>";
        echo "<th>Delete/Edit</th><th>Company Name</th><th>Company Address</th><th>Contact Person</th><th>Contact Details</th><th>Note</th>";
        $result=$conn->query("select * from company");
        
        while($row=$result->fetch_assoc()){
            $comname=str_replace(' ', '%20', $comname);
            echo "<tr><td><a href=addcom.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=addcom.php?txtedit=$row[id]><img src=edit.png width=20></a></td><td>$row[comname]</td><td>$row[comadd]</td><td>$row[conper]</td><td>$row[condet]</td><td>$row[note]</td></tr>";
        }
       echo "</table>";

       
       

       ?>

<script>
    function showprint(){
      window.open('printcom.php');
    }
</script>


</body>

</html>