<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function getAllCategoryListDB(){
	$sql=" select distinct category from config_category";
	$result = mysql_query($query);	
	return $result;	 	
}

function getConfigListDB($category){
	$sql=" select config, unit from config_category ".
		 " where category = '$category' " ;
	echo $sql;
	
	$result = mysql_query($query);	
	return $result;	 	
	
	
}





?>