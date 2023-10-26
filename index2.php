<?php


include("connect.php");
 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

     <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Make the display compatible with phones -->

	<!-- Bootstrap and JQuery -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	  


	<script src="main.js"></script> <!-- main Javascript file -->
<style>
.center {   
    position: absolute;
       
        padding: 10px;   
        background-color: white;  
        width: 300px;
        height: 320px;
        text-align: center;
        margin: auto;
        top: -50px;
        bottom: 0;
        left: 0;
        right: 0;

    }  
</style>
</head>
<body style="background-color:powderblue;">
    
   <div class="center"> <!-- used by bootstrap -->
		
		<div>
        <h2>Login</h2>
        <form method=post action=verify.php>
           
            
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="txtuser" size="15" maxlength="15" placeholder="Enter Username" required>
                
            </div>    
            <div class="form-group">
                <label>Password:</label>
                <span class="form-group"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                <input type="password" name="txtpass" id="password1" size="15" maxlength="15" placeholder="Enter Password" required>
                
            </div>

            
            <input type="checkbox" onclick="myFunction()">Show Password
            <br>
            <input type="checkbox" onclick="rem()">Remember me
            <br><br>
           

     
        <tr><td colspan=2 align=right><input type=submit value=login></td></tr>
         
        <?php
        session_start();
        $_SESSION["user"]="";
        session_unset();
        session_destroy();
        session_write_close();
        
        ?>
</form>
             
      

        
        </div>
    </div>
</body>

</html>