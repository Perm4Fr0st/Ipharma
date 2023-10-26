<?php

include("connect.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    #customerss {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customerss td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customerss tr:nth-child(even){background-color: #f2f2f2;}

#customerss tr:hover {background-color: #ddd;}

#customerss th {
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
$type="Phyisical Inventory";
              
        echo "<table id=customerss>";

        echo "<th>Product</th><th>Description</th><th>Total</th>";
       // $result=$conn->query("select * from product where flddesc like '%$_GET[txtsearch]%' and bid like'$_GET[txtbranch]'");    
        $result=$conn->query("select distinct(prodhis.date1) as date,prodhis.code as code,prodhis.bal as bal,product.flddesc as flddesc
        from prodhis,product where prodhis.code=product.code and
        type1 like '$type' and prodhis.bid like '$_GET[txtbranch]' and date1 between '$_GET[txtdate]' and '$_GET[txtdate1]'");   

        while($row=$result->fetch_assoc()){ 
            
            echo "<tr><td>$row[code]</td><td>$row[flddesc]</td><td>$row[bal]</td></tr>";

          }
          echo "</table>";

 

?>
<script>

  
</script>

</body>

</html>