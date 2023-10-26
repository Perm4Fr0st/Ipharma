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

              
        echo "<table id=customers>";
        echo "<th>Product Code</th><th>Description</th><th>Type</th><th>stocks</th><th>Price</th>";
       // $result=$conn->query("select * from Product where bid like '$_GET[txtbranch]' and code like '%$_GET[txtsearch]%'");    
       $result=$conn->query("select stocks.stocks as st,stocks.id as sid,product.id, product.code,product.flddesc,product.type,product.price,stocks.pid,stocks.bid
       from product,stocks
       where product.id=stocks.id  and stocks.bid like'$_GET[txtbranch]' and stocks.pid=product.code and product.code like '%$_GET[txtsearch]%'");              
        while($row=$result->fetch_assoc()){ 
         
            echo "<tr><td><a href=# onclick=showme($row[id])>$row[code]</a></td><td>$row[flddesc]</td><td>$row[type]</td><td>$row[st]</td><td>$row[price]</td></tr>";
              
          }
          echo "</table>";

?>
<script>

</script>

</body>

</html>