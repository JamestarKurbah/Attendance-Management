<?php
	//load_subject.php
	require "Config.php";
	session_start();
	$output='';
	if(isset($_POST['sem_id'])){
		if($_POST['sem_id'] !='')
		{
			$sem_id=$_POST['sem_id'];	
			// echo $sem_id;
			$uid=$_SESSION['uid'];
			$output='<fieldset><legend>Select Subject</legend>
					<select name="paper" id="paper" required=""><option value="">Selct Subject</option>';
			$sql="select se_name,se_id from session as s,st_enroll as st where s.paper_id=st.paper_id and st.uid=$uid and st.semid=$sem_id";
			$result=mysql_query($sql,$connect);
			while ($row=mysql_fetch_array($result)) {
				$output.='<option value='.$row["se_id"].'>'.$row["se_name"].'</option>';
			}
			$output.="</select></fieldset><input type='submit' value='Go' name='submit' class='btn-save'>";
		}
		echo $output;
	}

?>