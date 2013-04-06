<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function doAddEmailDB($data){
	$query ="insert into emailbox ".
			"(	title,
 				description,
 				mail_from,
 				mail_to
 			 ) values ( '".
				$data['title'] 		."', '".
				$data['description']."', '".
				$data['mail_from'] 	."', '".
				$data['mail_to']	."') " ;
				
	$result=mysql_query($query);
	
	return $result ;
}


?>