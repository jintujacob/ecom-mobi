<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/profilemanagementfunction.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "savemyprofile")
{
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
	$data = array( $displayname, $operatorname, $email, $address, $zipcode, $contactno, $landmark, $nearcity, $latitude, $longitude);

	doAddProfile($data);
	
		
}


 function doAddProfile($data)
 {
    $result = doAddProfileDB($data);
    if($result == true)
     	echo json_encode(array("result"=>TRUE));
	else
     	echo json_encode(array("result"=>FALSE));
 }
 