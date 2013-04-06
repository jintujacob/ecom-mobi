
<?php
	$con = mysql_connect("localhost","root","123");
	if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}
  	mysql_select_db("iekadd", $con);
  	
  	// mysql_close($con);
?>
