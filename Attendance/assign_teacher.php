<?php
	$pagetitle="Assign Teacher";
	require "Config.php";
	session_start();
	require "include\header.php";
	function fill_teacher($connect){
		$output ="";
		$sql="select * from user where type='t'";
		$result=mysql_query($sql,$connect);
		while ($row=mysql_fetch_array($result)) {
			$output.='<option value='.$row["uid"].'>'.$row["firstname"].' '.$row['lastname'].'</option>';
		}
		return $output;
	}
	function fill_subject($connect){
		$output="";
		$sql="Select * from paper";
		$result=mysql_query($sql,$connect);
		while($row=mysql_fetch_assoc($result)){
			$output.='<option value='.$row["paper_id"].'>'.$row["paper_name"].'</option>';
		}
		return $output;
	}
	if(isset($_POST['submit']))
	{	
		$uid=$_POST['teacher_id'];
		$paper_id=$_POST['paper_id'];
		$sql="Select * from teaches where uid=$uid and paper_id=$paper_id";
		$result=mysql_query($sql,$connect);
		if(mysql_num_rows($result)>0)
				{
					echo "<script>alert('You have Already Assign this Subject to this Teacher  ');</script>";
				}
			else{
			$qry="INSERT INTO teaches VALUES ($uid,$paper_id)";
			//echo $qry;
			$result=mysql_query($qry,$connect);
			if($result){
				echo "<script>alert('Subject Assign Successfully');</script>";
			}
			else{
				echo "<script>alert('!Subject Assign Unsuccessfull');</script>".mysql_error();
			}
		}
	}
?>
<div>
	<form method="post">
	<fieldset>
		<legend>Select Teacher</legend>
	<div class="container">
	<H3>
		<select name="teacher_id" required="">
			<option value="">Select Teacher</option>
			<?php echo fill_teacher($connect); ?>
		</select>
		<br/><br/>
		<fieldset>
		<div class="row">
		<select name="paper_id" required="">	
			<option value="">Select Subject</option>
			<?php echo fill_subject($connect);?>
		</select>
		</div>
		</fieldset>
	</H3>
</div>
    <div><input type="submit" name="submit" value="Assign" class="btn-pri"></div>
	</fieldset>
</form>

</div>