<?php
	require "Config.php";
	if($_POST['id']){
		foreach ($_POST['id'] as $id) {
			$sql="DELETE from user Where uid=".$id;
			mysql_query($sql,$connect);
		}
	}
?>