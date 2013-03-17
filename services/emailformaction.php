<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/emailservicefunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "doLogin")
{
	$type 		= (isset( $_POST['type'] ))		? $_POST['type'] 	: "" ;	
	$username 	= (isset( $_POST['username'])) 	? $_POST['username']: "" ;
	$password 	= (isset( $_POST['password'])) 	? $_POST['password']: "" ;
	
	doValidateLogin($username, $password, $type);
		
}


/* Utility Methods------------------------------------------------- */




/*	TEST CONSIDERATIONS :
 *  ---------------------
 * 
 *  login 	 		: select * from login; select * from active_sessions;
 *  registration	: select * from login; select * from consumer ; select * from active_sessions; 
 * 
 */
?>
