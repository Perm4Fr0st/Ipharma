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
</hdead>
<body>
                                <form method=get action=sample.php>
                      

                                <input type=hidden name=txtedit value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
                               
                                </form>
<?php



              
echo "<table id=customers>";
        echo "<br>";
        echo "<th>Product Code</th><th>Description</th><th>Type</th><th>Quantity</th>";
$counter=0;
$count=0;

        $result=$conn->query("select * from Product");    
           
        while($row=$result->fetch_assoc()){
              $count++;
             echo "<tr><td>$row[code]</td><td>$row[flddesc]</td><td>$row[type]</td><td><input type=text id=$count size=3 value=$row[stocks] onfocusout=show($row[id],$count);></td></tr>";
           
          }
          echo "</table>";

?>
<script>


  function show(myid,count) {

  var a;
  a=document.getElementById(count).value;

  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById(count).value=this.responseText;
      
    }
  }
  xmlhttp.open("GET","save.php?txtin=" + a +"&txtedit="+myid ,true);
  xmlhttp.send();
 
}

  
</script>

</body>

</html>