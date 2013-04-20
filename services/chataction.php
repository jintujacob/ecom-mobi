<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/messengerfunctions.php');
session_start();

$sessionuser = $_SESSION['username'];
//$chat_request_for = (isset( $_SESSION['chat_request_for'])) 	? $_SESSION['chat_request_for']	: "" ;

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "getUnreadMessages")
{	
	$sessionuser = $_SESSION['username'];	
	$chattingwith = (isset( $_SESSION['chattingwith'])) 	? $_SESSION['chattingwith']	: "" ;
	getUnreadMessages($sessionuser, $chattingwith);
}

if($action == "doAddMessage")
{
	$message 	= (isset( $_POST['message'])) 	? $_POST['message'] 	: "" ;
	$chattingwith = (isset( $_SESSION['chattingwith'])) 	? $_SESSION['chattingwith']	: "" ;
	doAddMessageDB($sessionuser, $chattingwith, $message);
}

if($action == "checkSellerAvailability")
{	
	$seller 	= (isset( $_POST['seller'])) 	? $_POST['seller'] 	: "" ;
	doCheckSellerAvailability($seller);
}
if($action == "acceptChatRequest")
{
	$consumer = "requested for chat";		
	$_SESSION['chattingwith'] = $consumer;
}




function doCheckSellerAvailability($seller){
	$result =  checkSellerAvailabilityDB($seller);
	$count=mysql_num_rows($result);
	
	if($count > 0 ){
		$_SESSION['chattingwith'] = $seller;
		echo json_encode(array("status"=> "online"));
	}
	else{
		echo json_encode(array("status"=> "offline")) ;
	}
}

function getUnreadMessages($sessionuser, $sender )
{
	$list_array = array(); 
	$result = getUnreadMessagesDB($sessionuser, $sender ); 
	
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

/*
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
*/




?>