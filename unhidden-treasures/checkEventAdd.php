<?php
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

		//error check new event
		$event_name = $_POST['event_name'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$start_time = $_POST['start_time'];
		$end_time = $_POST['end_time'];
		$category_id = $_POST['category_id'];
		$description = $_POST['description'];
		$theme = $_POST['theme'];
		$location = $_POST['location'];
		$gps = $_POST['gps'];
		$contact = $_POST['contact'];
		
		$errors=0;
		if (empty($event_name)) $errors=1;
		if (empty($start_date)) $errors=2;
		if (empty($start_time)) $errors=3;
		if (empty($end_time)) $errors=4;
		if (empty($category_id)) $errors=5;
		if (empty($description)) $errors=6;
		if (empty($theme)) $errors=7;
		if (empty($location)) $errors=8;
		if (empty($contact)) $errors=9;

		if ($errors>0) {
?>
Add Event Information below (check errors below - items with <font color="red"><B>*</B></font> are required): <br /><br >
<form action="./checkEventAdd.php" method="POST">
	Event Name
	<?php if (empty($event_name)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <input type="text" name="event_name" value="<?php echo "".stripslashes($event_name).""; ?>" /><br />
	Start Date
	<?php if (empty($start_date)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <input type="text" name="start_date" value="<?php echo "".stripslashes($start_date).""; ?>" /><br />
	End Date: <input type="text" name="end_date" value="<?php echo "".stripslashes($end_date).""; ?>" /><br />
	Start Time
	<?php if (empty($start_time)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <input type="text" name="start_time" value="<?php echo "".stripslashes($start_time).""; ?>" /><br />
	End Time
	<?php if (empty($end_time)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <input type="text" name="end_time" value="<?php echo "".stripslashes($end_time).""; ?>" /><br />
	Category
	<?php if (empty($category_id)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <select name="category_id"><option value=""></option>
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
	Description
	<?php if (empty($description)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <textarea name="description"><?php echo "".stripslashes($description).""; ?></textarea><br />
	Theme
	<?php if (empty($theme)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <select name="theme"><option value=""></option>
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
	Location
	<?php if (empty($location)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <input type="text" name="location" value="<?php echo "".stripslashes($location).""; ?>" /><br />
	GPS: <input type="text" name="gps" value="<?php echo "".stripslashes($gps).""; ?>" /><br />
	Contact Information
	<?php if (empty($contact)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <textarea name="contact"><?php echo "".stripslashes($contact).""; ?></textarea><br /><br />	
	<input type="submit" name="submit" value="submit" />
</form>
<?php 			
		} else {
		
			echo "no errors";
				mysql_close($conn);
		
		}
		
	} else {
		//otherwise
		//choose signup or login
        mysql_close($conn);
		header("Location:./organizerLogin.php");   
	}
?>
