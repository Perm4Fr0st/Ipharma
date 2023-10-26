<?php
    include("connect.php");

    $result=$conn->query("select * from users where userid like '$_POST[txtuser]'");
      while($row = $result->fetch_assoc()){
       $type=$row["type"];

      }
      $result=$conn->query("select * from admin where userid like '$_POST[txtuser]'");
      while($row = $result->fetch_assoc()){
       $type1=$row["type"];

      }

    $result=$conn->query("select * from users where userid like '$_POST[txtuser]' and pass like '$_POST[txtpass]' ");
    if($result->num_rows > 0){
        if($type == "Admin"){
            session_start();
            $_SESSION["user"]=$_POST["txtuser"];
           echo $_SESSION["user"];
           
           header ("location:mainadmin.php");
     
         
        }
        elseif($type == "Cashier"){
            session_start();
            $_SESSION["user"]=$_POST["txtuser"];
           echo $_SESSION["user"];
           
           header ("location:sales.php");
        }
        
}
else{
    // echo '<script>alert("Incorrect username or password. please try again.")</script>';
     //header("refresh: 0; url = index.php");
     $result1=$conn->query("select * from admin where userid like '$_POST[txtuser]' and pass like '$_POST[txtpass]' ");
     //header("location:index.php");
     if($result1->num_rows > 0){
         if($type1 == "supadmin"){
             session_start();
             $_SESSION["user"]=$_POST["txtuser"];
            echo $_SESSION["user"];
            
            header ("location:main.php");
      
          
         }
        }

else{
        echo '<script>alert("Incorrect username or password. please try again.")</script>';
        //header("url = index.php");       
      //  echo("<script>alert('file successful deleted!')</script>");
        echo("<script>window.location = 'index.php';</script>");        
            }
        }         
        
    
?>
