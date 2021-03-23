<?php
	$connect=@mysql_connect("localhost","root","");
	if(!$connect){die("connection Failed");}
	if(!mysql_select_db("ams",$connect)) {die("Database not found");}

?>
