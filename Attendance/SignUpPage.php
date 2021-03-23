<?php
	$pagetitle="Register Page";
	require "Config.php";
	session_start();
	//require "include\header.php";
 if(isset($_POST['submit']))
		{
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$gender=$_POST['gender'];
			$ContactNo=$_POST['ContactNo'];
			$address=$_POST['address'];
			$email=$_POST['email'];
			$Password=md5($_POST['passwd']);
			$type=$_POST['type'];
			$maxid=0;
			$sql="select max(uid) from user";
			$result=mysql_query($sql,$connect);
			while($row=mysql_fetch_array($result)){
				$maxid=$row['0'];
			}
			if($maxid>0){
				$uid=$maxid+1;
				$approved=0;
			}
			else{
				$uid=1;
				$type='a';
				$approved=1;
			}	
			$email=$_POST['email'];
			$sql_e = "SELECT * FROM user WHERE email='$email'";	
			$result=mysql_query($sql_e,$connect);
			if(mysql_num_rows($result)>0)
				{
					echo "<script>alert('Email Already Exist');</script>";
				}
			else{
					$query=@mysql_query("INSERT INTO user values($uid,'$Password','$fname','$lname','$gender','$address','$email','$ContactNo','$type',$approved)",$connect);
					if($query)
					{
						echo "<script>alert('Register Successfully');</script>";
					}
					else
					{ echo "ERROR".mysql_error(); }		
				}			
		}
 ?>
  <head>
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" type="text/css" href="css\Style.css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
 </head>
<form action="#" method="post" >
	<fieldset>
		<legend><strong>Fill in all The Field</strong></legend>
	<table>
	<div>
		<tr><td><label>First Name </label></td><td><input type="Text" name="fname" placeholder="First Name" required="true" spellcheck="false" pattern="^[A-Za-z ]+$" title="Your Name Must not contain number or Special Character"  
			value="<?=isset($_POST['fname'])?$_POST['fname']:''?>"></td></tr>
	</div>
	<div>
		<tr><td><label>Last Name</label></td><td>
		<input type="Text" name="lname" placeholder="Last Name" required="true" spellcheck="false" pattern="^[A-Za-z ]+$" title="Your Name Must not contain number or Special Character"
		value="<?=isset($_POST['lname'])?$_POST['lname']:''?>"></td></tr>
	</div>
	<div>
		<tr><td><label>Gender</label></td><td style="color: orange"><input type="radio" name="gender" value="M" required="">Male
			<input type="radio" name="gender" value="F" required="">Female</td></tr></div>
	<div>
		<tr><td><label>Contact No.</label></td><td>
		<input type="text" name="ContactNo" required="true" spellcheck="false" pattern="^[0-9]{10}$" title="Incorrect Number Format Or Number is less than 10 digit" 
		value="<?=isset($_POST['ContactNo'])?$_POST['ContactNo']:''?>"></td></tr>
	</div>
	<div>
		<tr><td><label>Address</label></td><td><TEXTAREA type="Text" name="address" required="true" value="<?=isset($_POST['address'])?$_POST['address']:''?>"></TEXTAREA></td></tr>
	</div>
	<div>
		<tr><td><label>User Type</label></td>
			<td style="color: orange"><input type="radio" name="type" value="s" required="">Student
			<input type="radio" name="type" value="t" required="">Teacher</td></tr>
	</div>
	<div>
		<tr><td><label>Username</label></td><td><input type="text" name="email" required="true" value="<?=isset($_POST['email'])?$_POST['email']:''?>"></td></tr>
	</div>
	<div>
		<tr><td><label>Password</label></td><td><input type="Password" name="passwd" required="true" pattern=".{8,}" title="Password Must Contain Atleast 8 Character"></td></tr>
	</div>
	<div><tr><td></td><td><input type="submit" name="submit" value="Register Now" class="btn-pri" onclick=""></td></tr>
		</div><div class="norlink"><tr><td></td><td><label>Already have an account?</label> <a href="login.php">Signin here</a></td></tr></div>
	</table>
</fieldset>
</form>
