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

if ($action == "doAddProduct"){
	$name = (isset( $_POST['name'])) ? $_POST['name'] : "" ;
	$descripion = (isset( $_POST['descripion'])) ? $_POST['descripion'] : "" ;
	$category = (isset( $_POST['category'])) ? $_POST['category'] : "" ;
	$count = (isset( $_POST['count'])) ? $_POST['count'] : "" ;
	$configset = (isset( $_POST['configset'])) ? $_POST['configset'] : "" ;
	
	doAddProduct($name,$descripion, $category, $count, $configset);
}

if($action == "getProductConfiguration"){
	$prod_id		= (isset( $_POST['prod_id'])) 	? $_POST['prod_id'] 	: "" ;
	populateProductInfo($prod_id);
}

if($action=="compareProductList"){
	$products=$_POST['productlist'];
	//$products=$_GET['productlist'];
    doPopulateComparisonResult($products);		
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
		 "prod_no" => $row["prod_id"],
		 "sellerid" => $row["sellerid"],
		 "name" => $row["name"],
		 "description" => $row["description"],
		 "category" => $row["category"],
		 "count" => $row["count"]
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

function doAddProduct($name, $descripion, $category, $count, $configset){
	$configset = "".$configset;
	$config_array = json_decode($configset);
	$seller = $_SESSION['username'];
	//$seller = "testuser"; //comment this line and uncomment above line
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

function populateProductInfo($prod_id){
	$return_array = getProductInfoComplete($prod_id);
	echo json_encode($return_array);
}

function getProductInfoComplete($prod_id){
	$productvalue=array();
	$productkey=array();
	
	$resultbasic=dogetBasicproductInfoDB($prod_id);
	$resultconfig=dogetProductConfigDB($prod_id);
	
	while($row=mysql_fetch_array($resultbasic)){
		$productkey[] = "Name" ; 		$productvalue[]=$row["name"];
		$productkey[] = "Product id" ;		$productvalue[]=$row["prod_id"];
		$productkey[] = "Seller" ;	$productvalue[]=$row["sellerid"];
		$productkey[] = "Description" ;	$productvalue[]=$row["description"];
		$productkey[] = "Category" ;	$productvalue[]=$row["category"];
		$productkey[] = "Stock" ;		$productvalue[]=$row["count"];
	}
	while($row=mysql_fetch_array($resultconfig)){
		$unit = $row["unit"];
		if(strlen($unit) > 0) {
			$configval=$row["int_value"];	}
		else {
			$configval=$row["string_value"]; }
		$productkey[] = $row["config_name"] ;	$productvalue[]=$configval." ". $row["unit"] ;
	}

	$productarray = array();
	for($i=0; $i< count($productkey); $i++){
		$productarray[$productkey[$i]] =  $productvalue[$i];
	}

	return $productarray;
}	

function doPopulateComparisonResult($products){
	//print_r($products);
	$productlist=explode("|",$products);
	$master_array = array();
	for ($i=0; $i <count($productlist); $i++) {
		if (is_numeric($productlist[$i])){ 
			$singleproduct=getProductInfoComplete($productlist[$i]) ; 
	    	array_push($master_array, $singleproduct);
		}
		else{
			array_push($master_array, array("Name" => "Invalid Item"));
		}	
	}
	echo json_encode($master_array);
}


?>
