<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


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





?>