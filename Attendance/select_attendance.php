<?php 
	$pagetitle="Select Semester";
	require "Config.php";
	session_start();
	require "include\header.php";
	function fill_session($connect){
		$output ="";
		$sql="select * from session where uid=".$_SESSION['uid'];
		$result=mysql_query($sql,$connect);
		while ($row=mysql_fetch_array($result)) {
			$output.='<option value='.$row["se_id"].'>'.$row["se_name"].'</option>';
		}
		return $output;
	}

?>
<div>
	<form method="post">
		<fieldset>
		<legend>Select Session</legend>
		<div class="container">
				<select name="session_id" required="">
					<option value="">Select Session</option>
					<?php echo fill_session($connect); ?>
				</select>
				<br/><br/>
			<div>
		</div>
    <div><input type="submit" name="submit" value="Go" class="btn-save"></div>
	</fieldset>
</form>
</div>