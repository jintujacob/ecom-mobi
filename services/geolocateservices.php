<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/geolocatefunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;
//$action 	= (isset( $_GET['action'])) 	? $_GET['action'] 	: "" ;

if($action == "getSellersByDistance")
{
	$searchkey  = (isset( $_POST["searchkey"] ))  ? $_POST["searchkey"] 	: "" ;	
	$radius       	= (isset( $_POST['radius'] ))	? $_POST['radius']	: "" ;	
	$center_lat     = (isset( $_POST['lat'])) 		? $_POST['lat']: "" ;
	$center_long 	= (isset( $_POST['lng'])) 		? $_POST['lng']: "" ;
	
	getSellersByDistanceSearch($searchkey, $radius, $center_lat, $center_long);
}

function getSellersByDistanceSearch($searchkey, $radius, $center_lat, $center_long){
		
	$data = explode(" ",$searchkey);
	$result = getSellersByDistanceSearchDB($data, $radius, $center_lat, $center_long);
	
	$list_array = array();
	while($row = mysql_fetch_array($result)){	
		$array = array(
		 "prod_no" => $row["prod_id"],
		 "sellerid" => $row["sellerid"],
		 "name" => $row["name"],
		 "description" => $row["description"],
		 "category" => $row["category"],
		 "count" => $row["count"],
		 "distance" => substr($row["distance"], 0, 5)
		 );
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}



//testing
//url : http://hackbox/iekrepo/services/geolocateservices.php?action=getSellersByDistance&dist=10&searchlat=37&searchlong=-122 
?>



