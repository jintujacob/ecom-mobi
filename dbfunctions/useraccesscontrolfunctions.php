<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function doValidateLoginDB($usr, $pass){
	$sql=" SELECT * FROM login ".
		 " 	 WHERE username ='".$usr."' ".
		 " 	 and password ='".$pass."'" ;
	  // " 	 and type ='".$type."'" ; 
		 
	$result=mysql_query($sql);
	//echo $result;
	return $result ;
}

function doAddToLoginDB($usr, $pass, $profiletype)
{
	$query ="insert into login ".
			"(	username, 
 				password,
 				type
 			 )values ( '".
				$usr 	."', '".
				$pass 	."', '".
				$profiletype	."') " ;
				
	$resaddlog = mysql_query($query);
	return $resaddlog;		 
}

function doAddUserSessionDB($username,$type)
{
	//$type = "C";
	$time = "CURRENT_TIMESTAMP" ;	//sql function
	$query ="insert into active_sessions ( 
 				user_id, 
 				login_time,
 				user_type 
 			) values ( '".
				$username 	."', ".
				$time		." , '".
				$type       ."') " ;	
	$result = mysql_query($query);		 
}

function doRegisterConsumerDB($data)
{
	//skipping $data[0] = password since it is not a part of this table
	$query ="insert into consumer ( 
 				username, 
 				name,
 				email,
 				mobile
 				)values ( '".
				$data[0] 	."', '".
				$data[2] 	."', '".
				$data[3] 	."', '".
				$data[4] 	."') " ;			
	$resregcon = mysql_query($query);		
	return $resregcon; 
}

function doRegisterSellerDB($data)
{
	//skipping $data[0] = password since it is not a part of this table
	$query ="insert into seller ( 
 				username, 
 				name,
 				email,
 				mobile
 				) values ( '".
				$data[0] 	."', '".
				$data[2] 	."', '".
				$data[3] 	."', '".
				$data[4]  	."') " ;
	$resregsel = mysql_query($query);		 
	return $resregsel;
}


?>