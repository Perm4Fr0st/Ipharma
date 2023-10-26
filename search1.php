<?php
include("connect.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
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






              
        echo "<table id=customers>";
        
        echo "<th>Product Code</th><th>Branch</th>";
        $result=$conn->query("select * from prodhis where code like '%$_GET[txtsearch]%'group by bid order by id");   
        //$result=$conn->query("SELECT DISTINCT code FROM prodhis WHERE code like '%$_GET[txtsearch]%'");   
        while($row=$result->fetch_assoc()){ 

            echo "<tr><td><a href=# onclick=showme($row[id])>$row[code]</a></td><td>$row[bid]</td></tr>";
              
          }
          echo "</table>";

?>
<script>

  
</script>

</body>

</html>