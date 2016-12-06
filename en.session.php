<?php 
/*
 *	Log-in messages
 */
 define( "MSG_SESSION_WRONGLOGIN", "Invalid username and/or password. Please try again." );
 define( "MSG_SESSION_INACTIVE", "Your account is inactive, please contact the administrator." ); 
 define( "MSG_SESSION_TIMEOUT", "Your session has been terminated due to inactivity. Please log-in again." );
 define( "MSG_SESSION_LOGIN", "Please enter your log-in information." );
 define( "MSG_SESSION_NOACCOUNT", "The data submitted does not match any registered account." );
 
/*
 * Lost password messages
 */
define( "LBL_SESSION_LOSTPASSWORD", "Lost your password?" );
define( "LBL_SESSION_SENDPASSWORD", "Send me a new password!" );
define( "LBL_SESSION_BACKTOLOGIN", "Back to Log-in Page" );
define( "LBL_SESSION_HAVINGTROUBLE", "Having trouble?" );
define( "LBL_SESSION_RESESTMYPASSWORD", "Reset my password" );
define( "LBL_SESSION_ENTERYOUREMAIL", "Enter your email address");
define( "LBL_SESSION_EMAILBELOW", "Enter your email address below and we'll send you password reset instructions.");
define( "LBL_SESSION_DIDNTGETEMAIL","Didn't get an email?" );
define( "LBL_SESSION_IFNOTGETEMAIL","If you don't get your password reset instructions within a few minutes please be sure to check your spam filter. The email will be coming from do-not-reply@instacoin.net." );

$year = date("Y");
define( "LBL_SESSION_CONTACT", "Contact" );
define( "LBL_SESSION_SUPPORTCENTER", "our Support Center." );
define( "LBL_SESSION_COPYRIGHT", "Copyright © $year" );
define( "LBL_SESSION_ALLRIGHTS", "All Rights Reserved" );
define( "LBL_SESSION_ENCRYPTION", "256-Bit SSL Encryption (AES-256)" );
 
 
 define( "MSG_SESSION_NEWPASSWORDSENT", "Password reset instructions have been sent to your email account. Please check your inbox in a couple of minutes to ensure that they did not land in your SPAM box." );
 define( "MSG_SESSION_EMAILFAILED", "An error occured while sending the email containing your password reset instructions. The password remains unchanged." );
 define( "MSG_SESSION_EMAILSUBJECT", WEBSITE_NAME." - Administration Panel" );
 define( "MSG_SESSION_EMAILTEXT_GREETING", "Greetings " );
 define( "MSG_SESSION_EMAILTEXT_BEGIN", ",\r\n\r\nYou have requested password reset instructions for  ".WEBSITE_NAME."'s Administration Panel. To reset your password, visit:\r\n\r\n" );
 define( "MSG_SESSION_EMAILTEXT_END", "\r\n\r\nThis link is valid for " . PASSWORD_RESET_TIMEOUT . " minutes.  If you did not request these instructions, it is safe to ignore this email.\r\n\r\nThanks!\r\n\r\n" );
 define( "MSG_SESSION_YOUVE_BEEN_LOGOUT", "You have been logged out or your session expired." );
 
/*
 * Login and general labels
 */
 define( "LBL_LOGIN_FORGOTPWD", "Forgot your password?" );
 define( "LBL_LOGIN_GETNEWLINK", "Get a new one!" );
 define( "LBL_LOGIN_ASK", "Log-in" );
 define( "LBL_LOGIN_USERNAME", "Email or Username" );
 define( "LBL_LOGIN_PASSWORD", "Password" );
 define( "LBL_LOGIN_KEEPLOGIN", "Keep me logged in until I disconnect." );
 define( "LBL_LOGIN_CONNECT", "Connect" );
 define( "LBL_LOGIN_WELCOME", "Welcome" );
 define( "LBL_LOGIN_LOGOUT", "Log-out" );
 define( "LBL_LOGIN_ADMINPANEL", "Administration Panel" );
 define( "LBL_LOGIN_SUPPORT", "support" );
 define( "LBL_USER_USERNAME", "Username" );
 define( "LBL_NEED_HELP", "Help" );
 define( "LBL_404", "That page or action is not available." );
?>
