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
		
		$categories = $_POST['categories'];
		$category_count = count($categories);
		
		$errors=0;
		if (empty($event_id)) $errors=1;
		if (empty($table_info)) $errors=2;
		if (empty($description)) $errors=3;
		
		if ($errors>0) {
?>
Add Event Information below (check errors below - fields with <font color="red"><B>*</B></font> are required): <br /><br >
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
	Category
	<?php if ($category_count==0) echo "<font color=\"red\"><B>*</B></font>"; ?>
	:<br /> 
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
		for ($j=0; $j<$category_count; $j++) {
			if ($categories[$j]==$iCategoryID) echo " checked ";
		}
		echo " />$iCategoryType &nbsp;&nbsp;&nbsp;";
		if ($i!=0 && $i%3==0) echo "<br />";
	}	
?>
	<br /><br />
	Price (Min)
	: <input type="text" name="price_min" value="<?php echo "".stripslashes($price_min).""; ?>" /><br />
	Price (Max)
	: <input type="text" name="price_max" value="<?php echo "".stripslashes($price_max).""; ?>" /><br /><br />
	<input type="submit" name="submit" value="submit" />
</form>
<?php
mysql_close($conn);
} else {

	$sql = "INSERT INTO event_items
	(eventID, eItemDescription, eItemPriceMin, eItemPriceMax, vendorName,
	vendorContact, tableNumber)
	VALUES
	('$event_id', '$description', '$price_min', '$price_max', '$vendor_name',
	'$vendor_contact', '$table_info')";
			//echo $sql;
			$result = mysql_query($sql) or die(mysql_error());
			
			$sql = "SELECT eItemID FROM event_items WHERE eventID = '$event_id' AND tableNumber = '$table_info'";
			$result = mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($result))
			{
				$eItemID = $row["eItemID"];
			}
				
			mysql_close($conn);
			header("Location:./addEventVendor.php?event=$event_id&eitem=$eItemID");

				
		}

	} else {
	//otherwise
	//choose signup or login
	mysql_close($conn);
	header("Location:./chooseEventType.php");
}
?>