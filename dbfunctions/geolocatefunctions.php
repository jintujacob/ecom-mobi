<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");

 function getSellersByDistanceSearchDB($data, $dist, $searchlat, $searchlong){
	//haversign
	$query1=" (SELECT seller_id, ( 3959 * acos( cos( radians($searchlat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($searchlong) ) + sin( radians($searchlat) ) * sin( radians( latitude ) ) ) ) AS distance FROM sellerprofile HAVING distance < $dist ORDER BY distance LIMIT 0 , 50)";


	$count=count($data);
	$querystart ="(select * from product_seller where prod_Id in( SELECT distinct product_id FROM keyword_searchengine where";
			
	$condition="";
	for($i=0;$i<$count;$i++){
		
		if($condition=="")
		
			$condition=$condition." keyword like '%$data[$i]%'";
			
		else
			$condition=$condition." or keyword like '%$data[$i]%'";
	}				
	$querytail="))";				
	$query2=$querystart.$condition.$querytail;	
	
	$query3 = "SELECT * FROM ". $query1 . " A LEFT JOIN ". $query2. " B on A.seller_id=B.sellerid";
	
//	echo $query3;
	$result = mysql_query($query3);
	
	return $result;
}

  
 
 
 /*

function getSellersByDistanceSearchDB($dist, $searchlat, $searchlong){
	//haversign
	$query=" SELECT *, ( 3959 * acos( cos( radians($searchlat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($searchlong) ) + sin( radians($searchlat) ) * sin( radians( latitude ) ) ) ) AS distance FROM sellerprofile HAVING distance < $dist ORDER BY distance LIMIT 0 , 50";
	//echo $query;
	$result = mysql_query($query);	
	return $result;	 	
}

function getProductListDB($data  ){
	
	$count=count($data);
	$querystart ="select * from product_seller where prod_Id in( SELECT distinct product_id FROM keyword_searchengine where";
			
	$condition="";
	for($i=0;$i<$count;$i++){
		
		if($condition=="")
		
			$condition=$condition." keyword like '%$data[$i]%'";
			
		else
			$condition=$condition." or keyword like '%$data[$i]%'";
	}				
	$querytail=")";				
	$query=$querystart.$condition.$querytail;	
	//echo $query;
	$result = mysql_query($query);
	
	return $result;
}


*/
?>