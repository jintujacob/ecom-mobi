<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("connection.php");


function doAddEmailDB($data){
	$query ="insert into login ".
			"(	title,
 				description,
 				mail_from,
 				mail_to
 			 ) values ( '".
				$data['title'] 	."', '".
				$data['desc'] 	."', '".
				$data['mail_from'] 	."', '".
				$data['mail_to']	."') " ;
				
	$result=mysql_query($sql);
	echo $query; 
	echo "\n";
	echo $result;
	return $result ;
}


?>