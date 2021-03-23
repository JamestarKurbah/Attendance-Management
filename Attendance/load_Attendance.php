<?php
	$pagetitle="Attendance Status";
	require "Config.php";
	session_start();
	
	require "include\header.php";
	//echo $_POST['paper'].$_SESSION['uid'];
	function fill_attendance($connect){
		$Attendance='';
		if(isset($_POST['paper'])){
			$se_id=$_POST['paper'];
			$uid=$_SESSION['uid'];
			$sql="select * from att_table where se_id=$se_id and uid=$uid";
			$result=mysql_query($sql,$connect);
			if(mysql_num_rows($result)>0){ 
				$sql="select se_name from session where se_id=$se_id";
				$qry=mysql_query($sql,$connect);
				while($row=mysql_fetch_assoc($qry)){
					$session_name=$row['se_name'];
				}
				$Attendance.='<legend>Attendance for '.$session_name.'</legend><table style="color:white;text-align:center" border>
				<tr style="background-color:green">
				<td>Date</td><td>Description</td><td>STATUS</td>
				</tr>';
				$sql="SELECT att_date,status FROM att_table AS AT, SESSION AS s WHERE s.se_id = AT.se_id AND s.se_id = $se_id and at.uid=$uid";
				$result=mysql_query($sql,$connect);
					while($row=mysql_fetch_assoc($result)){
						$Attendance.='<td>'.$row['att_date'].'</td><td>Regular Class</td>';
						if($row['status']==1){
							$Attendance.='<td>Present</td></tr>';
						}
						elseif($row['status']==0){
							$Attendance.='<td><font color="red">Absent</td></tr>';
						}
					}
				$Attendance.='</table>';
			}
			else{
				$Attendance="<h2 style=' display :block;background-color:white;width:100%;color: red;text-align: center;height: 32px;font-size:25px;'>There Are no attendance record for This session</h2></div>";
			}
			
		}
	return $Attendance;
	}
?>
<form>
	<div>
		<?php 
			if(isset($_POST['paper'])){
			$se_id=$_POST['paper'];
			$uid=$_SESSION['uid'];
			
			$total_att=mysql_query("select count(distinct(att_date)) as t from att_table where se_id=$se_id",$connect);
				while($db_total=mysql_fetch_assoc($total_att)){
					 $total=$db_total['t']; 
					}
				$qry="select count(status) as a from att_table as at where at.uid=$uid and se_id=$se_id and status=1";
				$qryval=mysql_query($qry,$connect);
				
				while($val=mysql_fetch_assoc($qryval)){
					if(!$total==0){
						echo "<table style='color:white;display:block'><tr><td>Total Class Taken&nbsp</td><td>".$total."</td></tr>";
						$per=($val['a']/$total) * 100;
						echo "<tr><td>Number of Class Attend  &nbsp</td><td>".$val['a']."</td></tr>";
						echo "<tr><td>Percentage   &nbsp</td><td>".round($per,2)."%</td></tr></table>";
						}
						else{
							$output= "<div><h2 style=' display :block;background-color:white;width:100%;color: red;text-align: center;height:
							 32px;font-size:25px;'>There Are no attendance record for This session</h2></div>";
							}
						}
					}
		?>
	</div>
	<div >
		<?php echo fill_attendance($connect); ?>
	</div>

</form>
