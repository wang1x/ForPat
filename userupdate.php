<?php

session_start();
if(isset($_SESSION['username'])){
?>
<html>
<a href="userDisplay.php"> View All Users </a>
</br>
<a href="logout.php"> Log out </a>
</br>
</br>

<form aciton="userupdate.php"  method="POST">
  
  User Name:<input type="text" name="updatename"><br><br>
  Password :<input type="password" name="updatepasswd"><br><br>
  <select name="picture" onchange="showPic(this.value)">
  <option>select a picture</option> 
 <option style="background-color: blue" value="boat1.png">boat</option>
  <option style="background-color: green" value="arms.png">arms</option>
  </select>
  </br>
  <input type="submit" value="update" name="update"/>
 
  
 
</form>


<?php

if(isset($_POST['update'])){
//echo print_r($_POST);
echo "<br>";
echo $_POST['updatename'];
$servername="localhost";
$username="root";
$password="password";
$mydb="mydb";

$conn = new mysqli($servername,$username,$password,$mydb);
if($conn->connect_error){
 die("connection failed".$conn->connect_error);
}

$sql="update user set username = '".$_POST['updatename']. "', password='". md5($_POST['updatepasswd']) ."', picfile='".$_POST['picture']."' where id=".$_GET['item'];

if ($conn->query($sql) === TRUE) {
     $_SESSION['username'] = $_POST['updatename'];
    echo "Record update successfully";
} else {
    echo "Error update record: " . $conn->error;
}

$conn->close();
}
}

else {
 header("Location: login.php");
}
?>
</html>
