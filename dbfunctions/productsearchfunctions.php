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




?>