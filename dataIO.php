
<?php
include_once("functions.php");
function register(){
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
}

function getKnowPat(){
        $conn = db();
	$sql = "select * from User";
	$result = $conn->query($sql);
	$names = ["user_username", "user_email", "firsttime", "description"];
	$out = [];
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			array_push($out, $row);
		}
	}
	return $out;
}


?>
