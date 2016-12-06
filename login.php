<?php
/** Create user object **/
	require_once( "class.user.php" );
	require_once("class.mysql.php");
	
/**
 *
 *		Session login check
 *
**/

function checkLoginByCookie(){
	global $mydb;
	if(isset($_COOKIE) && isset($_COOKIE["user"])){
		$cookie = $_COOKIE["user"];
		$dbCookie = $mydb->get_row("select * from cookie where cookie = '$cookie' and lasttime BETWEEN NOW() - INTERVAL 30 MINUTE AND NOW()");
		//print_r($dbCookie);	
		if($dbCookie){
			$uid = $dbCookie->cookie;
			$sql = "update cookie set lasttime= NOW() where cookie= '$uid'";
			$mydb->query($sql);
			return true;
		}
	}
	return false;
}
function login(){
	global $user;
	global $mydb;
	if ( isset($_REQUEST['log_user'], $_REQUEST['log_password']) )
	{
		$user->LogUser( $_REQUEST['log_user'], $_REQUEST['log_password']);
	}
	/** Refresh session info **/
	elseif ( isset( $_SESSION['user_id'] ) )
	{ 
		$user->Refresh( $_SESSION['user_id'], session_id() );
	}

	/** Check for saved login info  **/
	if ( !$user->isLogged && isset( $_COOKIE[COOKIE_KEEPLOGIN] ) )
	{
		$user->CookieLogin( urldecode( $_COOKIE[COOKIE_KEEPLOGIN] ) );
	}

	/** Check for valid one-time password reset code **/
	if ( !$user->isLogged && isset( $_GET['token'] ) && isset( $_GET['user_id'] ) )
	{
		$user->OneTimeLogin( $_GET['user_id'], $_GET['token'] );
	}

	if($user->isLogged){
		$uid = uniqid();
		$userID = $user->theUser->user_id;
		//print_r($user->theUser);
		$sql = "insert into cookie set cookie= '$uid', user_id= $userID";
		$mydb->query($sql);
		session_start();
		setcookie("user", $uid, time()+60*60*24*365, $_SERVER['SERVER_NAME']);
		return true;
		//$_SESSION["user_id"] = ;
		//header('Location: index.php');
	}
	else {
		return false;
	}
}
/*
global $user;
	print_r($user);
*/
?> 
