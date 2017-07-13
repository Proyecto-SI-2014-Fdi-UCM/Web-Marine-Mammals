<?php
if (isset($_POST['drug_name']) && isset($_POST['group_name']) && isset($_POST['general_note'])) {
	$drug_name = $_POST['drug_name'];
	$general_note = $_POST['general_note'];
	$group_name = $_POST['group_name'];
	
	//Descomentar esto para conectar con localhost
	/*$con = mysql_connect ("127.0.0.1","root");
	if (!$con){die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysql_error());}

	$db = mysql_select_db("mydb",$con);
	if (!$db) {die ("ERROR AL SELECCIONAR DB ".mysql_error());}

	$sql = "DELETE FROM drug_aplicated_to_group WHERE drug_name='$drug_name' AND group_name='$group_name' AND general_note='$general_note'";

	$result = mysql_query($sql,$con);
	
	echo "http://localhost/forMMulary/general_note.php?group=$group_name&&drug_name=$drug_name&&option=Edit";
	}*/
	
	//Descomentar esto para conectar con el servidor
	$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
	if (mysqli_connect_errno ($con)){
		echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
	}
	$sql = "DELETE FROM DRUG_aplicated_to_GROUP WHERE drug_name='$drug_name' AND group_name='$group_name' AND general_note='$general_note'";
	$result = mysqli_query($con,$sql);
	
	echo "http://www.marinemammalformulary.com/general_note.php?group=$group_name&&drug_name=$drug_name&&option=Edit";
		
}
?>