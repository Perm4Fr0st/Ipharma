<?php


include("connect.php");
 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">


     <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Make the display compatible with phones -->


	  


	<script src="main.js"></script> <!-- main Javascript file -->

    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="csss/all.min.css">
    <link rel="stylesheet" href="csss/style.css">
    <title>Login</title>

</head>
<body >
<div class="container">
        <div class="box">
            <h1>Login</h1>
            <form method=post action=verify.php>
                <label>Username</label>
                <div>
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="txtuser" size="15" maxlength="15" placeholder="Enter Username">
                </div>
                <label>Password</label>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="txtpass" id="password1" size="15" maxlength="15" placeholder="Enter Password">
                </div>
                
                <input type="submit" value="Login">
            </form>
    
            <?php
        session_start();
        $_SESSION["user"]="";
        session_unset();
        session_destroy();
        session_write_close();
        
        ?>
        </div>
    </div>
         
      

</body>

</html>