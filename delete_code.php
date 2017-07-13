<?php
	if (isset($_POST['code_number']) && isset($_POST['drug_name'])) {
		include './config_db.php';
		$code_number = $_POST['code_number'];
		$drug_name = $_POST['drug_name'];
		$deleteCode = "DELETE FROM CODE WHERE code_number='$code_number'";
		$result = mysqli_query($con,$deleteCode);
		
		echo "http://www.marinemammalformulary.com/general.php?drug_name=$drug_name&&option=Edit";
	}
?>