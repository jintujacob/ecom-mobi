<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");

function getSellerOffersDB($seller){
	$query= "select * from seller_offers where sellerid='$seller'";
	$result = mysql_query($query);	
	return $result;	 	
		
}



?>