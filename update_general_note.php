<?php
if (isset($_POST['drug_name']) && isset($_POST['group_name']) && isset($_POST['general_notes'])) {
	$drug_name = $_POST['drug_name'];
	$group_name = $_POST['group_name'];
	$general_notes = $_POST['general_notes'];
	
	//Descomentar esto para conectar con localhost
	/*$con = mysql_connect ("127.0.0.1","root");
	if (!$con){die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysql_error());}

	$db = mysql_select_db("mydb",$con);
	if (!$db) {die ("ERROR AL SELECCIONAR DB ".mysql_error());}

	$notes_sql = "SELECT general_note FROM drug_aplicated_to_group WHERE drug_name='$drug_name' AND group_name='$group_name'";
	$notes_result = mysql_query($notes_sql,$con);
	$notes_amount = 0;
	while ($notes_row = mysql_fetch_row($notes_result)) {
		$old_note = $notes_row[0];
		if (isset($general_notes) && $notes_amount < count($general_notes)) {
			$note = $general_notes[$notes_amount];
			if (strcmp($note,"")) {
				$sql = "UPDATE drug_aplicated_to_group SET general_note='$note' WHERE drug_name='$drug_name' AND group_name='$group_name' AND general_note='$old_note'";
				$result = mysql_query($sql,$con);
			}
			$notes_amount++;
		}
	}
	
	for ($i=$notes_amount;$i<count($general_notes);$i++) {
		$note = $general_notes[$i];
		if (strcmp($note,"")) {
			$sql = "INSERT INTO drug_aplicated_to_group(drug_name,group_name,general_note) VALUES ('$drug_name','$group_name','$note')";
			$result = mysql_query($sql,$con);
		}
	}
	
	echo "http://localhost/forMMulary/general_note.php?group=$group_name&&drug_name=$drug_name&&option=Edit";*/
	
	//Descomentar esto para conectar con el servidor
	$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
	if (mysqli_connect_errno ($con)){
		echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
	}
	$notes_sql = "SELECT general_note FROM DRUG_aplicated_to_GROUP WHERE drug_name='$drug_name' AND group_name='$group_name'";
	$notes_result = mysqli_query($con,$notes_sql);
	$notes_amount = 0;
	while ($notes_row = mysqli_fetch_row($notes_result)) {
		$old_note = $notes_row[0];
		if (isset($general_notes) && $notes_amount < count($general_notes)) {
			$note = $general_notes[$notes_amount];
			if (strcmp($note,"")) {
				$sql = "UPDATE DRUG_aplicated_to_GROUP SET general_note='$note' WHERE drug_name='$drug_name' AND group_name='$group_name' AND general_note='$old_note'";
				$result = mysqli_query($con,$sql);
			}
			$notes_amount++;
		}
	}
	
	for ($i=$notes_amount;$i<count($general_notes);$i++) {
		$note = $general_notes[$i];
		if (strcmp($note,"")) {
			$sql = "INSERT INTO DRUG_aplicated_to_GROUP(drug_name,group_name,general_note) VALUES ('$drug_name','$group_name','$note')";
			$result = mysqli_query($con,$sql);
		}
	}
	
	echo "http://www.marinemammalformulary.com/general_note.php?group=$group_name&&drug_name=$drug_name&&option=Edit";
	
}

?>