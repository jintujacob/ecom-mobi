<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/emailservicefunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "doSendEmail")
{
	$type 	= (isset( $_POST['type'] ))		? $_POST['type'] 	: "" ;	
	$title 	= (isset( $_POST['title'])) 	? $_POST['title']: "" ;
	$desc 	= (isset( $_POST['desc'])) 	? $_POST['desc']: "" ;
	
	doSendEmail($type, $title, $desc);	
		
}


/* Utility Methods------------------------------------------------- */
function doSendEmail($type, $title, $desc) {
	$mailto = "notset";
	$data  = array( "title" => $title,
					"description" => $desc,
					"mail_from" => $_SESSION['username'],
					"mail_to" => $mailto	
				  );	
	$result = doAddEmailDB($data);
	//echo json_encode(array("result"=>TRUE));
}



/*	TEST CONSIDERATIONS :
 *  ---------------------
 * 
 *  login 	 		: select * from login; select * from active_sessions;
 *  registration	: select * from login; select * from consumer ; select * from active_sessions; 
 * 
 */
?>
