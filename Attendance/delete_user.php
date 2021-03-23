<?php
	require "Config.php";
	$pagetitle="Delete User";
	session_start();
	require "include\header.php";
	$sql="SELECT * FROM user WHERE type = 's' or type='t' order by uid";
	$result=mysql_query($sql,$connect);
?>
<div>
	<form method="post">
		<?php
		if(mysql_num_rows($result)>0){
			echo "<h2><font color='yellow'>Select User To Delete</font></h2>";
		?>
		<table style="background-color:#00ccff;text-align:center ">
			<tr>
			<th>First Name</th><th>Last Name</th><th>Type</th><th><input type="checkbox" id="checkall">Select All</th>
			</tr>
		<?php
			while($row=mysql_fetch_assoc($result)) {
		?>
			<tr id="<?php echo $row['uid']; ?>">
				<td><?php echo $row['firstname'];?></td>
				<td><?php echo $row['lastname'];?></td>
				<td><?php if($row['type']=='t'){echo "Teacher";}
							else//($row['Type']='s')
								echo "Student";
					?></td>
				<td><input type="checkbox" name="userid[]" class="checkitem" value="<?php echo $row['uid'];?>"></td>
			</tr>
		<?php
			}
			?>
			</table>
			<div></div>
			<div align="center">
				<button type="button" name="btn_del" id="btn_del" class="btn-del">Delete</button></div>
			</div>
		<?php
		}
		else{
			echo "<h2><font color='yellow'>All User Have Been Deleted</font></h2>";
		}
		?>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('#btn_del').click(function(){
			if(confirm("! Are you Sure want to Delete this?")){
				var id=[];
				$(':checkbox:checked').each(function(i){
					id[i]=$(this).val();
				});
				if(id.length===0){
					alert("Please Atleast select one checkbox");
				}
				else{
					$.ajax({
						url:'delete_script.php',
						method:'POST',
						data:{id:id},
						success:function(){
							for(var i=0;i<id.length;i++){
								$('tr#'+id[i]+'').css('background-color','#ccc');
								$('tr#'+id[i]+'').fadeOut('slow');
							}
						}
					});
				}
			}
			else{
				return false;
			}
		});
		$('#checkall').change(function(){
		$('.checkitem').prop("checked",$(this).prop("checked"))
})
	});
</script>
