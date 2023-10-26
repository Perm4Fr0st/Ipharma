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
                    $branch="";
                    $status="Select Status";
                    $mysave1="save";
            if (isset($_GET["txtedit"])){
                if ($_GET["txtedit"]!=""){
                    $result=$conn->query("select * from branch where id=$_GET[txtedit]");
                    while($row=$result->fetch_assoc()){
                        $branch=$row["branch"];
                        $status=$row["status"];
                        $mysave1="update";
                    }
                }
            }
        ?>

<table>
        <form action=addbranch.php method=get>
            <tr><td>Branch:</td><td><input type=text name=txtbranch value='<?php echo $branch;?>'></td></tr>
            <tr><td>Status:</td><td>
                <select size=1 name=txtstatus value=<?php echo $status;?>>
                    <option>Active</option>
                    <option>Inactive</option>
                    <?php
                    echo "<option selected>$status</option>";
                    ?>
                </select>
            </tr>
            <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
            <tr><td align=right colspan=2><input type=submit value=<?php echo $mysave1;?>>
            
            </td></tr>
        </table>
        </form>
        <?php
            if (isset($_GET["txtedit"])){
                if($_GET["txtedit"]!=""){
                    echo "<a href=addbranch.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txtedit"])){
            if ($_GET["txtedit"]==""){
                $conn->query("insert into branch (branch,status) values ('$_GET[txtbranch]','$_GET[txtstatus]')");
            }
            else{
                if (isset($_GET["txtbranch"])){
                    
                $conn->query("update branch set branch='$_GET[txtbranch]',status='$_GET[txtstatus]' where id=$_GET[txtedit]");
                header("Refresh:0; url=addbranch.php");
               
                }
            }
        }
        
        if (isset($_GET["txtdel"])){
            $conn->query("delete from branch where id=$_GET[txtdel]");
        }

        echo "<table id=customers>";
        echo "<th>Delete/Edit</th><th>Branch</th><th>Status</th>";
        $result=$conn->query("select * from branch");
        
        while($row=$result->fetch_assoc()){
            $branch=str_replace(' ', '%20', $branch);
            echo "<tr><td><a href=addbranch.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=addbranch.php?txtedit=$row[id]><img src=edit.png width=20></a></td><td>$row[branch]</td><td>$row[status]</td></tr>";
        }
       echo "</table>";

       
       

       ?>




</body>

</html>