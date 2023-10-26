<html>
    <body>
        <form method=get action=beftrans.php>
            Date: <input type=date name=txtname><input type=submit value=Save>
        </form>
        <?php
        include("connect.php");
        $myname="";
        $myid=0;
        if(isset($_GET["txtname"])){
            $conn->query("insert into tbldate (flddate) values ('$_GET[txtname]')");
            header("location:beftrans.php");
        }elseif(isset($_GET["txtdelid"])){
            $conn->query("delete from tbldate where id like '$_GET[txtdelid]'");
            header("location:beftrans.php");
        }elseif(isset($_GET["txtid"])){
            $result=$conn->query("select * from tbldate where id like '$_GET[txtid]'");
            while($row=$result->fetch_assoc()){    
                $myname=$row["flddate"];;
                $myid=$row["id"];
            }
        }

        echo "<table>";
        echo "<tr>";
        echo "<td>";

        echo "<table >";
     
        $result=$conn->query("select * from tbldate order by flddate");
        while($row=$result->fetch_assoc()){
            echo "<tr><td><a href=beftrans.php?txtdelid=$row[id]><input type=button value=x></a><input type=button value='$row[flddate]' id=$row[id] onclick=display($row[id])></td></tr>";
        }
        echo "</table>";
        echo "</td>";
        echo "<td>";
        echo "<table >";
       // $result=$conn->query("select * from branch order by branch");
       // while($row=$result->fetch_assoc()){
        //    echo "<tr><td><input type=button value='$row[branch]' id=$row[id] onclick=displayy($row[id])></td></tr>";
       // }
      
        echo "</table>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        ?>


            
<div style="border:1px solid brown; height:350px; width:900px;position:absolute; top: 10px;right:10px">
<?php
            if(isset($_GET["txtid"])){
                echo "<iframe width=100% height=100% src=trans.php?txtid=$_GET[txtid]></iframe>";
                //echo '<meta http-equiv="REFRESH" content="2 ; url=trans.php" target="frame">';
            }
            ?>
            
        </div>
            
    <script>
        function display(myid){
           // alert(myid);
          // iframe.contentDocument.location.href = "beftrans.php?txtid="+myid,"_parent";
      // window.open("beftrans.php?txtid="+myid,"_parent");
       window.location="beftrans.php?txtid="+myid,"_parent";
        }
        function displayy(myidd){
           // alert(myid);
          // iframe.contentDocument.location.href = "beftrans.php?txtid="+myid,"_parent";
      // window.open("beftrans.php?txtid="+myid,"_parent");
     //  window.location="beftrans.php?txtidd="+myidd,"_parent";
        }
        
    </script>
    </body>
</html>