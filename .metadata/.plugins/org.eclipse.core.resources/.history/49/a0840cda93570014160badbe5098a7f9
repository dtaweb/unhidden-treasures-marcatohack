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
		
		//get event info for reference
		$event_id = $_GET['event'];
		$sql = "SELECT eventName, eventStartDate FROM events WHERE eventID = '$event_id' AND createdBy = '$user_id'";
		$result = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($result))
		{
			$event_name = $row["eventName"];
			$start_date = $row["eventStartDate"];
		}
		echo "$event_name [$start_date]<br /><br />";
		
		//list of vendors for selected event
?>
		<a href="./addEventVendor.php?event=<?php echo $event_id; ?>">Add New Vendor for Event</a><br /><br />
		Edit existing vendors below:<br />
<?php			
		$sql = "SELECT eItemID, vendorName, tableNumber FROM event_items WHERE eventID = '$event_id'";
		$result = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($result))
		{
			$eItemID = $row["eItemID"];
			$vendorName = $row["vendorName"];
			$tableNumber = $row["tableNumber"];
			echo "<a href=\"./editEventVendor.php?evid=$eItemID\">$vendorName [Table Number $tableNumber]</a><br />";
		}
		mysql_close($conn);
		
	} else {
		//otherwise
		//choose signup or login
		mysql_close($conn);
		header("Location:./organizerLogin.php");
	}
			
?>