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

		$event_id = $_GET['eid'];
		//edit event info
		//link to event vendors
		$sql = "SELECT eventName FROM events WHERE eventID = '$event_id' AND createdBy = '$user_id'";
		$result = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($result))
		{
			$eventName = $row["eventName"];
		}
		
		echo "<a href=\"addEventVendor.php?event=$event_id\">Add Vendor to $eventName</a><br /><br /><br />";
?>
redo
<?php		
		
		} else {
			//otherwise
			//choose signup or login
			mysql_close($conn);
			header("Location:./chooseEventType.php");
		}
		
?>