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
	$data = array( $displayname, $operatorname,$email ,$address, $zipcode, $contactno, $landmark, $nearcity, $latitude, $longitude);

	doAddProfile($data);
}

if($action == "getProfileInfo"){
	$seller =(isset( $_POST["seller"]))   ? $_POST["seller"]: "" ;
	getSellerProfile($seller);
}


 function doAddProfile($data)
 {
    $result = doAddProfileDB($data);
    if($result == true)
     	echo json_encode(array("result"=>TRUE));
	else
     	echo json_encode(array("result"=>FALSE));
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