<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/geolocatefunctions.php');

//$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;
$action 	= (isset( $_GET['action'])) 	? $_GET['action'] 	: "" ;

if($action == "getSellersByDistance")
{
	/*
	$dist       	= (isset( $_POST['prod_id'] ))		? $_POST['prod_id'] 	: "" ;	
	$searchlat      = (isset( $_POST['sellerid'])) 	? $_POST['sellerid']: "" ;
	$searchlong 	= (isset( $_POST['name'])) 	? $_POST['sellerid']: "" ;
	*/
	
	$dist       	= (isset( $_GET['dist'] ))		? $_GET['dist'] 	: "" ;	
	$searchlat      = (isset( $_GET['searchlat'])) 	? $_GET['searchlat']: "" ;
	$searchlong 	= (isset( $_GET['searchlong'])) 	? $_GET['searchlong']: "" ;
	
	getSellersByDistanceSearch($dist, $searchlat, $searchlong);
		
}

function getSellersByDistanceSearch($dist, $searchlat, $searchlong){
	$result = getSellersByDistanceSearchDB($dist, $searchlat, $searchlong);

	 while($row = mysql_fetch_array($result)){
		echo $row[0];
		echo $row[1];
	}
	
}

//testing
//url : http://hackbox/iekrepo/services/geolocateservices.php?action=getSellersByDistance&dist=10&searchlat=37&searchlong=-122 
?>
