<!DOCTYPE HTML>
<html>
<head>
<title></title>
     <style>

     html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }
	   body {
            display: table;
        }

        .my-block {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
     </style>
	 <script>
function showPic(str) {
    if (str == "") {
        document.getElementById("mypic").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("mypic").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getpic.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<?php
include_once("functions.php");
//print_r($_POST);
$error="";
if(count($_POST)>0 && isset($_POST['submit'])){
if(strlen($_POST['fname'])>0 && strlen($_POST['passwd'])>0 ){
$username = $_POST['fname'];
$password = md5($_POST['passwd']);
$picfile = $_POST['picture'];
$conn = db();

		$result = $conn->query("select * from user where username='".$username."'");

		if($result->num_rows>0){
		
			$error="username already used, please give a new username";
		
		}
		else {
			$sql = "insert into user(username, password, picfile) values('$username','$password', '$picfile')";
			$conn->query($sql);
			session_start();
            $_SESSION['username'] =$username;
			header("Location: welcome.php");
			exit();			
		}
		
}
else {

 $error = "please fill the form";

}
}



?>





		
</head>
<body>
<div class="my-block">
<h3> Register </h3>
</br>

<form action="register.php"  method="POST">
  
  User Name:<input type="text" name="fname"><br><br>
  Password :<input type="password" name="passwd"><br><br>
  <select name="picture" onchange="showPic(this.value)">
  <option>select a picture</option> 
  <option style="background-color: blue" value="boat1.png">boat</option>
  <option style="background-color: green" value="arms.png">arms</option>
  </select>
  </br>
 
  <div id="mypic"></div>
  </br>
  <input type="submit" name = "submit" value="submit" />
 
</form>
</br>
<font color="red">
<?php echo $error; ?>
</font>
</div>

  
</body>
</html>
