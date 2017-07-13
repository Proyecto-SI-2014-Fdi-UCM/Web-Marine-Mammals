<?php
 session_start();
include('config_db.php');

 $passkey = $_GET['passkey'];
 $sql = "UPDATE User SET verif_email=NULL,checked='1' WHERE verif_email='$passkey'";
 //$result = mysql_query($sql,$con) or die(mysql_error());
 $result = mysqli_query($con,$sql) or die(mysqli_error());
 if($result)
 {
  //echo '<div>Your account is now active. You may now <a href="login.php">Log in</a></div>';
 	//echo '<div>Your account is now active. You may now</div>';
header("Location: index.html");
}
 else
 {
  echo "Some error occur.";
 }
?>