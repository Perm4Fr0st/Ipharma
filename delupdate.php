


<?php

include("connect.php");
if(isset($_GET["txtid"])){
    if(isset($_GET["txttotal"])){

$conn->query("update product set stocks='$_GET[txttotal]' where id=$_GET[txtid]");
  

}
}


    
    ?>