<?php
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
		

	//if logged in, choices are:

		//edit profile
		echo "<a href=\"editOrganizer.php\">Edit Profile</a><br /><br /><br />";
		//landing page for organizer
		//add new event
		echo "<a href=\"addEvent.php\">Add New Event</a><br /><br /><br />";
		//edit latest event
		$sql = "SELECT eventID, eventName, eventStartDate, eventEndDate FROM events WHERE createdBy = '$user_id'";
		$result = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($result))
		{
			$eventID = $row["eventID"];
			$eventName = $row["eventName"];
			$eventStartDate = $row["eventStartDate"];
			$eventEndDate = $row["eventEndDate"];
			echo "<a href=\"editEvent.php?eid=$eventID\">Edit: $eventName [$eventStartDate]</a><br /><br /><br />";
		}
		
	} else {	
	//otherwise
		//choose signup or login
		echo "<a href=\"organizerLogin.php\">Organizer Log In</a><br /><br /><br />";
		echo "<a href=\"organizerSignup.php\">Organizer Signup</a><br /><br /><br />";
	}
?>