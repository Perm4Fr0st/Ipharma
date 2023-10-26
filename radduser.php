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
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "dbpharma";
?>


<?php
            include("connect.php");
                    $uid="";
                    $pass="";
                    $name="";
                    $branch="Select Branch";
                    $type="Select Type";
                    $mysave1="save";
            if (isset($_GET["txtedit"])){
                if ($_GET["txtedit"]!=""){
                    $result=$conn->query("select * from users where id=$_GET[txtedit]");
                    while($row=$result->fetch_assoc()){
                        $uid=$row["userid"];
                        $pass=$row["pass"];
                        $name=$row["name"];
                        $branch=$row["branch"];
                        $type=$row["type"];
                        $mysave1="update";
                    }
                }
            }
        ?>

<table>
        <form action=radduser.php method=get>
            <tr><td>User ID:</td><td><input type=text name=txtuid value='<?php echo $uid;?>'></td></tr>
            <tr><td>Password:</td><td><input type=text name=txtpass value='<?php echo $pass;?>'></td></tr>
            <tr><td>Name:</td><td><input type=text name=txtname value='<?php echo $name;?>'></td></tr>
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
            <tr><td>Type:</td><td>
                <select size=1 name=txttype value=<?php echo $type;?>>
                    <option>Admin</option>
                    <option>Cashier</option>
                    <?php
                    echo "<option selected>$type</option>";
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
                    echo "<a href=radduser.php><button>Add New</button></a>";
                }
            }
            ?>
        <?php
    
        if(isset($_GET["txtedit"])){
            if ($_GET["txtedit"]==""){
                $conn->query("insert into users (userid,pass,name,branch,type) values ('$_GET[txtuid]','$_GET[txtpass]','$_GET[txtname]','$_GET[txtbranch]','$_GET[txttype]')");
                
            }
            else{
                if (isset($_GET["txtuid"])){
                $conn->query("update users set userid='$_GET[txtuid]',pass='$_GET[txtpass]',name='$_GET[txtname]',branch='$_GET[txtbranch]',type='$_GET[txttype]' where id=$_GET[txtedit]");
                header("Refresh:0; url=radduser.php");
                }
            }
        }
        
        if (isset($_GET["txtdel"])){
            $conn->query("delete from users where id=$_GET[txtdel]");
        }

        echo "<table id=customers>";
        echo "<th>Delete/Edit</th><th>User ID</th><th>Name</th><th>Branch</th><th>type</th>";
        $result=$conn->query("select * from users");
        
        while($row=$result->fetch_assoc()){
            $name=str_replace(' ', '%20', $name);
            echo "<tr><td><a href=radduser.php?txtdel=$row[id]><img src=delete.png width=30></a><a href=radduser.php?txtedit=$row[id]><img src=edit.png width=20></a></td><td>$row[userid]</td><td>$row[name]</td><td>$row[branch]</td><td>$row[type]</td></tr>";
        }
       echo "</table>";

       
       

       ?>




</body>

</html>