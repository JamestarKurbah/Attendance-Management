<?php
	//load_subject.php
	require "Config.php";
	session_start();
	$output='';
	if(isset($_POST['se_id'])){
		if($_POST['se_id'] !='')
		{
			$se_id=$_POST['se_id'];	
			$output='<fieldset><legend>Select Date</legend>
					<select name="se_date" id="se_date" required=""><option value="">Selct Date</option>';
			$sql="select distinct(att_date) from att_table where se_id=$se_id";
			$result=mysql_query($sql,$connect);
			while ($row=mysql_fetch_array($result)) {
				$output.='<option value='.$row["att_date"].'>'.$row["att_date"].'</option>';
			}
			$output.="</select></fieldset><br><input type='submit' value='Go' name='submit' class='btn-save'>";
		}
		echo $output;
	}

?>