<?php
	//Add a new event
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
?>
Add Event Information below (items with <font color="red"><B>*</B></font> are required): <br /><br >
<form action="./checkEventAdd.php" method="POST">
	Event Name<font color="red"><B>*</B></font>: <input type="text" name="event_name" value="" /><br />
	Start Date<font color="red"><B>*</B></font>: <input type="text" name="start_date" value="" /><br />
	End Date: <input type="text" name="end_date" value="" /><br />
	Start Time<font color="red"><B>*</B></font>: <input type="text" name="start_time" value="" /><br />
	End Time<font color="red"><B>*</B></font>: <input type="text" name="end_time" value="" /><br />
	Category<font color="red"><B>*</B></font>: <select name="category_id"><option value=""></option>
<?php 
	$sql = "SELECT eCategoryID, eCategoryType FROM event_categories";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_array($result))
	{
		$eCategoryID = $row["eCategoryID"];
		$eCategoryType = $row["eCategoryType"];
		echo "<option value=\"$eCategoryID\" ";
		if ($eCategoryID==$category_id) echo " selected ";
		echo ">$eCategoryType</option>";
	}	
?>
	</select><br />
	Description<font color="red"><B>*</B></font>: <textarea name="description"></textarea><br />
	Theme<font color="red"><B>*</B></font>: <select name="theme"><option value=""></option>
<?php 
	$sql = "SELECT eThemeID, eTheme FROM event_themes";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_array($result))
	{
		$eThemeID = $row["eThemeID"];
		$eTheme = $row["eTheme"];
		echo "<option value=\"$eThemeID\" ";
		if ($eThemeID==$theme) echo " selected ";
		echo ">$eTheme</option>";
	}	
?>
	</select><br />
	Location<font color="red"><B>*</B></font>: <input type="text" name="location" value="" /><br />
	GPS: <input type="text" name="gps" value="" /><br />
	Contact Information<font color="red"><B>*</B></font>: <textarea name="contact"></textarea><br /><br />	
	<input type="submit" name="submit" value="submit" />
</form>

		
<?php		
		mysql_close($conn);
		
	} else {
		//otherwise
		//choose signup or login
        mysql_close($conn);
		header("Location:./organizerLogin.php");   
	}
?>