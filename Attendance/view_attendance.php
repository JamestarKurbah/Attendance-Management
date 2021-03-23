<?php
	$pagetitle="Update Attendance";
	require "Config.php";
	session_start();
	$output='';
	require "include\header.php";
	if(isset($_POST['se_date']) and isset($_POST['session_id'])){
	$date=$_POST['se_date'];
	$se_id=$_POST['session_id'];
	
	//echo $date."  and ".$se_id;
		$sql="select u.uid,u.firstname,u.lastname,status from user as u,att_table as at where u.uid=at.uid and se_id=$se_id and att_date='$date' order by u.uid asc";
		$result=mysql_query($sql,$connect);
		while($row=mysql_fetch_assoc($result)){
			$output.='<option value='.$row['uid'].'>'.$row['firstname'].' '.$row['lastname'].'</option>';
		}
	}
	if(isset($_POST['update'])){
		echo $_POST['date'].$_POST['se_id'].$_POST['status'].$_POST['student_id'];
		$status=$_POST['status'];
		$se_id=$_POST['se_id'];
		$date=$_POST['date'];
		$st_id=$_POST['student_id'];
		$sql="update att_table set status=$status where att_date='$date' and se_id=$se_id and uid=$st_id";
		$result=mysql_query($sql,$connect);
		if($result){
			echo "<div><h2 style=' display :block;background-color:white;width:100%;color: green;text-align: center;height: 32px;font-size:30px;'>Attendance update Successfull </h2></div>";
		}
	}

?>
<form method="POST" action="">
	<div>
		<fieldset><legend>Select Student to Update</legend>
			<table ><tr><td><select name="student_id" required="">
			<option value="">Select Student</option>
			<?php echo $output; ?>
			</select></td>
			<td style="color: white;background-color: green;border-radius: 10px;width: 100px">
				<input type="radio" name="status" value="1" required="">Present</td>
			<td style="color: white;background-color: green;border-radius: 10px;width: 100px">
				<input type="radio" name="status" value="0" required="">Absent</td></tr></table>
				<?php if(isset($_POST['se_date']) and isset($_POST['session_id'])){ ?>
				<input type="hidden" name="date" value="<?php echo $date;?>">
				<input type="hidden" name="se_id" value="<?php echo $se_id;?>">
				<?php } ?>
			<br>
			<input type="submit" name="update" value="Update" class="btn-save">
		</fieldset>
	</div>
</form>