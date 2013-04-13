<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/geolocatefunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;
//$action 	= (isset( $_GET['action'])) 	? $_GET['action'] 	: "" ;

if($action == "getSellersByDistance")
{
	$radius       	= (isset( $_POST['radius'] ))	? $_POST['radius']	: "" ;	
	$center_lat     = (isset( $_POST['lat'])) 		? $_POST['lat']: "" ;
	$center_long 	= (isset( $_POST['lng'])) 		? $_POST['lng']: "" ;
	
	getSellersByDistanceSearch($radius, $center_lat, $center_long);
}

function getSellersByDistanceSearch($radius, $center_lat, $center_long){
	$result = getSellersByDistanceSearchDB($radius, $center_lat, $center_long);
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
		 "near_city" => $row["near_city"],
		 "distance" => substr($row["distance"], 0, 5)     
		 );
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}


//testing
//url : http://hackbox/iekrepo/services/geolocateservices.php?action=getSellersByDistance&dist=10&searchlat=37&searchlong=-122 
?>



