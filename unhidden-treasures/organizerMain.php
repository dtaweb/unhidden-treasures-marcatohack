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
?>
<?php		

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
	<div id="content">
		<div id="organizer-login-register">
			<div id="organizer-login"><img src="images/organizer-login.png"></div>
			<div id="organizer-register"><a href="organizerSignup.php"><img src="images/organizer-register.png"></a></div>
		</div>
		<div id="organizer-email"></div>		
		<div id="organizer-password"></div>		
		<div id="organizer-password-retype"></div>		
		<div id="organizer-submit-footer">
			<div id="organizer-submit-pad"></div>
			<div id="organizer-submit"><img src="images/organizer-submit.png"></div>
		</div>	
	</div>
</div>
</body>
</html>
		<?php		
	}
?>