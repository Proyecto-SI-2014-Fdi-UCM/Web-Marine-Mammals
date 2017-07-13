<?php
if (isset($_POST['drug_name']) && isset($_POST['group_name']) && isset($_POST['amount']) && (isset($_POST['article_reference']) ||
	isset($_POST['book_reference']))) {
		$drug_name = $_POST['drug_name'];
		$group_name = $_POST['group_name'];
		$amount = $_POST['amount'];
		if (isset($_POST['article_reference'])) {
			$article_reference = $_POST['article_reference'];
		}
		if (isset($_POST['book_reference'])) {
			$book_reference = $_POST['book_reference'];
		}
		
		if (strcmp($amount,"") && (strcmp($_POST['article_reference'],"") || strcmp($_POST['book_reference'],""))) {
			
			//Descomentar esto para conectar con localhost
			/*$con = mysql_connect ("127.0.0.1","root");
			if (!$con){die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysql_error());}

			$db = mysql_select_db("mydb",$con);
			if (!$db) {die ("ERROR AL SELECCIONAR DB ".mysql_error());}
			
			if (!strcmp($group_name,"Pinnipeds")) {
				if (isset($_POST['animal_name']) && isset($_POST['family']) && isset($_POST['category_name'])) {
					$animal = $_POST['animal_name'];
					if (!strcmp($_POST['family'],"Family")) {
						$family = "";
					}
					else {
						$family = $_POST['family'];
					}
					$category = $_POST['category_name'];
					
					$animal_sql = "INSERT INTO ANIMAL(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
					$category_sql = "INSERT INTO CATEGORY(category_name) VALUES ('$category')";
					$animal_result = mysqli_query($animal_sql,$con);
					$category_result = mysqli_query($category_sql,$con);
					
				}
			}
			else {
				if (isset($_POST['animal_name']) && isset($_POST['category_name'])) {
					$animal = $_POST['animal_name'];
					$family = "";
					$category = $_POST['category_name'];
					
					$animal_sql = "INSERT INTO ANIMAL(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
					$category_sql = "INSERT INTO CATEGORY(category_name) VALUES ('$category')";
					$animal_result = mysqli_query($animal_sql,$con);
					$category_result = mysqli_query($category_sql,$con);
				}
			}
			
			if (isset($_POST['posology'])) {
				$posology = $_POST['posology'];
			}
			
			if (isset($_POST['route'])) {
				$route = $_POST['route'];
			}
			
			if (isset($_POST['specific_notes'])) {
				$specific_notes = $_POST['specific_notes'];
			
			for ($i=0;$i<count($specific_notes);$i++) {
				$note = $specific_notes[$i];
				$dose_sql = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','" . $_POST['book_reference'] . "','" . $_POST['article_reference'] . "','$note','$posology','$route','$amount')";
				$dose_result = mysqli_query($dose_sql,$con);
			}
			}

			$dose_sql = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','" . $_POST['book_reference'] . "','" . $_POST['article_reference'] . "','','$posology','$route','$amount')";
			$dose_result = mysqli_query($dose_sql,$con);
			
			$dose_number = "SELECT DISTINCT animal_name, drug_name, family, group_name, category_name, book_reference, article_reference, posology, route, dose FROM ANIMAL_has_CATEGORY WHERE drug_name = '$drug_name' AND group_name = '$group_name' AND animal_name='$animal' AND family='$family' AND category_name='$category'";
		
			
			echo "http://localhost/formmulary/showDose.php?animal_name=$animal&&drug_name=$drug_name&&family=$family&&group=$group_name&&category_name=$category&&book_reference=$book_reference
			&&article_reference=$article_reference&&posology=$posology&&route=$route&&dose=$amount&&option=Edit";
			}*/
			
			//Descomentar esto para conectar con el servidor
			$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
			if (mysqli_connect_errno ($con)){
				echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
			}
			
			if (!strcmp($group_name,"Pinnipeds")) {
				if (isset($_POST['animal_name']) && isset($_POST['family']) && isset($_POST['category_name'])) {
					$animal = $_POST['animal_name'];
					if (!strcmp($_POST['family'],"Family")) {
						$family = "";
					}
					else {
						$family = $_POST['family'];
					}
					$category = $_POST['category_name'];
					
					$animal_sql = "INSERT INTO ANIMAL(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
					$category_sql = "INSERT INTO CATEGORY(category_name) VALUES ('$category')";
					$animal_result = mysqli_query($con,$animal_sql);
					$category_result = mysqli_query($con,$category_sql);
					
				}
			}
			else {
				if (isset($_POST['animal_name']) && isset($_POST['category_name'])) {
					$animal = $_POST['animal_name'];
					$family = "";
					$category = $_POST['category_name'];
					
					$animal_sql = "INSERT INTO ANIMAL(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
					$category_sql = "INSERT INTO CATEGORY(category_name) VALUES ('$category')";
					$animal_result = mysqli_query($con,$animal_sql);
					$category_result = mysqli_query($con,$category_sql);
				}
			}
			
			if (isset($_POST['posology'])) {
				$posology = $_POST['posology'];
			}
			
			if (isset($_POST['route'])) {
				$route = $_POST['route'];
			}
			
			if (isset($_POST['specific_notes'])) {
				$specific_notes = $_POST['specific_notes'];
			
			for ($i=0;$i<count($specific_notes);$i++) {
				$note = $specific_notes[$i];
				$dose_sql = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','" . $_POST['book_reference'] . "','" . $_POST['article_reference'] . "','$note','$posology','$route','$amount')";
				$dose_result = mysqli_query($con,$dose_sql);
			}
			}

			$dose_sql = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','" . $_POST['book_reference'] . "','" . $_POST['article_reference'] . "','','$posology','$route','$amount')";
			$dose_result = mysqli_query($con,$dose_sql);
			
			$dose_number = "SELECT DISTINCT animal_name, drug_name, family, group_name, category_name, book_reference, article_reference, posology, route, dose FROM ANIMAL_has_CATEGORY WHERE drug_name = '$drug_name' AND group_name = '$group_name' AND animal_name='$animal' AND family='$family' AND category_name='$category'";
		
			
			echo "http://www.marinemammalformulary.com/showDose.php?animal_name=$animal&&drug_name=$drug_name&&family=$family&&group=$group_name&&category_name=$category&&book_reference=$book_reference
			&&article_reference=$article_reference&&posology=$posology&&route=$route&&dose=$amount&&option=Edit";
}

}

?>