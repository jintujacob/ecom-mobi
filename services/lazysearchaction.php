<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/lazysearchmanagementfunction.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;
$action_get = (isset( $_GET['action'])) 	? $_GET['action'] 	: "" ;

if($action == "searchproduct")
{
	$searchkey  = (isset( $_POST["searchkey"] ))  ? $_POST["searchkey"] 	: "" ;	
	$data = explode(" ",$searchkey);
	getProductList($data);
}
if($action_get == "getProdListByKey"){
	
	$category 	= (isset( $_GET['category'])) 	? $_GET['category'] 	: "" ;
	$term 		= (isset( $_GET['term'])) 		? $_GET['term'] 		: "" ;
	
	getItemsUnderCategoryByKey($category, $term);
}

function getItemsUnderCategoryByKey($category, $term){
	$result = getItemsUnderCategoryByKeyDB($category, $term);
		
	$return_array = array();
	while($row = mysql_fetch_array($result)){	
		$return_array[] = $row['name']."  .".$row['prod_id']."" ;
	}
	
	echo json_encode($return_array);
}


function getProductList($data)
{
    $result= getProductListDB($data);
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
 
 ?>