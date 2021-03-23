<?php
	//load_subject.php
	require "Config.php";
	$output='';
	if(isset($_POST['sem_id'])){
		if($_POST['sem_id'] !='')
		{
			$sql="select * from paper";
			$result=mysql_query($sql,$connect);
			$output='<fieldset><legend>Select Subject</legend>
					<select name="paper" id="paper" required=""><option value="">Selct Subject</option>';
			while ($row=mysql_fetch_array($result)) {
					$output.='<option value='.$row["paper_id"].'>'.$row["paper_name"].'</option>';
			}
			$output.="</select></fieldset>";
		}
		echo $output;
	}

?>