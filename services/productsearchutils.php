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

if ($action == "doAddProduct"){
	$name 		= (isset( $_POST['name'])) 	? $_POST['name'] : "" ; 
	$descripion = (isset( $_POST['descripion'])) ? $_POST['descripion'] : "" ;
	$category 	= (isset( $_POST['category'])) 	? $_POST['category'] : "" ;
	$count 		= (isset( $_POST['count'])) 	? $_POST['count'] : "" ;
	$configList = (isset( $_POST['configparams'])) 	? $_POST['configparams'] : "" ;
	
	doAddProduct($name,$descripion, $category, $count, $configList);
}


//------------------ utility methodes
function getAllCategoryList() {
	$result = getAllCategoryListDB();
	$list_array = array();
	
	while($row = mysql_fetch_array($result)){	
		$array = array( "category" => $row["category"]);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}

function getConfigList($category){
	$result = getConfigListDB($category);
	
	$list_array = array();
	while($row = mysql_fetch_array($result)){	
		$array = array( "config" => $row["config"], "unit" => $row["unit"]);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}

function doAddProduct($name,$descripion, $category, $count, $configList){
	echo $configList;	
	$json_decoded = json_decode($configList);
	echo $json_decoded;
	//$result = doAddProductDB($name,$descripion, $category, $count, $configList);
} 