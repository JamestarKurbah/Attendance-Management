<?php
	//load_subject.php
	require "Config.php";
	$output='';
	if(isset($_POST['sem_id'])){
		if($_POST['sem_id'] !='')
		{
			
			$sql="select * from paper where sem_id='".$_POST['sem_id']."' and elective=0";
			$result=mysql_query($sql,$connect);
			if($result){
				$output="Compulsory Subject<table>";
				$i=1;
				while ($row=mysql_fetch_array($result)) {
						$output.='<div><tr><td><label>'.$i.')'.$row["paper_name"].
						'</label></td><td><input type="checkbox" name="comsubject[]" value='.$row["paper_id"].' style="display:none" checked ></td></tr></div>';
						$i++;
				}
				$output.="</table>";
				}
			$sql="select * from paper where sem_id='".$_POST['sem_id']."' and elective=1";
			$result=mysql_query($sql,$connect);
			if(mysql_num_rows($result)>0){
					if($result){
						$output.="Elective Subject<table>";
					$i=1;
					while ($row=mysql_fetch_array($result)) {
							$output.='<div><tr><td><label>'.$i.')'.$row["paper_name"].
							'</label></td><td><input type="radio" name="selectedsubject" value='.$row["paper_id"].' required=""></td></tr></div>';
							$i++;
					}
					$output.="</table>";
					}
				}
		}
		echo $output;
	}

?>