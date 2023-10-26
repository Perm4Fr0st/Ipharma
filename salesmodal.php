<?php
session_start();
if(isset($_SESSION["user"])==false){
    header("location:index.php");
}
?>
<?php
include("connect.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    

     <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Make the display compatible with phones -->

	
	  




    <style>

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
    <center>
<h2>Payment</h2>
</center>
        <table>
            
             <?php





   $result=$conn->query("select sum(amount) as total from salestoday");
   while($row = $result->fetch_assoc()){
      $totalam=$row["total"];
   }
  
            

        ?>
                                <form method=get action=salesmodal.php>
                                <input type=hidden id=txtname value='<?php echo $name;?>'>
                                <tr><td>Total Amount:</td><td><input type=hidden name=txtam id="txttam" value='<?php echo $_SESSION["txtam"];?>'><input type=text id=txtid value='<?php echo $totalam;?>' readonly></td></tr>
                               <tr><td><br><br></td></tr>
                                <tr><td>Cash:</td><td><input type=text id=cash onfocusout=showme();></td></tr>
                                <tr><td><br><br></td></tr>
                                <tr><td>Change:</td><td><input type=text id=txtchange readonly></td></tr>
                                
                               <input type=hidden name=txtorderid value=<?php if (isset($_GET["txtedit"])){echo $_GET["txtedit"];} ?>>
                               

                          
                                </form>
                                
                               
                              </table>
                              <br><br>
                              <button type=button onclick=pros() style="float: right;">Proceed</button>
                              <button type=button onclick=print() style="float: right;">Print</button>
                              
        
    
                       




         

     
  <script>
    function showme(){

        var a;
        a=document.getElementById("txtid").value;
        var b;
        b=document.getElementById("cash").value;
        var c=b-a;
        document.getElementById("txtchange").value=c;
        }
    function print(){
        window.open('resibo.php','popUpWindow','height=500,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        
    }
    function pros(){
        var a;
        a=document.getElementById("txtid").value;
        var b;
        b=document.getElementById("cash").value;
        var c=b-a;
        var name=document.getElementById("txtname").value;
      if (confirm("Proceed?") == true) {  
         window.open("saless.php?txta="+a+"&txtb="+b+"&txtc="+c+"&txtname="+name, "_parent");

} else {
 alert("You Cancelled");
}

    }
  </script>      

</body>

</html>