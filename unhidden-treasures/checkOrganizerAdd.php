<?php
	//check add organizer signup
	$email = $_POST['email'];	
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	
	$errors=0;
	$valid_email="no";
	$dupe_email="no";
	if (empty($email)) $errors=1;
	if (empty($password1)) $errors=2;
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) { $valid_email="yes"; } else { $errors=3; }

	//Include the database connection info.htm
	include_once("dbinfo.php");
	$conn = mysql_connect($dbhost,$username, $password) or die(mysql_error());
	$db = mysql_select_db($dbname, $conn) or die(mysql_error());
	
	//Choose Type of event. Two choices: (1) Single Vendor or (2) MultiVendor event
	$email = mysql_real_escape_string($email);
	$query = "SELECT user_id FROM users WHERE email='$email'";
	$result = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($result)>0) { $dupe_email="yes"; $errors=4; }

	if (!empty($password1) && $password1!=$password2 ) { $errors=5; }
		
	if ($errors==0) {
	//if OK, 
		//add user
		$query = "INSERT INTO users (email, password, user_category) VALUES ('$email', '$password1', '2')";
		$result = mysql_query($query) or die(mysql_error());
		
		//generate session
		$sql = "SELECT user_id FROM users WHERE email='$email' and password='$password1'";
		$result = mysql_query($sql) or die(mysql_error());
		
		if (mysql_num_rows($result) == 1)
		{
			while ($row = mysql_fetch_array($result))
			{
				$user_id = $row["user_id"];
			}
		
			session_start();
		
			unset($_SESSION['sessionid']);
			unset($_SESSION['user_id4']);
		
			$sessid = session_id();
			$_SESSION['sessionid']=$sessid;
			$_SESSION['user_id4']=$user_id;
		
			$sql = "DELETE FROM current_sessions WHERE user_id = '$user_id'";
			$result = mysql_query($sql) or die(mysql_error());
		
			$current_time=time();
		
			$sql = "INSERT INTO current_sessions (user_id, session_id, last_access) VALUES ('$user_id','$sessid','$current_time')";
			$result = mysql_query($sql) or die(mysql_error());
		
			//echo "user created";
		}
				
		
		mysql_close($conn);
		//redirect
		header("Location:./organizerMain.php");
	} else {
		//echo "e:$errors";
		//otherwise redisplay info with error msg
?>
<html>
<head>
<title>Hackathon_App</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel='stylesheet' href='./style.css' type='text/css' media='all' />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="main-layout">
	<div id="banner"><img src="images/banner.png" width="768" height="296" alt=""></div>
<form action="./checkOrganizerAdd.php" method="POST">
	<div id="content">
		<div id="organizer-login-register">
			<div id="organizer-login"><img src="images/organizer-register2.png"></div>
			<div id="organizer-register"><a href="organizerMain.php"><img src="images/organizer-login2.png"></a></div>
		</div>
		<div id="organizer-email"><input id="organizer-email-input" type="text" name="email" value="<?php echo "".stripslashes($email).""; ?>" />
		<?php 	if (empty($email)) echo "<font color='black' style='font-size:20pt;'><B>*required</B></font>"; ?>
		<?php   if (!empty($email) && $valid_email=="no") echo "<font color='black' style='font-size:20pt;'><B>*invalid</B></font>"; ?>
		</div>		
		<div id="organizer-password"><input id="organizer-password-input" type="password" name="password1" value="" />
		<?php 
			if (empty($password1)) echo "<font color='black' style='font-size:20pt;'><B>*required</B></font>";
			if (!empty($password1) && $password1!=$password2 ) echo "<font color='black' style='font-size:20pt;'><B>*no match</B></font>";
		?>
		</div>		
		<div id="organizer-password-retype"><input id="organizer-password-retype-input" type="password" name="password2" value="" />
		</div>		
		<div id="organizer-submit-footer">
			<div id="organizer-submit-pad"></div>
			<div id="organizer-submit"><input type="image" src="images/organizer-submit.png"></div>
		</div>	
	</div>
</form>
</div>
</body>
</html>
<?php 
		mysql_close($conn);
	}
	?>