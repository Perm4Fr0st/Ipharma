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
        echo "<br>";
        echo "<th>Product Code</th><th>Description</th><th>Type</th><th>Quantity</th>";
       // $result=$conn->query("select * from product where flddesc like '%$_GET[txtsearch]%' and bid like'$_GET[txtbranch]'");    
        $result=$conn->query("select stocks.stocks as st,stocks.id as sid,product.id, product.code,product.flddesc,product.type,stocks.pid,stocks.bid
        from product,stocks
        where product.id=stocks.id and stocks.bid like'$_GET[txtbranch]' and stocks.pid=product.code and product.code like '%$_GET[txtsearch]%'");   

        while($row=$result->fetch_assoc()){ 
            $count++;  
            echo "<tr><td>$row[code]</td><td>$row[flddesc]</td><td>$row[type]</td><td><input type=text id=$count size=3 value=$row[st] onfocusout=shows($row[sid],$count);></td></tr>";
         
          }
          echo "</table>";

?>
<script>

  
</script>

</body>

</html>