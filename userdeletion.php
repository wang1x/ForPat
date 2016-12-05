<?php
$servername="localhost";
$username="root";
$password="password";
$mydb="mydb";

$conn = new mysqli($servername,$username,$password,$mydb);
if($conn->connect_error){
 die("connection failed".$conn->connect_error);
}
$sql = "delete from user where id=". $_GET['item'];

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();



?>