<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

include('../dbfunctions/offersandnewsfunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "getSellerOffers"){
	$seller 	= (isset( $_POST['seller'])) 	? $_POST['seller'] 	: "" ;
	getSellerOffers($seller);
}

function getSellerOffers($seller){
	$result = getSellerOffersDB($seller);
	$list_array = array();
	while($row = mysql_fetch_array($result)){	
		$array = array(
		 "offerid" => $row["offerid"],
		 "sellerid" => $row["sellerid"],
		 "title" => $row["title"],
		 "description" => $row["description"],
		 "period" => $row["period"]
		 );
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}

?>
