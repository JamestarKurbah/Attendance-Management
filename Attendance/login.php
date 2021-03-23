<html>
	<head>
	<title>Attendance Management System</title>
	<link type="text/css" href='css/login.css' rel='stylesheet'>
	</head>
<body>
	<?php
	require "Config.php";
	session_start();
	if(isset($_SESSION['uid'])){ header("location: home.php");}
	if(isset($_POST['submit']))
	{
		$sql="select uid,email,passwd,type,approved from user where email='".$_POST['email']."' and passwd=md5('".$_POST['passwd']."')";
		$result=mysql_query($sql,$connect);
		while ($row=mysql_fetch_array($result)) {
						$_SESSION['uid']=$row['uid'];
						$_SESSION['type']=$row['type'];
						$_SESSION['approved']=$row['approved'];
					}
				if(mysql_num_rows($result)>0)
				{
					header("location: home.php");
				}
				else
				{
					echo "<div class='alert'><h2 style='color:red'>Invalid Username or Password</h2></div>";
				}
	}

	?>
	<div style="background-color: lightblue">
	<h2 style="text-shadow: 0 3px 0 darkred;font-size: 40px;text-align: center;padding-top: 20px;color:orange">Welcome to Shillong College Attendance Management System</h2></div>
	<form method="post" action="login.php">
		<fieldset>
			<legend style="text-shadow:0 2px 0 darkred;color: orange;font-size: 25px">Please Sign In</legend>
		<table>
		<div>
		<tr><td><label>Username</label></td><td><input type="text" name="email" required="true" placeholder="Username" value="<?=isset($_POST['email'])?$_POST['email']:''?>"></td></tr>
		</div>
		<div>
		<tr><td><label>Password</label></td><td><input type="Password" name="passwd" required="true"></td></tr>
		</div>
		<div><tr><td></td><td><input type="submit" name="submit" value="Login" class="btn-pri" ></td></tr>
		</div></table>
		<div><a href="SignUpPage.php"><h4>Don't have an account Register here for free</h4></a></div>
		
		</fieldset>
</form>
</body>
</html>
<?php if(isset($_POST['submit'])){unset($_POST['submit']);} ?>
