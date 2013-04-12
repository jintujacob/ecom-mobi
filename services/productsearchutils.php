<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

include('../dbfunctions/productsearchfunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "getAllCategoryList"){
	getAllCategoryList();
}

if($action == "getConfigList"){
	$category 	= (isset( $_POST['category'])) 	? $_POST['category'] 	: "" ;
	getConfigList($category);
}

if($action == "getSellerCategoryList"){
	$seller		= (isset( $_POST['seller'])) 	? $_POST['seller'] 	: "" ;
	getSellerCategoryList($seller);
}

if($action == "getProductsUnderCategoryList"){
	$seller		= (isset( $_POST['seller'])) 	? $_POST['seller'] 	: "" ;
	$category		= (isset( $_POST['category'])) 	? $_POST['category'] 	: "" ;
	getProductsUnderCategoryList($seller,$category);
}

if($action == "getSoloProduct"){
	$prod_id		= (isset( $_POST['prod_id'])) 	? $_POST['prod_id'] 	: "" ;
	getSoloProductInfo($prod_id);
}


if ($action == "addProductBasic"){
	
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

function getSellerCategoryList($seller) {
	$result = getSellerCategoryListDB($seller);
	$list_array = array();
	
	while($row = mysql_fetch_array($result)){	
		$array = array( "category" => $row["category"]);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}

function getProductsUnderCategoryList($seller,$category) {
	$result = getProductsUnderCategoryListDB($seller,$category);
	$list_array = array();
	
	while($row = mysql_fetch_array($result)){	
		$array = array(
						"name" => $row["name"],
						"description" => $row["description"],
						"prod_id" => $row["prod_id"]
						);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}

function getSoloProductInfo($prod_id) {
	$result = getSoloProductInfoDB($prod_id);
	$list_array = array();
	
	while($row = mysql_fetch_array($result)){	
		$array = array(
					  "string_value" => $row["string_value"],
					  "int_value" => $row["int_value"],
		              "config" => $row["config"],
		              "unit" => $row["unit"]
					  );
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}
 