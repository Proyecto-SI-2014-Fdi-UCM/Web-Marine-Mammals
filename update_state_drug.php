<?php
session_start();
include('config_db.php');
	if (isset($_POST["state"]) && isset($_POST["drugname"])) {
		$state = $_POST["state"];
		$drug_name = $_POST["drugname"];
		$sql = "UPDATE DRUG SET co_state='$state' WHERE drug_name='$drug_name'";
		mysqli_query($con,$sql);

		//Se obtiene el nuevo estado de la ficha para mostrar el correspondiente mensaje
		$sql1 = "SELECT co_state FROM DRUG WHERE drug_name='$drug_name'";
		$result=mysqli_query($con,$sql1);
		$row=mysqli_fetch_row($result);
		if (!strcmp($row[0], "RV")){
			echo "File submitted for review";
		}
		elseif (!strcmp($row[0], "BQ")) {
			echo "File accepted";
		}
		
	}
?>


