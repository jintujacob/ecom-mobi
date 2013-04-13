<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/geolocatefunctions.php');

//$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;
$action 	= (isset( $_GET['action'])) 	? $_GET['action'] 	: "" ;

if($action == "getSellersByDistance")
{
	$radius       	= (isset( $_GET['radius'] ))	? $_GET['radius']	: "" ;	
	$center_lat     = (isset( $_GET['lat'])) 		? $_GET['lat']: "" ;
	$center_long 	= (isset( $_GET['lng'])) 		? $_GET['lng']: "" ;
	
	getSellersByDistanceSearch($radius, $center_lat, $center_long);
}

function getSellersByDistanceSearch($radius, $center_lat, $center_long){
	$result = getSellersByDistanceSearchDB($radius, $center_lat, $center_long);
	
	header("Content-type: text/xml");
	// Start XML file, create parent node
	$dom = new DOMDocument("1.0");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node);
	
	
	// Iterate through the rows, adding XML nodes for each
	while ($row = @mysql_fetch_assoc($result)){
	  $node = $dom->createElement("marker");
	  $newnode = $parnode->appendChild($node);
	  $newnode->setAttribute("name", $row['name']);
	  $newnode->setAttribute("address", $row['address']);
	  $newnode->setAttribute("lat", $row['lat']);
	  $newnode->setAttribute("lng", $row['lng']);
	  $newnode->setAttribute("distance", $row['distance']);
	}
	
	echo $dom->saveXML();
	
	/*
	 while($row = mysql_fetch_array($result)){
		echo $row[0];
		echo $row[1];
	}
	 * 
	 */
	 
	 
	 
}


//testing
//url : http://hackbox/iekrepo/services/geolocateservices.php?action=getSellersByDistance&dist=10&searchlat=37&searchlong=-122 
?>



