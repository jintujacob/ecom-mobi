<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/productsearchfunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "getAllCategoryList"){
	getAllCategoryList();
}
if($action == "getConfigList"){
	$category 	= (isset( $_POST['category'])) 	? $_POST['category'] 	: "" ;
	getConfigList($category);
}


//------------------ utility methodes
function getAllCategoryList()
{
	$result = getAllCategoryListDB();
	
	$list_array = array();
	while($row = mysql_fetch_array($result)){	
		$array = array( "category" => $row["category"]);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}

function getConfigList($category){
	echo "calling";	
	$result = getConfigListDB();
	
	$list_array = array();
	while($row = mysql_fetch_array($result)){	
		$array = array( "config" => $row["config"], "unit" => $row["unit"]);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}
 