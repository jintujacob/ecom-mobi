<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);



include('../dbfunctions/productcomparefunctions.php');
//$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;
$action 	= (isset( $_GET['action'])) 	? $_GET['action'] 	: "" ;

if($action == "getAllCategoryList"){
	getAllCategoryList();
}
if($action=="compareProductList"){	//$products=$_POST['productlist'];
	$products=$_GET['productlist'];
    doPopulateComparisonResult($products);		
}	



//------------------ utility methodes
function doPopulateComparisonResult($products){
	//print_r($products);
	$productlist=explode("|",$products);
	
	$master_array = array();
	for ($i=0; $i <count($productlist); $i++) {
		$prod_id=11;
		$singleproduct=populateProductInfo($prod_id); 
	    array_push($master_array, $singleproduct);
	}
	echo json_encode($master_array);

}
function getAllCategoryList() {
	$result = getAllCategoryListDB();
	$list_array = array();
	
	while($row = mysql_fetch_array($result)){	
		$array = array( "category" => $row["category"]);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}

function populateProductInfo($prod_id){
	$productinfo=array();
	$result=dogetBasicproductInfoDB($prod_id);
	while($row=mysql_fetch_array($result)){
		print_r($result);
		$productinfo[]=$row["name"];
		$productinfo[]=$row["prod_id"];
		$productinfo[]=$row["sellerid"];
		$productinfo[]=$row["description"];
		$productinfo[]=$row["category"];
		$productinfo[]=$row["count"];
	}
	$result1=dogetProductConfigDB($prod_id);
	while($row=mysql_fetch_array($result1)){
		$configval="";
		if($row["string_value"==""]){
		   $configval=$row["int_value"];
		}	
       else {
    	$configval=$row["string_value"];
       }
		$productinfo[]=$configval;
		
		return $productinfo;
		
	}
			

}
?>


