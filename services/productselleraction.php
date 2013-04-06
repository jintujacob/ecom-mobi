<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../dbfunctions/useraccesscontrolfunctions.php');

$action 	= (isset( $_POST['action'])) 	? $_POST['action'] 	: "" ;

if($action == "addproducts")
{
	$prod_no        = (isset( $_POST['prod_id'] ))		? $_POST['prod_id'] 	: "" ;	
	$sellerid       = (isset( $_POST['sellerid'])) 	? $_POST['sellerid']: "" ;
	$name 	        = (isset( $_POST['name'])) 	? $_POST['sellerid']: "" ;
	$description	= (isset( $_POST['description'])) 	? $_POST['description']: "" ;
	$category 	= (isset( $_POST['category'])) 	? $_POST['category']: "" ;
	$count 	        = (isset( $_POST['count'])) 	? $_POST['count']: "" ;
	          $data = array( $prod_no, $sellerid, $name, $description, $category, $count,);

	doAddProduct($data);
		
}



/*	TEST CONSIDERATIONS :
 *  --
 *  registration	: select * from login; select * from consumer ; select * from active_sessions; 
 * 
 */
?>
