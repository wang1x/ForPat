
<?php
include_once("functions.php");
$error="";
$data=[];
		    $data['sucess'] =false;
			$data["reason"] = $error;
if(count($_POST)>0 && isset($_POST['fname'])){
if(strlen($_POST['fname'])>0 && strlen($_POST['passwd'])>0 ){

$username = $_POST['fname'];
$password = md5( $_POST['passwd']);

$conn = db();

		$result = $conn->query("select * from user where username='".$username."' and password='".$password."'");

		if($result->num_rows>0){
		  $data['sucess'] =true;
		  $data["reason"]="welcome";
		}
		else {
		   $error= "username or password is not correct";
		    $data['sucess'] =false;
			$data["reason"] = $error;
		}
		
}
else {

//echo "please fill the form";
 $data['sucess'] =false;
			$data["reason"] = "please fill the form";
}

}
header('Content-type: application/json');
echo json_encode( $data);


?>






