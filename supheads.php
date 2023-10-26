<?php
$result=$conn->query("select * from admin where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];


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
      <h1 class="logo">Pharma<span>cy</span></h1>
      <ul>
        <li><a href="main.php">Home</a></li>
        
        <li><a href="#">Register <i class="fas fa-caret-down"></i></a>

          <div class="dropdown-menu">
              <ul>
            <li><a id="u">User</a></li>
            <li><a id="b">Branch</a></li>
            <li><a id="company">Company</a></li>
              </ul>
            </div>
      </li>
        <li><a href="#">Inventory<i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                <li><a id="per">Type/Percent</a></li>
                <li><a href="product.php" target="frame">Product</a></li>
    <!--<a href="pi.php">Physical Inventory</a>-->
    <li><a href="phyhistory.php"  target="frame">Pysical Inventory</a></li>
    <!--<li><a href="del.php"  target="frame">Delivery</a></li>-->
   
    
                </ul>
              </div>
        </li>
        <li><a href="#">Reports<i class="fas fa-caret-down"></i></a>

          <div class="dropdown-menu">
              <ul>
              <li><a href="salesrepadmin.php" target="frame">Sales Report</a></li>
              <li><a href="hiswas.php" target="frame">Pull-Out History</a></li>
              <li> <a href="wastageshis.php" target="frame">Wastages History</a></li>
              <li><a href="transhisadmin.php" target="frame">Transfer History</a></li>
             <!-- <li><a href="supledg.php" target="frame">Supplier Ledger</a></li>-->
              <li><a href="suphis.php"  target="frame">Supplier History</a></li>
              <li><a href="bpsearch.php"  target="frame">Branch Product</a></li>
              <li><a href="his.php"  target="frame">History</a></li>
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
      <li><a id="logout">Logout</a></li>
      </ul>


    </div>

    <div class="hero">
      &nbsp;<br>
      <iframe name="frame" class="framez" ></iframe>
    </div>
    
  </body>
</html>
