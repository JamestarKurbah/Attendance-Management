<?php
	$pagetitle="Select Semester";
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
	if(isset($_POST['submit']))
	{	
		$uid=$_SESSION['uid'];
		$sem_id=$_POST['semester'];
		$sql="select * from st_enroll where uid=$uid and semid=$sem_id";
		$result=mysql_query($sql,$connect);
		if(mysql_num_rows($result)>0){
			echo "<script>alert('You have Already enroll To this Semester');</script>";
		}
		else{
			if(isset($_POST['selectedsubject'])){ 
				$elective=$_POST['selectedsubject'];
				$arr=$_POST['comsubject'];
				foreach($arr as $subject) {
					$sql="Insert into st_enroll values ($uid,$sem_id,$subject)";
					mysql_query($sql,$connect);
				}
				$sql="Insert into st_enroll values ($uid,$sem_id,$elective)";
				$result=mysql_query($sql);
				if($result){
				echo "<script>alert('Enrollment Successfull');</script>";
				}
				else{
					echo "<script>alert('Enrollment Unsuccessfull');</script>".mysql_error();
				}
			}
			else{
				$arr=$_POST['comsubject'];
				foreach($arr as $subject) {
						$sql="Insert into st_enroll values ($uid,$sem_id,$subject)";
						if(mysql_query($sql,$connect))
							{ $error=0; }
						else
							{ $error=1; }
					}
					if($error==0){
					echo "<script>alert('Enrollment Successfull');</script>";
					}
					else{
						echo "<script>alert('Enrollment Unsuccessfull');</script>".mysql_error();
					}
			}
		}

	}
?> 
<div>
	<form method="post">
	<fieldset>
		<legend>Select Semester</legend>
	<div class="container">
	<H3>
		<select name="semester" id="semester" required="">
			<option value="">Select Semester</option>
			<?php echo fill_sem($connect); ?>
		</select>
		<br/><br/>
		<fieldset>
		<div class="row" id="show_elective">
		</div>
		</fieldset>
	</H3>
</div>
    <div><input type="submit" name="submit" value="Enroll" class="btn-pri"></div>
	</fieldset>
</form>
</div>
<script>
	$(document).ready(function(){
		$('#semester').change(function(){
			var sem_id=$(this).val();
			$.ajax({
				url:"load_elective.php",
				method:"POST",
				data:{sem_id:sem_id},
				success:function(data){
					$('#show_elective').html(data);
				}
			});
		});
	});
</script>