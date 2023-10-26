<?php
session_start();
if(isset($_SESSION["user"])==false){
    header("location:index.php");
}

?>
<html>
    <body>

        <form method=get action=supledg.php>
          <!--  Name <input type=text name=txtname><input type=submit value=Save>-->
        </form>

        <?php
        include("connect.php");
        $servername = "localhost";
$username = "root";
$password = "";
$dbase = "dbpharma";
$result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];
 $branch=$row["branch"];

}
$Today=date('y:m:d');
$new=date('d m, Y',strtotime($Today));
//echo $new; 

        $myname="";
        $myid=0;
        if(isset($_GET["txtname"])){
            $conn->query("insert into company (comname) values ('$_GET[txtname]')");
            header("location:supledg.php");
        }elseif(isset($_GET["txtid"])){
            $result=$conn->query("select * from company where id like '$_GET[txtid]'");
            while($row=$result->fetch_assoc()){    
                $myname=$row["comname"];;
                $myid=$row["id"];
            }
        }
        $result=$conn->query("select * from company order by comname");
        while($row=$result->fetch_assoc()){
            echo "<br></a><input type=button value='$row[comname]' id=$row[id] onclick=display($row[id])>";
        }
        ?>
        
        <div style="border:1px solid brown; height:600px; width:800px;position:absolute; top: 10px;right:100px">
        <center><h2>Supplier Payment</h2></center>
            <form method=get action=supledger.php>
               
                <input type=text size=115 id=txtlname name=txtlname value='<?php echo $myname;?>'  readonly>
                <input type=hidden size=115 id=txtpid name=txtpid value='<?php echo $myid;?>' readonly>

                <div style="border:1px solid brown; height:160px; width:800px;position:relative;background-color:powderblue">
                
                    <table>
                   <tr><td>Date:</td> <td><input type=date name=txtpdate value="<?php echo date('Y-m-d'); ?>"></td><td>Check Date:</td> <td><input type=date name=txtcdate onchange="show()"></td></tr>
                   <tr><td>Receipt No:</td> <td><input type=text name=txtpcode readonly value=
                        <?php
                            $var = 1;
                            $result=$conn->query("select * from tblpayment order by id desc limit 1");
                            while($row=$result->fetch_assoc()){
                                $var=$row["id"]+1;
                            }
                            echo sprintf('%08d', $var);
                        ?>
                        ></td><td>Check No.:</td> <td><input type=text disabled="true" id=txtcn name=txtcn ></td></tr><br>
                        <tr><td>Amount:</td> <td><input type=text name=txtpamount></td><td>Account No.:</td> <td><input type=text disabled="true" id=txtan name=txtan></td></tr>
                       <tr><td></td><td></td>
                        <td>Bank:</td><td><input type=text disabled="true" id=txtbank name=txtbank></td></tr>
                        <tr><td><input type=submit value=Add></td><td></td><td>Branch:</td> <td><input type=text disabled="true" id=txttbranch name=txttbranch></td></tr>
                         <tr></tr>
                </div>
                
                </table>  
                <br> 
                </form>    
                
            
            

            <?php
            if(isset($_GET["txtid"])){
                echo "<iframe width=100% height=100%  src=supledger.php?txtid=$_GET[txtid]></iframe>";
               // echo '<meta http-equiv="REFRESH" content="2 ; url=supledger.php" target="frame">';
            }
            ?>
            
        </div>
            
    <script>
        function display(myid){
           
            //window.open("supledg.php?txtid="+myid,"_parent");
            window.location="supledg.php?txtid="+myid,"_parent";

        }
    function show(){
        //alert("aw");
        document.getElementById("txtcn").disabled = false;
        document.getElementById("txtan").disabled = false;
        document.getElementById("txtbank").disabled = false;
        document.getElementById("txttbranch").disabled = false;
        }
    </script>
    </body>
</html>