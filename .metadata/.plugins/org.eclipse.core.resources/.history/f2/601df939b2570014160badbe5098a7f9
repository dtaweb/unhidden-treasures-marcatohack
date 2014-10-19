<?php
	//check organizer credentials
   //Include the database connection info.htm
   include_once("dbinfo.php");
   $conn = mysql_connect($dbhost,$username, $password) or die(mysql_error());
   $db = mysql_select_db($dbname, $conn) or die(mysql_error());

   $email_notrim = $_POST['email'];
   $email_trim = str_replace(" ", "",$email_notrim);
   $password_notrim = $_POST['password1'];
   $password_trim = str_replace(" ", "",$password_notrim);

   $sql = "SELECT user_id FROM users WHERE email='$email_trim' and password='$password_trim' AND user_category='2'";
   $result = mysql_query($sql) or die(mysql_error());

   if (mysql_num_rows($result) == 1)
   {
      while ($row = mysql_fetch_array($result))
      {
         $user_id = $row["user_id"];
      }
      
      session_start();

      unset($_SESSION['sessionid']);
      unset($_SESSION['user_id4']);

      $sessid = session_id();
      $_SESSION['sessionid']=$sessid;
      $_SESSION['user_id4']=$user_id;

      $sql = "DELETE FROM current_sessions WHERE user_id = '$user_id'";
      $result = mysql_query($sql) or die(mysql_error());

      $current_time=time();

      $sql = "INSERT INTO current_sessions (user_id, session_id, last_access) VALUES ('$user_id','$sessid','$current_time')";
      $result = mysql_query($sql) or die(mysql_error());
      mysql_close($conn);

      header("Location:./organizerMain.php");
   }
   else
   {
         mysql_close($conn);
         header("Location:./organizerLogin.php");   
   } 
?>