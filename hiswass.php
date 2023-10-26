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
  //$date=$_GET["date"];
  $info = array();
  $type1 = "Pullout";
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
  echo "<th>Description</th>"; 
  for($a=1;$a<=$counter;$a++){
    $branch="";
      $branch=$info[$a];
      
      
      echo "<th>";
      
      echo "$branch";
      echo "</th>";

     
       }
       echo "<th>";
       echo "Total";
       echo "</th>";
       $code = array();
       $counter1=0;
       $result=$conn->query("select distinct(code) as code,flddesc as flddesc from product");
       while($row = $result->fetch_assoc()){
          $counter1++;
           $code[$counter1][1]=$row["code"];
           $code[$counter1][2]=$row["flddesc"];
        
       }
     
     
       $a=0;
      // echo "<tr><td>$counter1</td></tr>";
       for($b=1;$b<=$counter1;$b++){
//------------------------------------------------------
       
        for($i=1;$i<=$counter;$i++){


          $result=$conn->query("select sum(credit) as credit,date1 from prodhis where code like '".$code[$b][1]."' and bid like '".$info[$i]."'
          and type1 like '$type1' and date1 between '$_GET[txtdate]' and '$_GET[txtdate1]'");
          while($row=$result->fetch_assoc()){
            if($row["credit"]>0){
              echo "<tr><td>".$code[$b][1]."</td>";
              echo "<td>".$code[$b][2]."</td>";
            $code[$i][3]=$row["credit"];
            echo "<td>".number_format($row["credit"])."</td>";
            
            //echo "<td>".number_format($row["totals"])."</td>";
            $totals += round($row['credit'],2);
            echo "<td>".number_format($totals)."</td>";
           
          }
          
        }
      
      }
        echo "</tr>";
        
//--------------------------------------------------
/*
         $codes="";
           $codes=$code[1][$b];
           
           echo "<tr><td>$codes</td></tr>";  

       
            }

            $stock = array();
            $counter2=0;
            $result=$conn->query("select * from stocks");
            while($row = $result->fetch_assoc()){
               $counter2++;
                $stock[1][$counter2]=$row["stocks"];
                
          
            }
          
          
            $c=0;
             
            for($c=1;$c<=$counter2;$c++){
              $stocks="";
                $stocks=$stock[1][$c];
                
                echo "<tr><td>$stocks</td></tr>";  
               
                
                
               */
               
                 }
                 echo "<tr><td><td></tr>";
                 echo "<td></td>";
                 echo "<td></td>";
                 echo "<th>Grand Amount</th>";
                 echo "<td>".number_format($totals)."</td>";
        $totals = 0;
            echo "</table>";

           
?>
      
          
</body>

</html>