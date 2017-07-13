<?php
session_start();
include('config_db.php');
$user=$_POST["nick"];

$sql = "DELETE FROM User WHERE user_name='$user'";

mysqli_query($con,$sql);


?>