<?php 
	require "Config.php";
	$output='';
	if(isset($_POST['session_id'])){
		if($_POST['session_id']!='')
		{
			$se_id=$_POST['session_id'];
			$output='<fieldset><legend>Student Attendance Report</legend><table style="color:white;text-align:center" border>';
			$output.='<tr style="background-color:green"><td>Rollno</td><td>firstname lastname</td><td>Attend</td><td>Total<td>Percentage</td></td></tr>';
			$total_att=mysql_query("select count(distinct(att_date)) as t from att_table where se_id=$se_id",$connect);

				while($db_total=mysql_fetch_assoc($total_att)){
					 $total=$db_total['t']; 
				}
					$sql="select uid,firstname,lastname from user where type='s' order by uid asc";
					$result=mysql_query($sql,$connect);
						while($row=mysql_fetch_assoc($result)){
							$st_id=$row['uid'];
							$qry="select count(status) as a from att_table as at where at.uid=$st_id and se_id=$se_id and status=1";
							$qryval=mysql_query($qry,$connect);
								while($val=mysql_fetch_assoc($qryval)){
									if(!$total==0){
									$per=($val['a']/$total) * 100;
									$output.='<tr><td>'.$row['uid'].'</td><td>'.$row['firstname'].' '.$row['lastname'].'</td>
									<td>'.$val['a'].'</td><td>'.$total.'</td><td>'.round($per,2).'%</td></tr>';
									}
									else{
										$output= "<div><h2 style=' display :block;background-color:white;width:100%;color: red;text-align: center;height: 32px;font-size:25px;'>There Are no attendance record for This session</h2></div>";
									}
								}
						}$output.='</table></fieldset>';
			}
			echo $output;
	}
?>