<?php 
	$pagetitle="Attendance";
	require "Config.php";
	session_start();
	require "include\header.php";
	//code load automatic selected session
	if(isset($_SESSION['se_id'])){
		$se_id=$_SESSION['se_id'];
		$sql="SELECT paper_id,se_name from session where se_id=$se_id";
		$result=mysql_query($sql,$connect);
		while($row=mysql_fetch_assoc($result))
		{
			$paper_id=$row['paper_id'];
			$se_name=$row['se_name'];
		}
		$_SESSION['se_id']=$se_id;
	}
	// elseif(!isset($_POST['session_id'])){
	// 	header("location: select_session.php");
	// }
	if(isset($_POST['save_attendance']))
	{
		$se_id=$_SESSION['se_id'];
		$attdate=date("y-m-d");
		// echo $attdate;
		// echo $se_id;
		$sql="SELECT att_date from att_table where se_id=$se_id and att_date='$attdate'";
		$result=mysql_query($sql,$connect);
		if(mysql_num_rows($result)>0){
			echo "<div><h2 style=' display :block;background-color:white;width:100%;color: red;text-align: center;height: 32px;font-size:30px;'>Attendance Already taken Today </h2></div>";
			}
		else{
			foreach($_POST['attendance_status'] as $uid => $attendance_status) {
			// echo " ".$id."  ".$attendance_status." session ".$_SESSION['se_id'];
			$sql="INSERT INTO att_table VALUES ($se_id,$uid,'$attdate',$attendance_status)";
			$result=mysql_query($sql,$connect);
			}
			if($result){		
				echo "<div><h2 style=' display :block;background-color:white;width:100%;color: green;text-align: center;height: 32px;font-size:30px;'>Attendance Saved Successfully </h2></div>";	
			unset($_POST['save_attendance']);
			}
		}
		
	}
?>
<div>
	<form method="post" >
		<fieldset>
			<legend>Attendence<?php // echo $se_name; ?></legend>
		<table style="background-color:green;text-align:center">
			<tr><font color="white">
				<th>Name</th><th> Roll No</th><th>Attendance</th></font>
			</tr>
		</table>
		<div></div>
		<table style="background-color:#00ccff;text-align:center ">
			<?php 
			$se_id=$_SESSION['se_id'];
			$sql="SELECT u.uid,firstname,lastname,se_id from user as u,st_enroll as st,session as se where st.uid=u.uid and se.paper_id=st.paper_id and se.se_id=$se_id order by u.uid asc";
			$result=mysql_query($sql,$connect);
			if(!$result){ die(mysql_error());} 
				while($row=mysql_fetch_assoc($result)){
			?>
				<tr>
				<td><?php echo $row['firstname']." "; echo $row['lastname'];?></td>				
				<td> <?php echo  $row['uid']; ?></td>
				<td>
					<input type='radio' name="attendance_status[<?php echo $row['uid']; ?>]" value='1' required="">Present
					<input type='radio' name='attendance_status[<?php echo $row['uid']; ?>]' value='0' required="">Absent
				</td>
			</tr>
			<?php } ?>
		</table>
		<div></div>
    <div><input type="submit" name="save_attendance" value="Save" class="btn-save"></div>
	</fieldset>
</form>
</div>