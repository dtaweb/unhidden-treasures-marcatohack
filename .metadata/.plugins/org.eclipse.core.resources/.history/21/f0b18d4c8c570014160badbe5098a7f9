<?php
	session_start();
	date_default_timezone_set('UTC');
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
		//error check new vendor add

		$event_id = $_POST['event_id'];
		$vendor_name = $_POST['vendor_name'];
		$vendor_contact = $_POST['vendor_contact'];
		$table_info = $_POST['table_info'];
		$description = $_POST['description'];
		$price_min = $_POST['price_min'];
		$price_max = $_POST['price_max'];
		
		$errors=0;
		if (empty($event_id)) $errors=1;
		if (empty($table_info)) $errors=2;
		if (empty($description)) $errors=3;
		
		if ($errors>0) {
?>
<?php
mysql_close($conn);
} else {

	$sql = "INSERT INTO events
	(eventName, eventStartDate, eventEndDate, eventStartTime, eventEndTime,
	eventCategoryID, eventDescription, createdBy, dateCreated, timeCreated,
	eventThemeID, eventLocation, eventLocationGPS, eventContactInformation)
	VALUES
	('$event_name', '$start_date', '$end_date', '$start_time', '$end_time',
	'$category_id', '$description', '$user_id', '".date("Y-m-d")."', '".time()."',
			'$theme', '$location', '$gps', '$contact')";
			//echo $sql;
			$result = mysql_query($sql) or die(mysql_error());
				
			$sql = "SELECT eventID FROM events WHERE eventName = '$event_name' AND createdBy = '$user_id' AND eventStartDate='$start_date'";
			$result = mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($result))
			{
			$eventID = $row["eventID"];
			}

			mysql_close($conn);
			header("Location:./eventVendors.php?event=$eventID");

				
		}

	} else {
	//otherwise
	//choose signup or login
	mysql_close($conn);
	header("Location:./organizerLogin.php");
}
?>