<?php 
	$pagetitle="Select Semester";
	require "Config.php";
	session_start();
	require "include\header.php";
	if(isset($_SESSION['se_id']))
	{
		unset($_SESSION['se_id']);
	}
	if(isset($_POST['send'])){
		$attdate=date('y-m-d');
		$se_id=$_POST['session_id'];
		$sql="SELECT att_date from att_table where se_id=$se_id and att_date='$attdate'";
		$result=mysql_query($sql,$connect);
		if(mysql_num_rows($result)>0){
			echo "<div><h2 style=' display :block;background-color:white;width:100%;color: red;text-align: center;height: 32px;font-size:30px;'>Today Attendance Already taken </h2></div>";
			}
			else{
				$_SESSION['se_id']=$se_id;
				header("location: take_attendance.php");
			}
		}
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
	<form method="post" action="">
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
    <div><input type="submit" name="send" value="Go" class="btn-save"></div>
	</fieldset>
</form>
</div>