<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/messengerfunctions.php');

$sessionuser = $_SESSION['sessionuser'];
//$chattingwith = $_SESSION['chattingwith'];
//$sessionuser = "jintu";
//$chattingwith = "chikku";


if(isset($_GET['action'])){
	$action = $_GET['action'];
}


/**
 * for retrieving unread messages, the recipient will be the logged in user
 */
if($action == "getUnreadMessages")
{	
	$sender  = $chattingwith;
	$recipient = $sessionuser;
	getUnreadMessages($chattingwith, $sessionuser);
}


/**
 * for adding new messages, the sender will be the logged in user
 */
elseif($action == "doAddMessage")
{
	if(isset($_GET['message'])){
		if($_GET['message'] != null){
			doAddMessageDB($sessionuser, $chattingwith, $_GET['message']);
		}
	}
}

elseif($action == "viewOnlineAdmins")
{
	$list_array = array(); 
	$result = viewOnlineSellersDB();
	
	while($details = mysql_fetch_array($result))
	{	
		$array = array(
			"username" => $details["user_id"]
		);
		array_push($list_array, $array);
	}
	
	echo json_encode($list_array);
}



function getUnreadMessages($chattingwith, $sessionuser)
{
	$list_array = array(); 
	$result = getUnreadMessagesDB($chattingwith, $sessionuser); 
	
	while($details = mysql_fetch_array($result))
	{	
		$array = array(
			"sender" => $details["sender"],
			"message" => $details["message"],
			"time" => $details["time"]
		);
		array_push($list_array, $array);
	}
	
	echo json_encode($list_array);
}





?>