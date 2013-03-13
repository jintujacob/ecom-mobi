
<?php
	$con = mysql_connect("localhost","root","abc");
	if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}
  	mysql_select_db("iek", $con);
  	
  	// mysql_close($con);
?>