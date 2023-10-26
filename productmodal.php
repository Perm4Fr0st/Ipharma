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

<html>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbase="dbpharma";


        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbase);
        
        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $result=$conn->query("select * from stocks where bid like '$_GET[txtbranch]' order by pid");
        echo "<table id=customers>";
        echo "<th>Code</th>";
        while($row=$result->fetch_assoc()){
            
            echo "<tr><td><a href=delmodaladmin.php?txtcode1=$row[id] target=_parent>$row[pid]</td></tr>";
        }
        echo "</table>";
        ?>
    </body>
</html>