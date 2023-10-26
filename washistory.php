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




$counter=0;
 $count=0;
$type="Wastages";
              
        echo "<table id=customers>";

        echo "<th>Product</th><th>Total</th>";
       // $result=$conn->query("select * from product where flddesc like '%$_GET[txtsearch]%' and bid like'$_GET[txtbranch]'");    
        $result=$conn->query("select code,sum(credit) as total from prodhis where type1 like '$type' and bid like '$_GET[txtbranch]' and date1 between '$_GET[txtdate]' and '$_GET[txtdate1]' group by code order by code");   

        while($row=$result->fetch_assoc()){ 
            
            echo "<tr><td>$row[code]</td><td>$row[total]</td></tr>";
         
          }
          echo "</table>";

?>
<script>

  
</script>

</body>

</html>