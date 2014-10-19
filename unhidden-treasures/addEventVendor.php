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
		
		//add a new vendor to the selected event
		$event_id=$_GET['event'];
		$eItemID=$_GET['eitem'];
		
		if (isset($eItemID)) {
			$sql = "SELECT tableNumber FROM event_items WHERE eventID = '$event_id' AND eItemID = '$eItemID'";
			$result = mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($result))
			{
				$tableNumber = $row["tableNumber"];
			}
			echo "<H3>Table $tableNumber successfully added to event</H3>";
				
		}
?><div style="overflow:hidden"><div style="float:left">
Add Event Information below (fields with <font color="red"><B>*</B></font> are required): <br /><br >
<form action="./checkEventVendorAdd.php" method="POST"><input type="hidden" name="event_id" value="<?php echo "".stripslashes($event_id).""; ?>" />
Vendor Name
	: <input type="text" name="vendor_name" value="<?php echo "".stripslashes($vendor_name).""; ?>" /><br />
	Vendor Contact Info
	: <input type="text" name="vendor_contact" value="<?php echo "".stripslashes($vendor_contact).""; ?>" /><br />
	Table/Booth Info
	<?php if (empty($table_info)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <input type="text" name="table_info" value="<?php echo "".stripslashes($table_info).""; ?>" /><br />
	Item Description
	<?php if (empty($description)) echo "<font color=\"red\"><B>*</B></font>"; ?>
	: <textarea name="description"><?php echo "".stripslashes($description).""; ?></textarea><br /><br />
	Category<font color="red"><B>*</B></font>:<br /> 
<?php 
	$sql = "SELECT iCategoryID, iCategory FROM item_categories order by iCategory ASC";
	$result = mysql_query($sql) or die(mysql_error());
	$i=0;
	while ($row = mysql_fetch_array($result))
	{
		$i++;
		$iCategoryID = $row["iCategoryID"];
		$iCategoryType = $row["iCategory"];
		echo "<input type=\"checkbox\" name=\"categories[]\" value=\"$iCategoryID\" ";
		echo " />$iCategoryType &nbsp;&nbsp;&nbsp;";
		if ($i!=0 && $i%3==0) echo "<br />";
	}	
?>
	<br /><br />
<?php /*	Price (Min)
	: <input type="text" name="price_min" value="<?php echo "".stripslashes($price_min).""; ?>" /><br />
	Price (Max)
	: <input type="text" name="price_max" value="<?php echo "".stripslashes($price_max).""; ?>" /><br /><br />
*/ ?>
	<input type="submit" name="submit" value="submit" />
</form>
</div><div style="float:left"><img src="images/addVendorMockup.jpg"></div>
</div>
<?php 		
		
	} else {
		//otherwise
		//choose signup or login
		mysql_close($conn);
		header("Location:./chooseEventType.php");
	}
		
?>