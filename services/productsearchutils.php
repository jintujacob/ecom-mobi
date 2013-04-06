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
	$configset = (isset( $_POST['configset'])) 	? $_POST['configset'] : "" ;
	
	doAddProduct($name,$descripion, $category, $count, $configset);
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

function doAddProduct($name, $descripion, $category, $count, $configset){
	$configset = "".$configset;
	$config_array = json_decode($configset);
	//$seller = $_SESSION['username'];
	$seller = "testuser"; //comment this line and uncomment above line
	$keyword_list = array($seller, $name,$descripion, $category, $count);
	
	
	$result_basic = doAddBasicProductInfoDB($seller, $name,$descripion, $category, $count);
	
	
	$product_id = "";
	$product_set = getProductIdDB($seller, $name,$descripion, $category, $count);
	while($row = mysql_fetch_array($product_set)){
			$product_id = $row['prod_id'];
	}
	
	
	foreach ($config_array as $configname => $configval){
		$keyword_list[] = $configval; //append config to keywordlist	
		
		$configtype = geConfigValueType($configname, $category);
		$stringval = "";
		$intval = "";
		
		if($configtype == "string")
			$stringval = $configval ;
		else if($configtype == "int")
			$intval = $configval ;
			
		$result_config = doAddConfigurationDB($product_id, $configname, $stringval, $intval);
	}
	$result_keyword = doAddKeywords($product_id,$keyword_list);
} 


function geConfigValueType($configname, $category){
	$unit = "";
	$returnval = "";
	$configtype_rs = checkConfigValueTypeDB($configname, $category);
	while($row = mysql_fetch_array($configtype_rs)){
		$unit = $row['unit'];
	}
	
	if($unit != "")
		$returnval = "int";	
	else
		$returnval = "string";
	
	return $returnval;
}

function doAddKeywords($product_id,$keyword_list){
	for($i=0; $i< count($keyword_list); $i++){
		doAddKeywordsDB($product_id, $keyword_list[$i]);
	}
}


?>


