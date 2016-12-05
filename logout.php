<?php
session_start();

echo "Bye!";
if(session_destroy()){
   header("Location: login.php");

}



?>
