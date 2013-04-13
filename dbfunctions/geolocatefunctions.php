<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function getSellersByDistanceSearchDB($dist, $searchlat, $searchlong){
	//haversign
	$query=" SELECT *, ( 3959 * acos( cos( radians($searchlat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($searchlong) ) + sin( radians($searchlat) ) * sin( radians( latitude ) ) ) ) AS distance FROM sellerprofile HAVING distance < $dist ORDER BY distance LIMIT 0 , 50";
	//echo $query;
	$result = mysql_query($query);	
	return $result;	 	
}

?>