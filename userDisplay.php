 <style style="text/css">
    .schoolTableHead{
     font-weight: bold;
     background: green;
   }

	.TFtable{
		width:100%; 
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		background: #b8d1f3;
	}
	/*  Define the background color for all the ODD background rows  */
	.TFtable tr:nth-child(odd){ 
		background: #b8d1f3;
	}
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #dae5f4;
	}
</style>
<a href="logout.php"> Log out </a>
</br>
</br>
<?php
include_once("functions.php");
session_start();
if(isset($_SESSION['username'])){

$servername="localhost";
$username="root";
$password="password";
$mydb="mydb";

$conn = new mysqli($servername,$username,$password,$mydb);
if($conn->connect_error){
 die("connection failed".$conn->connect_error);
}

$sql = "select * from user";
$result = $conn->query($sql);
echo "<table border=1 class='TFtable'>";
echo "<tr>
      <td>ID</td>
	  <td>User Name</td>
	  <td> Password</td>
	  <td>Background Pic</td>
	  <td> Update </td>
	  <td> Delete</a> </td>
	  </tr>";
if($result->num_rows>0){
while($row = $result->fetch_assoc()){
echo "<tr>
      <td>".$row['id']."</td>
	  <td>".$row['username']."</td>
	  <td>" .md5($row['password'])."</td>
	  <td>".$row['picfile']."</td>
	  <td> <a href='userupdate.php?item=".$row['id']."'>Update </td>
	  <td> <a href='userDisplay.php?delete=".$row['id']."'>Delete</a> </td>
	  </tr>";
}
}
}
else {
 header("Location: login.php");
}

if(isset($_GET['delete'])){
$sql = "delete from user where id=". $_GET['delete'];

$conn = db();
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

}




?>