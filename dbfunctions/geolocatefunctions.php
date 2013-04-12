<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function getSellersByDistanceSearchDB($dist, $searchlat, $searchlong){
	//haversign
	$query=" SELECT id, ( 3959 * acos( cos( radians($searchlat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($searchlong) ) + sin( radians($searchlat) ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < $dist ORDER BY distance LIMIT 0 , 50";
	$result = mysql_query($query);	
	return $result;	 	
}

?>