<?php
	//Organizer signup page for muli-vendor event
	//Collect email, password, name
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
<form action="./checkOrganizerAdd.php" method="POST">
	<div id="content">
		<div id="organizer-login-register">
			<div id="organizer-login"><img src="images/organizer-register2.png"></div>
			<div id="organizer-register"><a href="organizerMain.php"><img src="images/organizer-login2.png"></a></div>
		</div>
		<div id="organizer-email"><input id="organizer-email-input" type="text" name="email" value="" /></div>		
		<div id="organizer-password"><input id="organizer-password-input" type="password" name="password1" value="" /></div>		
		<div id="organizer-password-retype"><input id="organizer-password-retype-input" type="password" name="password2" value="" /></div>		
		<div id="organizer-submit-footer">
			<div id="organizer-submit-pad"></div>
			<div id="organizer-submit"><input type="image" src="images/organizer-submit.png"></div>
		</div>	
	</div>
</form>
</div>
</body>
</html>
<?php
	

?>