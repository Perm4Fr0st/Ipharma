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
// Branch Table
echo "<table id=customers>";
$dates=$_GET["txtdate"];
  //$date=$_GET["date"];
  $info = array();
 
  $counter=0;
  $totals=0;
  $totalz=0;
  $result=$conn->query("select * from branch where branch like '$_GET[txtbranch]'");
  while($row = $result->fetch_assoc()){
     $counter++;
      $info[$counter]=$row["branch"];
      

  }


  $a=0;
  echo "<th>Product Code</th>"; 
  
  for($a=1;$a<=$counter;$a++){
    $branch="";
      $branch=$info[$a];
      
      
      

     
       }
      

       $code = array();
       $counter1=0;
       $result=$conn->query("select distinct(code) as code,flddesc as flddesc from product");
       while($row = $result->fetch_assoc()){
          $counter1++;
           $code[$counter1][1]=$row["code"];
           
        
       }
     echo "<th>Quantity</th>"; 
     echo "<th>Amount</th>"; 
       $a=0;
      // echo "<tr><td>$counter1</td></tr>";
       for($b=1;$b<=$counter1;$b++){
//------------------------------------------------------
        echo "<tr><td>".$code[$b][1]."</td>";
        for($i=1;$i<=$counter;$i++){


          $result=$conn->query("select sum(qty) as quantity,sum(amount) as amount,date1 from tblsalesreport where code like '".$code[$b][1]."' and bid like '$branch'
          and cashname like '$_GET[txtcashname]' and date1 like '$_GET[txtdate]' ");
          while($row=$result->fetch_assoc()){
            $code[$i][2]=$row["quantity"];
            echo "<td>".number_format($row["quantity"])."</td>";
            echo "<td>".number_format($row["amount"])."</td>";
            $totals += round($row['amount'],2);
          
           
          }
          
        }

        
        echo "</tr>";
               
                 }
                 echo "<td></td>";
                 echo "<th>Grand Amount</th>";
                 echo "<td>".number_format($totals)."</td>";
        $totals = 0;  
            echo "</table>";

           
?>
      
          
</body>

</html>