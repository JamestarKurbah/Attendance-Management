<?php
	$pagetitle="Student Attendance";
	require "Config.php";
	session_start();
	require "include\header.php";
	function fill_sem($connect){
		$output ="";
		$sql="select * from semester";
		$result=mysql_query($sql,$connect);
		while ($row=mysql_fetch_array($result)) {
			$output.='<option value='.$row["sem_id"].'>'.$row["semester_name"].'</option>';
		}
		return $output;
	}
	/*$Attendance='';
	if(isset($_POST['submit'])){
	 	//$se_id=$_POST['paper'];$uid=$_SESSION['uid'];
		$sql="SELECT s.se_name, att_date, STATUS FROM att_table AS AT, SESSION AS s WHERE s.se_id = AT.se_id AND s.se_id = $se_id and at.uid=$uid";

	}*/
?>
<form method="POST" action="load_Attendance.php">
	<fieldset>
		<legend>Select Semester</legend>
<div class="container">
	<H3>
		<select name="semester" id="semester" required="">
			<option value="">Select Semester</option>
			<?php echo fill_sem($connect); ?>
		</select>
		<br/><br/>
		<div class="row" id="show_subject">
		</div>

	</H3>
</div>
</fieldset>
</form>
<script>
	$(document).ready(function(){
		$('#semester').change(function(){
			var sem_id=$(this).val();
			$.ajax({
				url:"load_semsubject.php",
				method:"POST",
				data:{sem_id:sem_id},
				success:function(data){
					$('#show_subject').html(data);
				}
			});
		});
	});
</script>
<?php
	if(isset($_POST['submit'])){
		unset($_POST['submit']);
	}
?>