<html>
 <head>
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" type="text/css" href="css\Style.css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
 </head>
 <header>
 	<img src="image\college_logo.png"><h2 style="text-shadow: 0 3px 0 darkred;font-size: 30px">Shillong College Attendance Management System<h3 style="color:grey ;font-size:20px">Assessed and Recredited by NAAC as Grade A (3.06)<br>
 		Boyce Road Laitumkhrah Shillong -793003 Meghalaya
 	</h3></h2>
 </header>
<?php if(!isset($_SESSION['uid'])) header("location: login.php");
		$link="";
		//echo $_SESSION['uid'].$_SESSION['type'];
	if($_SESSION['type']=='s')
		{ 
			if($_SESSION['approved']==1){
				$link="<h3 class='left'><a href='st_enroll.php'>&nbspEnroll&nbsp</a></h3>
			    <h3 class='left'><a href='st_attendance.php'>&nbspCheck Attendance&nbsp</a></h3>";
			}
			else{
				$link= "<h4><font color='red' style='background-color:white;border-radius:10px'>&nbsp &nbsp Your Account Have Not Yet Been Approved Contact Administrator &nbsp &nbsp </font></h4>";
			}		
		}
	elseif($_SESSION['type']=='t'){
		if($_SESSION['approved']==1){
				$link="<h3 class='left'><a href='select_session.php'>&nbspTake Attendance&nbsp</a></h3>
			    <h3 class='left'><a href='create_session.php'>&nbspCreate Session&nbsp</a></h3>
			    <h3 class='left'><a href='update_attandance.php'>&nbspUpdate Attendance&nbsp</a></h3>
			    <h3 class='left'><a href='Attendance_report.php'>&nbspReport&nbsp</a></h3>";
			}
			else{
				$link= "<h4><font color='red' style='background-color:white;border-radius:10px'>&nbsp &nbsp Your Account Have Not Yet Been Approved Contact Administrator &nbsp &nbsp </font></h4>";
			}
	}
	elseif($_SESSION['type']=='a'){
		$link="<h3 class='left'><a href='userapprove.php'>&nbspApproved User&nbsp</a></h3>
			    <h3 class='left'><a href='assign_teacher.php'>&nbspAssigned Teacher&nbsp</a></h3>
			    
			    <h3 class='left'><a href='delete_user.php'>&nbspDelete User&nbsp</a></h3>";
	}//<h3 class='left'><a href='update_user.php'>&nbspUpdate User&nbsp</a></h3>

?>
<div class="linkpart">
	<h3 class="left"><a href="home.php">&nbspHome&nbsp</a></h3>
	<?php
	echo $link;
	?>
	<h3 class="right"><a href="logout.php">&nbspLogOut&nbsp</a></h3>
</div>