<?php
session_start();
if(isset($_SESSION["user"])==false){
    header("location:index.php");
}

include("connect.php");
include("heads.php");

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: lightblue;}



/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


.modal1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal1-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close1 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close1:hover,
.close1:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


.modal2 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal2-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close2 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close2:hover,
.close2:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal3 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal3-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close3 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close3:hover,
.close3:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


.modal4 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal4-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close4 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close4:hover,
.close4:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


.modal5 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal5-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close5 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close5:hover,
.close5:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


.modal6 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal6-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close6 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close6:hover,
.close6:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal7 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal7-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close7 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close7:hover,
.close7:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal8 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal8-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  height: 500px;
  overflow-y: scroll;
}

/* The Close Button */
.close8 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close8:hover,
.close78:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
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

<input type=hidden id=txtbranch value='<?php echo $branch;?>'>



<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <p id=mylink1></p>
</div>

</div>

<div id="myModal1" class="modal1">

<!-- Modal content -->
<div class="modal-content">
  <span class="close1">&times;</span>
  <p id=mylink2></p>
</div>

</div>

<div id="myModal2" class="modal2">

<!-- Modal content -->
<div class="modal-content">
  <span class="close2">&times;</span>
  <p id=mylink3></p>
</div>

</div>

<div id="myModal3" class="modal3">

<!-- Modal content -->
<div class="modal-content">
  <span class="close3">&times;</span>
  <p id=mylink4></p>
</div>

</div>

<div id="myModal4" class="modal4">

<!-- Modal content -->
<div class="modal-content">
  <span class="close4">&times;</span>
  <p id=mylink5></p>
</div>

</div>



<div id="myModal5" class="modal5">

<!-- Modal content -->
<div class="modal-content">
  <span class="close5">&times;</span>
  <p id=mylink6></p>
</div>
</div>

<div id="myModal6" class="modal6">

<!-- Modal content -->
<div class="modal-content">
  <span class="close6">&times;</span>
  <p id=mylink7></p>
</div>
</div>

<div id="myModal7" class="modal7">

<!-- Modal content -->
<div class="modal-content">
  <span class="close7">&times;</span>
  <p id=mylink8></p>
</div>
</div>

<div id="myModal8" class="modal8">

<!-- Modal content -->
<div class="modal-content">
  <span class="close8">&times;</span>
  <p id=mylink9></p>
</div>
</div>
<script>
var u = document.getElementById('u');
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
u.style.cursor = 'pointer';
u.onclick = function(myid) {
    modal.style.display = "block";
    document.getElementById("mylink1").innerHTML="<iframe src=radduseradmin.php?txtprno="+myid+" width=100% FrameBorder=1 height=380px></iframe>";
};

span.onclick = function() {
  modal.style.display = "none";
  location.reload();
}

// When the user clicks anywhere outside of the modal, close it
//window.onclick = function(event) {
 // if (event.target == modal) {
 //   modal.style.display = "none";
   // location.reload();
 // }
//}






var per = document.getElementById('per');
var modal2 = document.getElementById("myModal2");
var span = document.getElementsByClassName("close2")[0];
per.style.cursor = 'pointer';
per.onclick = function(myiddd) {
    modal2.style.display = "block";
    document.getElementById("mylink3").innerHTML="<iframe src=percent.php?txtprnoo="+myiddd+" width=100% FrameBorder=1 height=380px></iframe>";
};

span.onclick = function() {
  modal2.style.display = "none";
  location.reload();
}





var logout = document.getElementById('logout');
logout.style.cursor = 'pointer';
logout.onclick = function() {
window.location.href = "logout.php"; 
};

var op = document.getElementById('op');
var modal5 = document.getElementById("myModal5");
var span = document.getElementsByClassName("close5")[0];
var branch = document.getElementById("txtbranch").value;
op.style.cursor = 'pointer';
op.onclick = function(myop) {
    modal5.style.display = "block";
    document.getElementById("mylink6").innerHTML="<iframe src=befwasad.php?txtbranch="+branch+" width=100% FrameBorder=1 height=380px></iframe>";
};

span.onclick = function() {
  modal5.style.display = "none";
  location.reload();
}

var was = document.getElementById('was');
var modal6 = document.getElementById("myModal6");
var span = document.getElementsByClassName("close6")[0];
var branch = document.getElementById("txtbranch").value;
was.style.cursor = 'pointer';
was.onclick = function(mywas) {
    modal6.style.display = "block";
    document.getElementById("mylink7").innerHTML="<iframe src=befwastages.php?txtbranch="+branch+" width=100% FrameBorder=1 height=380px></iframe>";
};

span.onclick = function() {
  modal6.style.display = "none";
  location.reload();
}

var st = document.getElementById('st');
var modal7 = document.getElementById("myModal7");
var span = document.getElementsByClassName("close7")[0];
var branch = document.getElementById("txtbranch").value;
st.style.cursor = 'pointer';
st.onclick = function(mytr) {
    modal7.style.display = "block";
    document.getElementById("mylink8").innerHTML="<iframe src=beftrans.php?txtst="+mytr+" width=100% FrameBorder=1 height=380px></iframe>";
};

span.onclick = function() {
  modal7.style.display = "none";
  location.reload();
}

var tr = document.getElementById('tr');
var modal8 = document.getElementById("myModal8");
var span = document.getElementsByClassName("close8")[0];
var branch = document.getElementById("txtbranch").value;
tr.style.cursor = 'pointer';
tr.onclick = function(mytrr) {
    modal8.style.display = "block";
    document.getElementById("mylink9").innerHTML="<iframe src=transrec.php?txtst="+mytrr+" width=100% FrameBorder=1 height=380px></iframe>";
};

span.onclick = function() {
  modal8.style.display = "none";
  location.reload();
}


</script>
</body>

</html>