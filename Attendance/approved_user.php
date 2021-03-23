<?php
	require "Config.php";
	if($_POST['id']){
		foreach ($_POST['id'] as $id) {
			$sql="UPDATE user SET approved=1 Where uid=".$id;
			mysql_query($sql,$connect);
		}
	}
?>