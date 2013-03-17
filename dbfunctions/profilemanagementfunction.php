<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function doAddProfileDB($data  ){

$query ="insert into sellerprofile ".
			"(	display_name  ,
				operator_name ,
				email         ,
				address       ,
				zipcode       ,
				ph_no         ,
				landmark      ,
				near_city     ,
				latitude      ,
				longitude 
 			 )values ( '".
				
				$data[0] 	."', '".
				$data[1] 	."', '".
				$data[2] 	."', '".
				$data[3] 	."', '".
				$data[4] 	."', '".
				$data[5] 	."', '".
				$data[6] 	."', '".
				$data[7] 	."', '".
				$data[8] 	."', '".
				$data[9] 	."') " ;
					
	$result = mysql_query($query);
	return $result;		 	
}







?>