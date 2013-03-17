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
	// for($i=0;$i<2;$i++)
	//echo $data[$i];
	//echo $data[1];
		
}


 function getProductList($data)
 {
    $result= getProductListDB($data);
    
	$list_array = array();
	while($row = mysql_fetch_array($result)){	
		$array = array( 
			"product_id" => $row["product_id"],
			);
		array_push($list_array, $array);
	}
	echo json_encode($list_array);
}