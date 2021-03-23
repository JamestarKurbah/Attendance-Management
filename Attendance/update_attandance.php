<?php 
	$pagetitle="Update Attendance";
	require "Config.php";
	session_start();
	require "include\header.php";
	if(isset($_SESSION['se_id']))
	{
		unset($_SESSION['se_id']);
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
	<form method="post" action="view_attendance.php">
		<fieldset>
		<legend>Select Session</legend>
		<div class="container">
				<select name="session_id" id="session_id" required="">
					<option value="">Select Session</option>
					<?php echo fill_session($connect); ?>
				</select>
				<br/><br/>
			<div class="row" id="att_date">

		</div>
	</fieldset>
</form>
</div>
<script>
	$(document).ready(function(){
		$('#session_id').change(function(){
			var se_id=$(this).val();
			$.ajax({
				url:"select_date.php",
				method:"POST",
				data:{se_id:se_id},
				success:function(data){
					$('#att_date').html(data);
				}
			});
		});
	});
</script>