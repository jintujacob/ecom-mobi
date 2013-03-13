<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("connection.php");
 

function getUnreadMessagesDB($sender, $recipient)
{
	$readflag = "n";
	$query =  " select * from chatbox ".
			  " where sender = '". $sender ."'"	.
			  	" and 	recipient = '". $recipient ."'"	.
			  	" and 	readflag = '". $readflag ."'" ;
			  
	$rs_messages = mysql_query($query);
	
	if(mysql_num_rows($rs_messages) > 0)  {
		//..... update the chatbox, change the readflag as 'y'
		$newflag = "y";
		while($row = mysql_fetch_array($rs_messages)) {
			$query = " update chatbox ". 
				     " set 	readflag = '".$newflag."' ".
				     " where slno = '".$row['slno']. "' " ;						
			mysql_query($query);
		}
		mysql_data_seek($rs_messages, 0);	
	}
	return $rs_messages;
}


function doAddMessageDB($sender, $recipient, $message){
		
	$time = "CURRENT_TIMESTAMP" ;	//sql function
	$readflag = "n" ;
	$query = "insert into chatbox ( 
 				sender, 
 				recipient, 
 				message, 
 				time, 
 				readflag 
 			) values ( '".
				$sender 		."', '".
				$recipient 		."', '".
				$message		."', ".
				$time			.", '".
				$readflag		."') " ;	
	echo $query ;
	$result = mysql_query($query);		 
}

function viewOnlineSellersDB()
{
	$query =  " select user_id from active_sessions ".
			  " where user_type = 'S'" ;
	$result = mysql_query($query);
	return $result;
}


?>
