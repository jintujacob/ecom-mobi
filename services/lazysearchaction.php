<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/lazysearchmanagementfunction.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "searchproduct")
{
	$searchkey  = (isset( $_POST["searchkey"] ))  ? $_POST["searchkey"] 	: "" ;	
	$data = explode(" ",$searchkey);
	getProductList($data);
}


function setUIContentNavigator($pagecontent){
	//pagecontent should be either "product" | "seller"
	//set to session
	$_SESSION['content_navigator'] = $pagecontent;
}

function getUIContentNavigator(){
	echo json_encode(array("content_navigator"=>$_SESSION['content_navigator']));
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