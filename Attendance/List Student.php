<?php 
	include "Config.php";
	$pagetitle="Attendance";
	if(isset($_POST['submit']))
	{
		foreach ($_POST['attendance_status'] as $id => $attendance_status) {
			$student_ID=$_POST['student_ID'][$id];
			$attdate=date("y-m-d");
			$sql="INSERT INTO attendance_table(semester_ID,student_id,subject_id,Attend,Date) VALUES ('6','$student_ID','2','$attendance_status','$attdate')";
			$result=mysql_query($sql,$connect);
			if(!$result){
			 	die(mysql_error());}

			}

	}
?>
<html>
<body>
<?php  
	session_start();
	require "include\header.php";
	$sql="select firstname,lastname from user";
	$result=mysql_query($sql,$connect);
	if(!$result){ die(mysql_error);}
?>
<form action="List Student.php" method="Post">
	<table>
	<tr>
	<th>Student Name</th><th>Rollno</th><th>Attendance</th>
	</tr>
	<?php
	$counter=0;
		while($row=mysql_fetch_assoc($result)){
	?>	
			<tr>
				<td><?php echo $row['firstname']." "; echo $row['lastname'];?> 
				<input type="hidden" value="<?php //echo $row['student_ID']; ?>" name="student_ID[]"></td>
				
				<td> <?php //echo  $row['roll_no']; ?></td>
				<td>
					<input type='radio' name="attendance_status[<?php echo $counter; ?>]" value='1'>Present
					<input type='radio' name='attendance_status[<?php echo $counter; ?>]' value='0'>Absent
				</td>
			</tr>
<?php $counter++; }	?>
	</table>
	<input type="submit" name="submit" value='save' class="btn-pri">
	</form>
</body>

</html>
