<?php
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];
 $branch=$row["branch"];

}

?>
<html lang="en">
  <head>
 
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="tab.css" />
    <style>
        .framez {
    width: 1200px;
    height: 500px;
    border: 3px solid gray;
    float: center;
    margin-left: 150px;
    margin-right: 10px;
  }
    </style>
  </head>
  <body>
    <div class="menu-bar">
    <h1 class="logo"><span>i</span>Pharma</h1>
      <ul>
        <li><a href="sales.php">Home</a></li>
        <li><a href="saless.php" target="frame">Cashier</a></li>
    

          
      </li>
      <li><a href="#">Reports<i class="fas fa-caret-down"></i></a>

<div class="dropdown-menu">
    <ul>
   <!-- <li><a href="salesrep.php" target="frame">Sales Report</a></li>-->
    <li><a href="cashrep.php" target="frame">Cashier Report</a></li>
    </ul>
  </div>
</li>
      <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?></a>
                        
                    </li>
                    <li>  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php  echo $name; ?><b class="caret"></b></a></li>
      <li><a href="logout.php">Logout</a></li>
      </ul>


    </div>

    <div class="hero">
      &nbsp;<br>
      <iframe name="frame" class="framez" ></iframe>
    </div>
    
  </body>
</html>
