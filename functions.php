<?php
function db(){
$servername="localhost";
$username="root";
$password="12345";
$mydb="cms";
$conn = new mysqli($servername,$username,$password,$mydb);
if($conn->connect_error){
 die("connection failed".$conn->connect_error);
}
return $conn;
}


?>
