<?php
/** Create user object **/
	require_once( "class.user.php" );
	
/**
 *
 *		Session login check
 *
**/
   function login(){
		global $user;
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

		/** If user is still not logged in, show login screen and exit **/
               /*
		if ( !$user->isLogged && strpos( $_SERVER['PHP_SELF'], "lost.php" ) === false ) 
		{
			include( "login.php" );
			exit();
		}
		*/
		return $user->isLogged;
	}
/*
global $user;
	print_r($user);
*/
?> 
