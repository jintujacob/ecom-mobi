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

elseif($action == "registerConsumer")
{
	$username	= (isset($_POST["username"])) 	? $_POST["username"]: "" ;
	$password	= (isset($_POST["password"])) 	? $_POST["password"]: "" ;
	$name		= (isset($_POST["name"])) 		? $_POST["name"]	: "" ;
	$email		= (isset($_POST["email"])) 		? $_POST["email"]	: "" ;
	$mobile		= (isset($_POST["mobile"])) 	? $_POST["mobile"]	: "" ;
	
	$profiletype= (isset($_POST["profiletype"])) 		? $_POST["profiletype"]	: "" ;
	
	$data = array( $username, $password, $name, $email, $mobile);
	
	//order of array elements is mandatory
	doRegisterConsumer($data, $profiletype);
	
}

elseif($action == "registerSeller")
{
	$username	= (isset($_POST["username"])) 	? $_POST["username"]: "" ;
	$password	= (isset($_POST["password"])) 	? $_POST["password"]: "" ;
	$name		= (isset($_POST["name"])) 		? $_POST["name"]	: "" ;
	$email		= (isset($_POST["email"])) 		? $_POST["email"]	: "" ;
	$mobile		= (isset($_POST["mobile"])) 	? $_POST["mobile"]	: "" ;
	$profiletype= (isset($_POST["profiletype"])) 		? $_POST["profiletype"]	: "" ;
	$data = array( $username, $password, $name, $email, $mobile);
	
	//order of array elements is mandatory
	

	$displayname  = (isset( $_POST["displayname"] ))  ? $_POST["displayname"] 	: "" ;	
	$operatorname =(isset( $_POST["operatorname"]))   ? $_POST["operatorname"]: "" ;
	$email 	      = (isset( $_POST["email"]))         ? $_POST["email"]: "" ;
	$address      = (isset($_POST["address"]))        ? $_POST["address"]: "" ;
	$zipcode      = (isset($_POST["zipcode"]))        ? $_POST["zipcode"]: "" ;
	$contactno	  = (isset($_POST["contactno"])) 	  ? $_POST["contactno"]	: "" ;
	$landmark	  = (isset($_POST["landmark"])) 	  ? $_POST["landmark"]	: "" ;
	$nearcity	  = (isset($_POST["nearcity"])) 	  ? $_POST["nearcity"]	: "" ;
	$latitude	  = (isset($_POST["latitude"])) 	  ? $_POST["latitude"]	: "" ;
	$longitude	  = (isset($_POST["longitude"])) 	  ? $_POST["longitude"]  : "" ;
	$dataprofile = array( $displayname, $operatorname,$email ,$address, $zipcode, $contactno, $landmark, $nearcity, $latitude, $longitude);

	doRegisterSeller($data,$dataprofile, $profiletype);
		

}


/* Utility Methods------------------------------------------------- */

function doValidateLogin($username, $password)
{
	/*
	 * validate the user from login table.
	 * add the user to active_sessions table if validation is success
	 * - to show online. set session on server side 
	 */
	$type='';
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


function doRegisterConsumer($data, $profiletype)
{
	/*
	 * insert profile to seller/consumer table. 
	 * insert username, password to login table.
	 * validate login from login table. - validation methode will 
	 * - create session and add user to active_sessions table 
	 */
	 
	$username = $data[0];
	$password = $data[1];
	$flag=true;
		$resregcon= doRegisterConsumerDB($data);
		//echo $resregcon;
		if($resregcon==true){
			$resaddlog=doAddToLoginDB($username, $password, $profiletype);
			if(!$resaddlog){
				$flag=false;
			}	
		}else {$flag=false;}
		
		
		if($flag == TRUE)
			doValidateLogin($username, $password);
		else 
			echo json_encode(array("result"=>FALSE));
		
		//doValidateLogin($username, $password);	//print true or false
}

function doRegisterSeller($data,$dataprofile, $profiletype){
	
	$username = $data[0];
	$password = $data[1];
	
	$resregsel= doRegisterSellerDB($data);
	$flag=true;	
	if($resregsel==true){
		$resaddlog=doAddToLoginDB($username, $password, $profiletype);
		if($resaddlog==true){
			$resaddprof=doAddProfileDB($dataprofile);
			if(!$resaddprof)
				$flag=false;
		}	
		else {$flag=false;}	
	}
	else {$flag=false;}
	
	
	if($flag == TRUE)
		doValidateLogin($username, $password);
	else 
		echo json_encode(array("result"=>FALSE));			
				
} 


if($action == "getProfileInfo"){
	$seller =(isset( $_POST["seller"]))   ? $_POST["seller"]: "" ;
	getSellerProfile($seller);
}


 
 function getSellerProfile($seller){
 	$result = getSellerProfileDB($seller);
	$list_array = array();
	while($row = mysql_fetch_array($result)){	
		$array = array( 
					"display_name" => $row["display_name"],
		 			"seller_id" => $row["seller_id"],
					"email" => $row["email"],
					"address" => $row["address"],
					"zipcode" => $row["zipcode"],
					"ph_no" => $row["ph_no"],
					"landmark" => $row["landmark"],
					"near_city" => $row["near_city"]
				);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
 }

/*	TEST CONSIDERATIONS :
 *  ---------------------
 * 
 *  login 	 		: select * from login; select * from active_sessions;
 *  registration	: select * from login; select * from consumer ; select * from active_sessions; 
 * 
 */
?>
