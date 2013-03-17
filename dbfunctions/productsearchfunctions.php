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





?>