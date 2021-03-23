<?php
	$pagetitle="Create Session";
	require "Config.php";
	session_start();
	require "include\header.php";
	function fill_sem($connect){
		$output ="";
		$sql="select * from paper as p,teaches as t where p.paper_id=t.paper_id and t.uid=".$_SESSION['uid'];
		$result=mysql_query($sql,$connect);
		while ($row=mysql_fetch_array($result)) {
			$output.='<option value='.$row["paper_id"].'>'.$row["paper_name"].'</option>';
		}
		return $output;
	}
	if(isset($_POST['submit'])){
		$session_name=$_POST['se_name'];
		$se_start_date=$_POST['se_start_date'];
		$se_end_date=$_POST['se_end_date'];
		$maxid=0;
			$sql="select max(se_id) from session";
			$result=mysql_query($sql,$connect);
			while($row=mysql_fetch_array($result)){
				$maxid=$row['0'];
			}
			if($maxid>0){
				$se_id=$maxid+1;
			}
			else{
				$se_id=1;
			}	
		$sql_e = "SELECT se_name FROM session WHERE se_name='$session_name'";
		$result=mysql_query($sql_e,$connect);
			if(mysql_num_rows($result)>0)
				{
					echo "<script>alert('Session name already Exist Try another Name');</script>";
				}
			else{
				$paper_id=$_POST['paper_id'];
				$uid=$_SESSION['uid'];
				//echo $uid.$paper_id;
				$sql="INSERT INTO session VALUES($uid,$se_id,'$session_name','$se_start_date','$se_end_date',$paper_id)";
				$query=mysql_query($sql,$connect);
				if($query)
					{
						echo "<script>alert('Session Created Successfully');</script>";
					}
					else
					{ echo "ERROR".mysql_error(); }
				}
			}

?>
<div>
	<form method="post">
	<fieldset>
		<legend>Create Session</legend>
	<div class="container">
			<label>Select Paper</label>
			<select name="paper_id" required="">
				<option value="">Select Paper</option>
				<?php echo fill_sem($connect); ?>
			</select>
			<br/><br/>
		<div>
			<label>Session Name</label>
			<input type="Text" name="se_name" required><br/><br/>
			<label>Session Start Date</label>
			<input type="date" name="se_start_date" required ><br/><br/>
			<label>Session End Date</label>
			<input type="date" name="se_end_date" required ><br/><br/>
		</div>
	</div>
    <div><input type="submit" name="submit" value="Create" class="btn-pri"></div>
	</fieldset>
</form>
</div>