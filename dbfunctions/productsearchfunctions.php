<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function getAllCategoryListDB(){
	$query=" select distinct category from config_category";
	$result = mysql_query($query);	
	return $result;	 	
}

function getConfigListDB($category){
	$query=" select config, unit from config_category ".
		 " where category = '$category' " ;
	$result = mysql_query($query);	
	return $result;	 	
}

function getConfigListDBByConfig($config)
{
     $query=" select config, unit from config_category ".
		 " where config = '$config' " ;
	$result = mysql_query($query);	
	return $result;	 	
}

function getSellerCategoryListDB($seller){
	$query=" select distinct category from product_seller ". 
	         "where sellerid = '$seller'";
	$result = mysql_query($query);	
	return $result;	 	
}

function getProductsUnderCategoryListDB($seller,$category){
	$query=" select * from product_seller ". 
	         "where sellerid = '$seller'".
			 "and   category = '$category'";
	$result = mysql_query($query);	
	return $result;	 	
}

function getSoloProductInfoDB($prod_id){
	$query="select * from config_category CC ".
				"RIGHT JOIN".
				"(select * from product_configuration ".
				 "where prod_id = '$prod_id'".
				")PC ".
				"ON CC.config_id = PC.config_id ";	
	$result = mysql_query($query);	
	return $result;	 	
}

function doAddBasicProductInfoDB($seller, $name,$descripion, $category, $count){
	$query ="insert into product_seller ".
			"(	sellerid	  ,
				name         ,
				description       ,
				category       ,
				count         
			)values ( '".
				$seller 	."', '".
				$name 	."', '".
				$descripion 	."', '".
				$category 	."', '".
				$count 	."') " ;
	$result = mysql_query($query);
	return $result;
}

function getProductIdDB($seller, $name,$descripion, $category, $count){
	$query= " select prod_id from product_seller ".
		 	" where sellerid = '$seller' ".
		 	" and name = '$name' " .
		 	" and category = '$category' " .
		 	" and count = '$count' "  .
			" ORDER BY prod_id DESC LIMIT 1";
	$result = mysql_query($query);	
	return $result;	
}

function doAddConfigurationDB($product_id, $configname, $stringval, $intval){
	$query ="insert into product_configuration ".
			"(	config_name ,
				prod_id ,
				string_value,
				int_value
			)values ( '".
				$configname 	."', '".
				$product_id	."', '".
				$stringval 	."', '".
				$intval 	."') " ;
	$result = mysql_query($query);
	return $result;
}

function checkConfigValueTypeDB($configname, $category){
	//return string or int
	$query= " select unit from config_category ".
		 	" where config = '$configname' ".
		 	" and category = '$category' " ;
		 	
	$result = mysql_query($query);	
	return $result;
}

function doAddKeywordsDB($product_id, $keyword){
	$query ="insert into keyword_searchengine ".
			"(	keyword ,
				product_id 
			)values ( '".
				$keyword 	."', ".
				$product_id .") " ;
	echo $query;						
	$result = mysql_query($query);
	return $result;
}



?>