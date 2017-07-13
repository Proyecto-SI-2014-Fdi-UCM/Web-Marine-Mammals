<?php
session_start();
include('config_db.php');

$username=$_POST['username'];
$password=$_POST['password'];
$conf_pasword=$_POST['conf_pasword'];
$email=$_POST['email'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$prof=$_POST['prof'];
$country=$_POST['country'];

$sql = "INSERT INTO User (user_name,password,first_name,last_name,profession,country,email,checked) VALUES ('$username','$password','$first_name','$last_name','$prof','$country','$email','0')";
$result=mysqli_query($con,$sql);

?>


