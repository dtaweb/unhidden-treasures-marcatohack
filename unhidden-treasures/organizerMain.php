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
		<div id="organizer-home"><img src="images/organizer-home.png"></div>
		<div id="organizer-edit"><a href="editOrganizer.php"><img src="images/organizer-edit.png"></a></div>		
		<div id="organizer-new-event"><a href="addEvent.php"><img src="images/organizer-new-event.png"></a></div>		
		<div id="organizer-existing-event">
<?php 
$sql = "SELECT eventID, eventName, eventStartDate, eventEndDate FROM events WHERE createdBy = '$user_id' order by eventID DESC LIMIT 1";
$result = mysql_query($sql) or die(mysql_error());
while ($row = mysql_fetch_array($result))
{
	$eventID = $row["eventID"];
	$eventName = $row["eventName"];
	$eventStartDate = $row["eventStartDate"];
	$eventEndDate = $row["eventEndDate"];
}
if ($eventID!="") {
	echo "<a href=\"editEvent.php?eid=$eventID\"><img src=\"images/organizer-existing-event.png\"></a>";
} else {
	echo "<img src=\"images/organizer-existing-event-noshow.png\">";
}	
?>		</div>		
	</div>
</div>
</body>
</html>
<?php		

	//if logged in, choices are:
/*
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
*/				
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
<form action="./authenticateOrganizer.php" method="POST">
	<div id="content">
		<div id="organizer-login-register">
			<div id="organizer-login"><img src="images/organizer-login.png"></div>
			<div id="organizer-register"><a href="organizerSignup.php"><img src="images/organizer-register.png"></a></div>
		</div>
		<div id="organizer-email"><input id="organizer-email-input" type="text" name="email" value="" /></div>		
		<div id="organizer-password"><input id="organizer-password-input" type="password" name="password1" value="" /></div>		
		<div id="organizer-submit-footer2">
			<div id="organizer-submit-pad2"></div>
			<div id="organizer-submit2"><input type="image" src="images/organizer-submit2.png"></div>
		</div>	
	</div>
</form>
</div>
</body>
</html>
		<?php		
	}
?>