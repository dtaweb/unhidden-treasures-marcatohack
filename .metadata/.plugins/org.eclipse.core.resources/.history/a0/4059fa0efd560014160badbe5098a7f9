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
		echo "no errors";
		//add user
		//generate session
		mysql_close($conn);
		//redirect
	} else {
		echo "e:$errors";
		//otherwise redisplay info with error msg
?>
Enter information below: <font color="red"><B>*check errors below</B></font><br /><br >
<form action="./checkOrganizerAdd.php" method="POST">
	Email: <input type="text" name="email" value="<?php echo "".stripslashes($email).""; ?>" />
<?php 
	if (empty($email)) echo "<font color='red'><B>*required</B></font>";
	if (!empty($email) && $valid_email=="no") echo "<font color='red'><B>*check format</B></font>";
	?>	<br /><br />
	Password: <input type="password" name="password1" value="" />
<?php 
	if (empty($password1)) echo "<font color='red'><B>*required</B></font>";
	if (!empty($password1) && $password1!=$password2 ) echo "<font color='red'><B>*passwords do not match</B></font>";
	?>	<br /><br />
	Retype Password: <input type="password" name="password2" value="" /><br /><br />
	<input type="submit" name="submit" value="submit" />
</form>
		
<?php 
		mysql_close($conn);
	}
	?>