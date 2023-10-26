<?php
session_start();
if(isset($_SESSION["user"])==false){
    header("location:index.php");
}

?>
<html>
    <body>
        <table border=1 width=100% height=100% >
            <tr><th>Date</th><th>Type</th><th>Code</th><th>Branch</th><th>Bill</th><th>Payment</th><th>Balance</th></tr>
        <?php
        include("connect.php");
        $result=$conn->query("select * from users where userid like '$_SESSION[user]'");
while($row = $result->fetch_assoc()){
 $name=$row["name"];
 $branch=$row["branch"];

}
        if(isset($_GET["txtid"])){
            $result=$conn->query("select * from company where id like '$_GET[txtid]'");
            while($row=$result->fetch_assoc()){    
                $myname=$row["comname"];;
                $myid=$row["id"];
            }
        }
        if(isset($_GET["txtsamount"])){
            $conn->query("insert into tblsales (flddate,fldcode,fldamount,cid) values ('$_GET[txtsdate]','$_GET[txtscode]',$_GET[txtsamount],$_GET[txtlid])");
            $balance=$_GET["txtsamount"];
            $result=$conn->query("select * from tblledger where cid like '$_GET[txtlid]' and branch like '$_GET[txtbranch]' order by id desc limit 1");
            while($row=$result->fetch_assoc()){
                $balance+=$row["fldbalance"];
            }    
            $conn->query("insert into tblledger (flddate,fldcode,fldtype,fldbill,fldbalance,cid,branch,cdate,cn,an,bank,cbranch) values ('$_GET[txtsdate]','Sales No: $_GET[txtscode]','Sales',$_GET[txtsamount],$balance,$_GET[txtlid],$_GET[txtbranch])");
            header("location:supledg.php?txtid=".$_GET["txtlid"]);
        }
        elseif(isset($_GET["txtpamount"])){
            
            $result=$conn->query("select * from tblledger where cid like '$_GET[txtlname]' and branch like '$branch' order by id desc limit 1");
            while($row=$result->fetch_assoc()){
                $zero=$row["fldbalance"];
                $a = 0;
                if($zero <= $a){
                   // echo "<script>alert('$zero')</script>";
                    echo '<script>alert("You Are Fully Paid")</script>';
                    //header("location:supledg.php?txtid=".$_GET["txtpid"]);  
                    //Exit();
                    header("Refresh:0; url=supledg.php");
                }else{
                    $conn->query("insert into tblpayment (flddate,fldcode,fldamount,cid) values ('$_GET[txtpdate]','$_GET[txtpcode]',$_GET[txtpamount],$_GET[txtpid])");
                    $balance=$_GET["txtpamount"];
                    $balance=$row["fldbalance"]-$balance;
                    
                    $conn->query("insert into tblledger (flddate,fldcode,fldtype,fldpayment,fldbalance,cid,branch) values ('$_GET[txtpdate]','OR no: $_GET[txtpcode]','Payment',$_GET[txtpamount],$balance,'$_GET[txtlname]','$branch')");
                   /// $conn->query("insert into tblledger (flddate,fldcode,fldtype,fldpayment,fldbalance,cid,branch,cdate,cn,an,bank,cbranch) values ('$_GET[txtpdate]','OR no: $_GET[txtpcode]','Payment',$_GET[txtpamount],$balance,'$_GET[txtlname]','$branch','$_GET[txtcdate]','$_GET[txtcn]','$_GET[txtan]','$_GET[txtbank]','$_GET[txttbranch]')");
                   
                    header("location:supledg.php?txtid=".$_GET["txtpid"]);
                }
                
            } 
              
           // $conn->query("insert into tblledger (flddate,fldcode,fldtype,fldpayment,fldbalance,cid,branch,cdate,cn,an,bank,cbranch) values ('$_GET[txtpdate]','OR no: $_GET[txtpcode]','Payment',$_GET[txtpamount],$balance,'$_GET[txtlname]','$branch','$_GET[txtcdate]','$_GET[txtcn]','$_GET[txtan]','$_GET[txtbank]','$_GET[txttbranch]')");
           
        }
        elseif(isset($_GET["txtid"])){
 
            $result=$conn->query("select * from tblledger where cid like '$myname' and branch like '$branch' order by id desc");
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                echo "<td>$row[flddate]</td>";
                echo "<td>$row[fldtype]</td>";
                echo "<td>$row[fldcode]</td>";
                echo "<td>$row[branch]</td>";
                echo "<td>$row[fldbill]</td>";
                echo "<td>$row[fldpayment]</td>";
                echo "<td>$row[fldbalance]</td>";
                echo "</tr>";
            }
        
        }
        ?>
        </table>
           
            
    </body>
</html>