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
    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 10px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 10px;
  border: 0 solid #888;
  width: 90%;
  height: 90%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


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
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];
 $branch=$row["branch"];

}


?>



<br>
          



                                <?php
                                echo "<table id=customers>";
                                echo "<tr><th></th><th>Product Code</th><th>".$branch." Branch</th><th></th></tr>";
                                echo "<th  style='text-align:center'>Product Code</th><th style='text-align:center'>Current Stocks</th><th style='text-align:center'>SRP</th><th style='text-align:center'>Amount</th>   ";
                                $result=$conn->query("select product.code as name,stocks.stocks as stocks,product.price as price,stocks.stocks*product.price as total
                                from product,stocks
                                where product.code like stocks.pid and
                                product.id=stocks.id and
                                stocks.bid like '$branch'");
                                while($row=$result->fetch_assoc()){
                                   
                                    echo "<tr><td>$row[name]</td><td style='text-align:right'>".number_format($row["stocks"],2)."</td><td style='text-align:right'>".number_format($row["price"])."</td><td style='text-align:right'>".number_format($row["total"])."</td></tr>";
                                }
                               
                               echo "</table>";
                                echo "<br><br>";
                               echo "<table id=customers>";
                               echo "<th style='text-align:right' >Total Amount</th>   ";
                               $result=$conn->query("select product.code as name,stocks.stocks as stocks,product.price as price,sum(stocks.stocks*product.price) as totals
                               from product,stocks
                               where product.code like stocks.pid and
                               product.id=stocks.id and
                               stocks.bid like '$branch'");
                               while($row=$result->fetch_assoc()){
                                  
                                   echo "<tr><td  style='text-align:right'>".number_format($row["totals"],2)."</td></tr>";
                               }
                              
                              echo "</table>";
                                
                                ?>
 

</body>

</html>