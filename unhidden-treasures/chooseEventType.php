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
		<div id="choose-event-title"><img src="images/my-event.png"></div>		
<?php
	//Include the database connection info.htm
	include_once("dbinfo.php");
	$conn = mysql_connect($dbhost,$username, $password) or die(mysql_error());
	$db = mysql_select_db($dbname, $conn) or die(mysql_error());

	//Choose Type of event. Two choices: (1) Single Vendor or (2) MultiVendor event
	$conn = mysql_connect($dbhost, $username, $password) or die(mysql_error());
	$db = mysql_select_db($dbname, $conn) or die(mysql_error());
	 
	$query = "SELECT uCategoryName, uCategoryID
		FROM user_categories";
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_array($result))
	{
		$uCategoryID = $row['uCategoryID'];
		$uCategoryName = $row['uCategoryName'];
		if ($uCategoryID==1) {
			echo "<div id=\"choose-event-single-vendor\"><a href=\"addEventVendor.php?oid=0\"><img src=\"images/single-vendor.png\"></a></div>";
		}
		if ($uCategoryID==2) {
			echo "<div id=\"choose-event-multiple-vendor\"><a href=\"organizerMain.php\"><img src=\"images/multiple-vendors.png\"></a></div>";
		}
	}
	mysql_close($conn);
	
?>
		<div id="choose-event-footer"><img src="images/my-event-footer.png"></div>
	</div>
</div>
</body>
</html>
