<?php
session_start();
$username=$_SESSION['username'];
include('config_db.php');
	if (isset($_POST["comment"]) && isset($_POST["drugname"])) {
		$comment = $_POST["comment"];
		$drug_name = $_POST["drugname"];
		$sql = "INSERT INTO SUGGESTION (user, drugname,comment, managed) VALUES ('$username','$drug_name','$comment',0)";

		mysqli_query($con,$sql);
		echo "Your suggestions have been sent";
		//Se obtiene el nuevo estado de la ficha para mostrar el correspondiente mensaje
		/*$sql1 = "SELECT co_state FROM DRUG WHERE drug_name='$drug_name'";
		$result=mysqli_query($con,$sql1);
		$row=mysqli_fetch_row($result);
		if (!strcmp($row[0], "RV")){
			echo "File submitted for review";
		}
		elseif (!strcmp($row[0], "BQ")) {
			echo "File accepted";
		}*/
	}
?>


