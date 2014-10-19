<?php
	//edit organzier info
	//check if logged in
	session_start();
	include_once("dbinfo.php");
	$conn = mysql_connect($dbhost,$username, $password) or die(mysql_error());
	$db = mysql_select_db($dbname, $conn) or die(mysql_error());

	$user_id = $_SESSION['user_id4'];
	$last_access=0;
	$sql = "SELECT last_access FROM current_sessions WHERE session_id = '$_SESSION[sessionid]' AND user_id = '$_SESSION[user_id4]'";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_array($result))
	{
		$last_access = $row["last_access"];
	}
	$current_time=time();
	$elapsed_time=$current_time-$last_access;

	if ($elapsed_time<$expire_limit) {
		$sql = "UPDATE current_sessions SET last_access='$current_time' WHERE session_id = '$_SESSION[sessionid]' AND user_id = '$_SESSION[user_id4]'";
		$result = mysql_query($sql) or die(mysql_error());

		$sql = "SELECT email FROM users WHERE user_id='$user_id' AND user_category='2'";
		$result = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($result))
		{
			$email = $row["email"];
		}
?>
Edit information below: <br /><br >
<form action="./checkOrganizerSave.php" method="POST">
	Email: <input type="text" name="email" value="<?php echo "".stripslashes($email).""; ?>" />
	<br /><br />
	Password: <input type="password" name="password1" value="" /> (leave blank to leave unchanged) 
	<br /><br />
	Retype Password: <input type="password" name="password2" value="" /><br /><br />
	<input type="submit" name="submit" value="submit" />
</form>

<?php		
		mysql_close($conn);
	} else {
		//otherwise
		//choose signup or login
         mysql_close($conn);
		header("Location:./chooseEventType.php");   
	}
?>