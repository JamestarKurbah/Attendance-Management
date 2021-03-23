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
			$output.='<option value='.$row["sem_id"].'">'.$row["semester_name"].'</option>';
		}
		return $output;
	}
?>
<form>
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
		<div class="row" id="show_subject">
		</div>
		</fieldset>
	</H3>
	
</div>
</fieldset>
</form>
<script>
	$(document).ready(function(){
		$('#semester').change(function(){
			var sem_id=$(this).val();
			$.ajax({
				url:"load_subject.php",
				method:"POST",
				data:{sem_id:sem_id},
				success:function(data){
					$('#show_subject').html(data);
				}
			});
		});
	});
</script>