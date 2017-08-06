<?php
session_start();
include('config_db.php');
	if (isset($_POST["state"]) && isset($_POST["drugname"])) {
		$state = $_POST["state"];
		$drug_name = $_POST["drugname"];
		$sql = "UPDATE DRUG SET co_state='$state' WHERE drug_name='$drug_name'";
		mysqli_query($con,$sql);
		echo "Ficha enviada para revisión";

	}
?>


