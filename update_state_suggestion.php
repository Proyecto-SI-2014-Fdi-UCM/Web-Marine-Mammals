<?php
session_start();
include('config_db.php');
	if (isset($_POST["user"]) && isset($_POST["drugname"])) {
		$user = $_POST["user"];
		$drugname = $_POST["drugname"];
		$managed=$_POST["managed"];
		$action=$_POST["action"];

		$sql = "UPDATE SUGGESTION SET managed='$managed', action='$action' WHERE drugname='$drugname' and user='$user'";
		mysqli_query($con,$sql);
		
	}
?>


