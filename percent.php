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
                    $type="";
                    $percent="";
                    $mysave1="save";
            if (isset($_GET["txtedit"])){
                if ($_GET["txtedit"]!=""){
                    $result=$conn->query("select * from percent where id=$_GET[txtedit]");
                    while($row=$result->fetch_assoc()){
                        $type=$row["type1"];
                        $percent=$row["percent"];
                        $mysave1="update";
                    }
                }
            }
        ?>

<table>
        <form action=percent.php method=get>
            <tr><td>Type:</td><td><input type=text name=txttype value='<?php echo $type;?>'></td></tr>
            <tr><td>Percent:</td><td><input type=text name=txtpercent value='<?php echo $percent;?>'></td></tr>
            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?>>
            
            </td></tr>
        </table>
        </form>
        <?php
            if (isset($_GET["txtedit"])){
                if($_GET["txtedit"]!=""){
                    echo "<a href=percent.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txtedit"])){
            if ($_GET["txtedit"]==""){
                $conn->query("insert into percent (type1,percent) values ('$_GET[txttype]','$_GET[txtpercent]')");
            }
            else{
                if (isset($_GET["txttype"])){
                    
                $conn->query("update percent set type1='$_GET[txttype]',percent='$_GET[txtpercent]' where id=$_GET[txtedit]");
                header("Refresh:0; url=percent.php");
               
                }
            }
        }
        
        if (isset($_GET["txtdel"])){
            $conn->query("delete from percent where id=$_GET[txtdel]");
        }

        echo "<table id=customers>";
        echo "<th>Delete/Edit</th><th>Type</th><th>Percent</th>";
        $result=$conn->query("select * from percent");
        
        while($row=$result->fetch_assoc()){
            $type=str_replace(' ', '%20', $type);
            echo "<tr><td><a href=percent.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=percent.php?txtedit=$row[id]><img src=edit.png width=20></a></td><td>$row[type1]</td><td>$row[percent]</td></tr>";
        }
       echo "</table>";

       
       

       ?>




</body>

</html>