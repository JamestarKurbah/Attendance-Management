<?php
//Attendance_report.php
	$pagetitle="Attendance report";
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
		<legend>Attendance Report</legend>
		<div class="container">
				<select name="session_id" id='session_id' required="">
					<option value="">Select Session</option>
					<?php echo fill_session($connect); ?>
				</select>
				<br/><br/>
	<div class='row' id="show_report">
	</div>
</form>
</div>
<script>
	$(document).ready(function() {
		$('#session_id').click(function(){
			var session_id=$(this).val();
			$.ajax({
				url:"report_script.php",
				method:"POST",
				data:{session_id:session_id},
				success:function(data){
					$('#show_report').html(data);
				}
			});
		});
});
</script>
<?php if(isset($_POST['session_id']))
	{
		unset($_POST['session_id']);
	}
	?>
