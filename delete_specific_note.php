<?php
if (isset($_POST['drug_name']) && isset($_POST['group_name']) && isset($_POST['specific_note']) && isset($_POST['animal_name']) && isset($_POST['family']) && isset($_POST['category_name']) && isset($_POST['article_reference']) 
&& isset($_POST['reference']) && isset($_POST['posology']) && isset($_POST['route']) && isset($_POST['dose'])) {
	$drug_name = $_POST['drug_name'];
	$specific_note = $_POST['specific_note'];
	$group_name = $_POST['group_name'];
	$animal_name = $_POST['animal_name'];
	$family = $_POST['family'];
	$category_name = $_POST['category_name'];
	$article_reference = $_POST['article_reference'];
	$reference = $_POST['reference'];
	$posology = $_POST['posology'];
	$route = $_POST['route'];
	$dose = $_POST['dose'];
	
	//Descomentar esto para conectar con localhost
	/*$con = mysql_connect ("127.0.0.1","root");
	if (!$con){die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysql_error());}

	$db = mysql_select_db("mydb",$con);
	if (!$db) {die ("ERROR AL SELECCIONAR DB ".mysql_error());}

	$sql = "DELETE FROM animal_has_category WHERE drug_name='$drug_name' AND group_name='$group_name' AND specific_note='$specific_note' AND animal_name='$animal_name' AND family='$family' AND category_name='$category_name' AND article_reference='$article_reference' AND 
	book_reference='$reference' AND posology='$posology' AND route='$route' AND dose='$dose'";

	$result = mysql_query($sql,$con);
	
	$sql = "SELECT specific_note FROM animal_has_category WHERE drug_name='$drug_name' AND group_name='$group_name' AND animal_name='$animal_name' AND family='$family' AND category_name='$category_name' AND article_reference='$article_reference' AND 
	book_reference='$reference' AND posology='$posology' AND route='$route' AND dose='$dose'";
	$result = mysql_query($sql,$con);
	$rows_num = mysql_num_rows($result);
	if ($rows_num == 0) {
		$dose_sql = "INSERT INTO animal_has_category(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal_name','$drug_name','$family','$group_name','$category_name','$reference','$article_reference','','$posology','$route','$dose')";
		$dose_result = mysql_query($dose_sql,$con);
	}
		
	echo "http://localhost/forMMulary/showDose.php?animal_name=$animal_name&&drug_name=$drug_name&&family=$family&&group=$group_name&&category_name=$category_name&&book_reference=$reference
	&&article_reference=$article_reference&&posology=$posology&&route=$route&&dose=$dose&&option=Edit";*/
	
	//Descomentar esto para conectar con el servidor
	$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
	if (mysqli_connect_errno ($con)){
		echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
	}
	$sql = "DELETE FROM ANIMAL_has_CATEGORY WHERE drug_name='$drug_name' AND group_name='$group_name' AND specific_note='$specific_note' AND animal_name='$animal_name' AND family='$family' AND category_name='$category_name' AND article_reference='$article_reference' AND 
	book_reference='$reference' AND posology='$posology' AND route='$route' AND dose='$dose'";

	$result = mysqli_query($con,$sql);
	
	$sql = "SELECT specific_note FROM ANIMAL_has_CATEGORY WHERE drug_name='$drug_name' AND group_name='$group_name' AND animal_name='$animal_name' AND family='$family' AND category_name='$category_name' AND article_reference='$article_reference' AND 
	book_reference='$reference' AND posology='$posology' AND route='$route' AND dose='$dose'";
	$result = mysqli_query($con,$sql);
	$rows_num = mysqli_num_rows($result);
	if ($rows_num == 0) {
		$dose_sql = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal_name','$drug_name','$family','$group_name','$category_name','$reference','$article_reference','','$posology','$route','$dose')";
		$dose_result = mysqli_query($con,$dose_sql);
	}
		
	echo "http://www.marinemammalformulary.com/showDose.php?animal_name=$animal_name&&drug_name=$drug_name&&family=$family&&group=$group_name&&category_name=$category_name&&book_reference=$reference
	&&article_reference=$article_reference&&posology=$posology&&route=$route&&dose=$dose&&option=Edit";
		
}
?>