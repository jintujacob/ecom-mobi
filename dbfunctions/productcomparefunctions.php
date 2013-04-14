<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function getAllCategoryListDB(){
	$query=" select distinct category from config_category";
	$result = mysql_query($query);	
	return $result;	 	
}


function dogetBasicproductInfoDB($prod_id){
	$query="select * from product_seller where prod_id='$prod_id' LIMIT 1";
	
	$result=mysql_query($query);
	return $result;
} 
function dogetProductConfigDB($prod_id){
	$query="select * from product_configuration where prod_id='$prod_id'";
	$result1=mysql_query($query);
	return $result1;
}
//function populateProductInfo(10){

?>