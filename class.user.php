<?php 
require_once("class.mysql.php");
/** COOKIES **/
// name value for cookies
	define( "COOKIE_KEEPLOGIN", "rsl" );
	define( "COOKIE_KEEPUSER", "rsu" );

	# timeout in minutes for users to click the reset password link before the token expires
	define( "PASSWORD_RESET_TIMEOUT", 30 );
class CUser {

	var $isLogged 	= false;
	var $id			= '';
	var $email		= '';
	var $firstname 	= '';
	var $lastname 	= '';
	var $privs		= array();
	var $langs		= array();

	function GetTheUser($where_col, $where_val) {
		global $mydb;
		$db = $mydb;
		//$db->trace =1;
		if (!is_array($where_col)) $where_col = array($where_col);
		if (!is_array($where_val)) $where_val = array($where_val);

		$stanzas = array();
		foreach ($where_col as $k => $col) {
			$stanzas[] = "$col='" . $db->escape($where_val[$k]) . "'";
		}
		$stanzas[]="user_status = 'Active'";
		if(isset($stanzas["user_username"])){
			$name =$stanzas["user_username"]; 	
			$this->theUser = $db->get_row("SELECT *, unix_timestamp(user_reset_ts) as user_reset_ts FROM User WHERE user_username='".$name."';");
		}

			if ($this->theUser) {
				$this->theUser->groups = "Active";

				// update language based on user preferece
				$GLOBALS["cms_lang"] = "en";
				// get the list of customers this user is allowed to see
				//$this->theUser->customers = $db->get_col("SELECT customer_id FROM CustomerUser WHERE item_id=" . $this->theUser->user_id);
				//$this->theUser->groups = $db->get_col("SELECT grp_id FROM UserGrp WHERE user_id=" . $this->theUser->user_id);
			}
		}

		function LoginSuccess() {
			global $mydb;
			$db = $mydb;
			$_SESSION['user_id'] = $this->theUser->user_id;


			// Log IP Address
			if ( getenv("HTTP_CLIENT_IP") > 0 )
				$ip = getenv("HTTP_CLIENT_IP");
			elseif ( getenv("HTTP_X_FORWARDED_FOR") > 0 )
				$ip = getenv("HTTP_X_FORWARDED_FOR");
			elseif ( isset($_SERVER["REMOTE_ADDR"]) )
				$ip = getenv("REMOTE_ADDR");
			else
				$ip = "0.0.0.0";

			// Save IP address and Session ID in database
			$db->query( "UPDATE User"
					." SET user_session_id = '".session_id()."'"
					.", user_last_ip = INET_ATON('$ip')"
					." WHERE user_id = ".$this->theUser->user_id." LIMIT 1");

			// Keep login information 
			if ( isset( $_REQUEST['log_keepconnection'] ) ) {
				$db->query( "REPLACE INTO UserCookie SET cookie_token = '".session_id()."', cookie_id = '".$this->theUser->user_id."'" );
				$this->_feedcookie();
			}

			$this->isLogged = true;
		}

		/**
		 * Login
		 *
		 * Verify login information and set session data
		 **/
		function LogUser( $log_user, $password )
		{
			global $actionMsg;
			global $mydb;
			$db = $mydb;

			$this->isLogged = false;

				$this->theUser = $db->get_row("SELECT *, unix_timestamp(user_reset_ts) as user_reset_ts FROM User WHERE user_username='".$log_user."'");
			//print_r($this->theUser);
			if ( !$this->theUser )
			{
				$this->GetTheUser(array("user_username", "user_status"), array($log_user, 'Active'));
			}

			if ( $this->theUser ) {
# we got a matching user, either via email or username
# now check the password
				//print_r( array( $password,"::", $this->theUser->user_password, ":::", md5($password)));
				if ($this->theUser->user_password == md5($password)) {
# old password, rehash it and log in
					$db->query("UPDATE User SET user_password='" . 
							$db->escape(password_hash($password, PASSWORD_DEFAULT)) . 
							"' WHERE user_id=" . $this->theUser->user_id
						  );
					$this->isLogged = true;
				} elseif (password_verify($password, $this->theUser->user_password)) {
					//echo $password,"::", $this->theUser->user_password, ":::";
# new password matches
					$this->isLogged = true;
				}
			}

			if ( !$this->isLogged ) {
# either no such user, or wrong password
				include_once( "en.session.php" );

				$actionMsg[] = MSG_SESSION_WRONGLOGIN;
				$this->isLogged = false;
				return false;
			}

			// Set variables and change session id to avoid session hijacking
			//session_regenerate_id();
			$this->LoginSuccess();
			return true;
		} // end function Login

		/**
		 * Refresh
		 *
		 * Verify session id in database and retrieve info
		 **/
		function Refresh( $id, $session )
		{
			global $actionMsg;

			$this->GetTheUser("user_id", $id);
			// Make sure user exists
			if ( !$this->theUser ) {
				include_once( "en.session.php" );
				$actionMsg[] = MSG_SESSION_LOGIN;
				$this->isLogged = false;
				return false;
			}
			/*	
			// Wrong session id, the session probably timed out
			if ( $this->theUser->user_session_id != $session )
			{
			$actionMsg[] = MSG_SESSION_TIMEOUT;
			$this->isLogged = false;
			return false;
			} */// refresh info
			else
			{
				$this->LoginSuccess();
				return true;
			}
		} // end function Refresh

		/**
		 * CookieLogin
		 *
		 * Log user in using cookie information
		 **/
		function CookieLogin($biscuit)
		{
			global $mydb;
			$db = $mydb;
			global $actionMsg;

			// Get cookie info
			$cook_id = (int)substr($biscuit, 0, strpos($biscuit, ","));
			$cook_token = substr($biscuit, strpos( $biscuit, ",")+1 );

			// Check if cookie is valid, if so, retrieve user info
			if ( $db->get_var( "SELECT cookie_id FROM UserCookie WHERE cookie_id = $cook_id AND cookie_token = '".$db->escape($cook_token)."' LIMIT 1" ) == $cook_id ) {

				// Get user info

				$this->GetTheUser("user_id", $cook_id);
				if ( !$this->theUser )
				{
					include_once( "en.session.php" );
					$actionMsg[] = MSG_SESSION_WRONGLOGIN;
					$this->isLogged = false;
					return false;
				}
				// Log user in

				// Regenerate session id for security reason 
				//session_regenerate_id();
				$this->LoginSuccess();
				return true;
			}
		}	// end function Cookie


		/**
		 * OneTimeLogin
		 *
		 * Check for a valid one-time password reset token login
		 */
		function OneTimeLogin($user_id, $token)
		{
			global $mydb;
			$db = $mydb;
			$this->isLogged = false;
			$this->GetTheUser("user_id", $user_id);
			if ($this->theUser) {
# no matter if they provide the correct token or not, they only get a single try
				$db->query("UPDATE User SET
						user_reset_token='',
						user_reset_ts=0
						WHERE user_id=$user_id"
					  );
				if (time() - $this->theUser->user_reset_ts <= (60*PASSWORD_RESET_TIMEOUT) 
						and password_verify($token, $this->theUser->user_reset_token)) {
# good login
					$this->LoginSuccess();
# remember this was a token login so the user can change their password without knowing the old one
					$_SESSION['logged_in_via_token'] = true;
# go to the password reset page
					header("Location: " . URL_MANAGE_FULL . "options.php");
					exit();
				}
			}
			return false;
		}

		/**
		 ** hasAccess
		 **
		 ** Check if the user has access
		 **/
		function hasAccess( $module_id )
		{
			return in_array( $module_id, $this->privs );
		}

		function hasLang( $lang_code )
		{
			return in_array( $lang_code, $this->langs );
		}

		function langCount()
		{
			return count( $this->langs );
		}

		function isAdmin()
		{
			return $this->type <= 1;
		}

		/**
		 ** _feedcookie
		 **
		 ** Create cookie with session fingerprint and user id
		 ** Cookie dies in one year
		 **/
		function _feedcookie( $type = "full" )
		{
			switch ( $type )
			{
				case "full":
					$cookievalue = $this->id.",".session_id();
					// Set cookie, valid for a year
					setcookie( COOKIE_KEEPLOGIN, $cookievalue, time()+60*60*24*365, URL_MANAGEMENT_DIR );
					break;
				case "username":
					$cookievalue = $this->email;
					setcookie( COOKIE_KEEPUSER, $cookievalue, time()+60*60*24*365, URL_MANAGEMENT_DIR );
					break;
			}

		} // end _feedcookie
	} // end class User


// create global variable
global $user;
$user = new CUser();

?>
