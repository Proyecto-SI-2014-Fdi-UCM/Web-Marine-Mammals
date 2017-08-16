<?php
session_start();
include('config_db.php');
	if (isset($_POST["owner"]) && isset($_POST["drugname"])) {
		$owner = $_POST["owner"];
		$drug_name = $_POST["drugname"];
		$sql = "UPDATE DRUG SET owner='$owner' WHERE drug_name='$drug_name'";
		mysqli_query($con,$sql);
	}
?>


