<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/useraccesscontrolfunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "doLogin")
{
	//$type 		= (isset( $_POST['type'] ))		? $_POST['type'] 	: "" ;	
	$username 	= (isset( $_POST['username'])) 	? $_POST['username']: "" ;
	$password 	= (isset( $_POST['password'])) 	? $_POST['password']: "" ;
	
	doValidateLogin($username, $password );//$type);
		
}

elseif($action == "doLogOff") 
{
	doLogOffUser($username);
		
}

elseif($action == "doRegister")
{
	$username	= (isset($_POST["username"])) 	? $_POST["username"]: "" ;
	$password	= (isset($_POST["password"])) 	? $_POST["password"]: "" ;
	$name		= (isset($_POST["name"])) 		? $_POST["name"]	: "" ;
	$email		= (isset($_POST["email"])) 		? $_POST["email"]	: "" ;
	$mobile		= (isset($_POST["mobile"])) 	? $_POST["mobile"]	: "" ;
	//$address	= (isset($_POST["address"])) 	? $_POST["address"]	: "" ;
	//$dob		= (isset($_POST["dob"])) 		? $_POST["dob"]		: "" ;
	$profiletype= (isset($_POST["profiletype"])) 		? $_POST["profiletype"]	: "" ;
	
	$data = array( $username, $password, $name, $email, $mobile);
	
	//order of array elements is mandatory
	$result=doRegisteruser($data, $profiletype);
	if($result == true)
     	echo json_encode(array("result"=>TRUE));
	else
     	echo json_encode(array("result"=>FALSE));
}



/* Utility Methods------------------------------------------------- */

function doValidateLogin($username, $password)
{
	/*
	 * validate the user from login table.
	 * add the user to active_sessions table if validation is success
	 * - to show online. set session on server side 
	 */
	 
	$flag = FALSE;
	if($username != "" && $password != ""){
		$result = doValidateLoginDB($username, $password);
		while($row = mysql_fetch_array($result)){	
		$type = $row["type"];
		}
		$count=mysql_num_rows($result);
		
		if($count==1){
			doAddUserSessionDB($username,$type);
				
			session_start();	
			$_SESSION['username']= $username ;
			$flag = TRUE;
		}
	}	
	
	if($flag == TRUE)
		echo json_encode(array("result"=>TRUE));
	else 
		echo json_encode(array("result"=>FALSE));	
}
		

function doLogOffUser($username){
	session_start();	
	session_destroy();
}


function doRegisteruser($data, $profiletype)
{
	/*
	 * insert profile to seller/consumer table. 
	 * insert username, password to login table.
	 * validate login from login table. - validation methode will 
	 * - create session and add user to active_sessions table 
	 */
	 
	$username = $data[0];
	$password = $data[1];
	
	if($profiletype == "consumer"){
		
		$resregcon= doRegisterConsumerDB($data);
		//echo $resregcon;
		if($resregcon==true){
			$resaddlog=doAddToLoginDB($username, $password, $profiletype);
			if($resaddlog==true){
				return true;
			}	
			else {return false;}	
		}
		else {return false;}
	}
	else if($profiletype == "seller"){
			$resregsel= doRegisterSellerDB($data);
				if($resregsel==true){
					$resaddlog=doAddToLoginDB($username, $password, $profiletype);
					if($resaddlog==true){
						return true;
					}	
					else {return false;}	
				}
				else {return false;}
	}
	
	
	doValidateLogin($username, $password);	//print true or false
}


/*	TEST CONSIDERATIONS :
 *  ---------------------
 * 
 *  login 	 		: select * from login; select * from active_sessions;
 *  registration	: select * from login; select * from consumer ; select * from active_sessions; 
 * 
 */
?>
