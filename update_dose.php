<?php
function times_number($links,$name) {
	$number = 0;
	for ($i=0;$i<count($links);$i++) {
		if (!strcmp($links[$i],$name)) {
			$number++;
		}
	}
	return $number;
}

if ((isset($_POST['drug_name']) && isset($_POST['group_name']) && isset($_POST['amount']) && isset($_POST['route'])) && (isset($_POST['article_reference']) ||
	isset($_POST['book_reference']))) {
		$drug_name = $_POST['drug_name'];
		$group_name = $_POST['group_name'];
		$amount = $_POST['amount'];
		$route = $_POST['route'];
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
					
					$animal_sql = "INSERT INTO animal(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
					$category_sql = "INSERT INTO category(category_name) VALUES ('$category')";
					$animal_result = mysql_query($animal_sql,$con);
					$category_result = mysql_query($category_sql,$con);
					
				}
			}
			else {
				if (isset($_POST['animal_name']) && isset($_POST['category_name'])) {
					$animal = $_POST['animal_name'];
					$family = "";
					$category = $_POST['category_name'];
					
					$animal_sql = "INSERT INTO animal(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
					$category_sql = "INSERT INTO category(category_name) VALUES ('$category')";
					$animal_result = mysql_query($animal_sql,$con);
					$category_result = mysql_query($category_sql,$con);
				}
			}
			
			if (isset($_POST['posology'])) {
				$posology = $_POST['posology'];
			}
			
			if (isset($_POST['specific_notes'])) {
				$specific_notes = $_POST['specific_notes'];
			}
			
			if (isset($_POST['old_animal']) && isset($_POST['old_family']) && isset($_POST['old_category']) && isset($_POST['old_dose']) && isset($_POST['old_posology']) && isset($_POST['old_route']) &&
			isset($_POST['old_article']) && isset($_POST['old_reference'])) {
				$old_animal = $_POST['old_animal'];
				$old_family = $_POST['old_family'];
				$old_category = $_POST['old_category'];
				$old_dose = $_POST['old_dose'];
				$old_posology = $_POST['old_posology'];
				$old_route = $_POST['old_route'];
				$old_article = $_POST['old_article'];
				$old_reference = $_POST['old_reference'];
			}
			
			$notes_sql = "SELECT specific_note FROM animal_has_category WHERE animal_name='$old_animal' AND drug_name='$drug_name' AND family='$old_family' AND group_name='$group_name' AND category_name='$old_category' AND
			book_reference='$old_reference' AND article_reference='$old_article' AND posology='$old_posology' AND route='$old_route' AND dose='$old_dose'";
			$notes_result = mysql_query($notes_sql,$con);
			$notes_amount = 0;
			while ($notes_row = mysql_fetch_row($notes_result)) {
				$old_note = $notes_row[0];
				if (isset($specific_notes) && $notes_amount < count($specific_notes) && strcmp($old_note,"")) {
					$note = $specific_notes[$notes_amount];
					$notes_amount++;
				}
				else {
					$note = "";
				}
				if (strcmp($amount,$old_dose)) {
					$delete_dose = "DELETE FROM animal_has_category WHERE drug_name='$drug_name' AND group_name='$group_name' AND specific_note='$old_note' AND animal_name='$old_animal' AND family='$old_family' AND category_name='$old_category' AND article_reference='$old_article' AND 
					book_reference='$old_reference' AND posology='$old_posology' AND route='$old_route' AND dose='$old_dose'";
					$result_delete = mysql_query($delete_dose,$con);
				}
				else {
					$dose_sql = "UPDATE animal_has_category SET animal_name='$animal', family='$family', category_name='$category', book_reference='$book_reference', article_reference='$article_reference', specific_note='$note', posology='$posology',
					route='$route', dose='$amount' WHERE animal_name='$old_animal' AND drug_name='$drug_name' AND family='$old_family' AND group_name='$group_name' AND category_name='$old_category' AND book_reference='$old_reference' AND article_reference='$old_article' AND
					specific_note='$old_note' AND posology='$old_posology' AND route='$old_route' AND dose='$old_dose'";
					$dose_result = mysql_query($dose_sql,$con);
				}
			}
			if (strcmp($amount,$old_dose)) {
				$animal_sql = "INSERT INTO animal(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
				$category_sql = "INSERT INTO category(category_name) VALUES ('$category')";
				$animal_result = mysql_query($animal_sql,$con);
				$category_result = mysql_query($category_sql,$con);
				for ($i=0;$i<count($specific_notes);$i++) {
					$note = $specific_notes[$i];
					$insert_dose = "INSERT INTO animal_has_category(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','$book_reference','$article_reference','$note','$posology','$route','$amount')";
					$result_insert = mysql_query($insert_dose,$con);
				}
				$insert_dose = "INSERT INTO animal_has_category(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','$book_reference','$article_reference','','$posology','$route','$amount')";
				$result_insert = mysql_query($insert_dose,$con);
			}
			
			for ($i=$notes_amount;$i<count($specific_notes);$i++) {
				$note = $specific_notes[$i];
				$insert_sql = "INSERT INTO animal_has_category(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','$book_reference','$article_reference','$note','$posology','$route','$amount')";
				$insert_result = mysql_query($insert_sql,$con);
			}
			
			echo "http://localhost/forMMulary/showDose.php?animal_name=$animal&&drug_name=$drug_name&&family=$family&&group=$group_name&&category_name=$category&&book_reference=$book_reference
			&&article_reference=$article_reference&&posology=$posology&&route=$route&&dose=$amount&&option=Edit";*/
			
			
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
			
			if (isset($_POST['specific_notes'])) {
				$specific_notes = $_POST['specific_notes'];
			}
			
			if (isset($_POST['old_animal']) && isset($_POST['old_family']) && isset($_POST['old_category']) && isset($_POST['old_dose']) && isset($_POST['old_posology']) && isset($_POST['old_route']) &&
			isset($_POST['old_article']) && isset($_POST['old_reference'])) {
				$old_animal = $_POST['old_animal'];
				$old_family = $_POST['old_family'];
				$old_category = $_POST['old_category'];
				$old_dose = $_POST['old_dose'];
				$old_posology = $_POST['old_posology'];
				$old_route = $_POST['old_route'];
				$old_article = $_POST['old_article'];
				$old_reference = $_POST['old_reference'];
			}
			
			$notes_sql = "SELECT specific_note FROM ANIMAL_has_CATEGORY WHERE animal_name='$old_animal' AND drug_name='$drug_name' AND family='$old_family' AND group_name='$group_name' AND category_name='$old_category' AND
			book_reference='$old_reference' AND article_reference='$old_article' AND posology='$old_posology' AND route='$old_route' AND dose='$old_dose'";
			$notes_result = mysqli_query($con,$notes_sql);
			$notes_amount = 0;
			while ($notes_row = mysqli_fetch_row($notes_result)) {
				$old_note = $notes_row[0];
				if (isset($specific_notes) && $notes_amount < count($specific_notes) && strcmp($old_note,"")) {
					$note = $specific_notes[$notes_amount];
					$notes_amount++;
				}
				else {
					$note = "";
				}
				if (strcmp($amount,$old_dose)) {
					$delete_dose = "DELETE FROM ANIMAL_has_CATEGORY WHERE drug_name='$drug_name' AND group_name='$group_name' AND specific_note='$old_note' AND animal_name='$old_animal' AND family='$old_family' AND category_name='$old_category' AND article_reference='$old_article' AND 
					book_reference='$old_reference' AND posology='$old_posology' AND route='$old_route' AND dose='$old_dose'";
					$result_delete = mysqli_query($con,$delete_dose);
				}
				else {
					$dose_sql = "UPDATE ANIMAL_has_CATEGORY SET animal_name='$animal', family='$family', category_name='$category', book_reference='$book_reference', article_reference='$article_reference', specific_note='$note', posology='$posology',
					route='$route', dose='$amount' WHERE animal_name='$old_animal' AND drug_name='$drug_name' AND family='$old_family' AND group_name='$group_name' AND category_name='$old_category' AND book_reference='$old_reference' AND article_reference='$old_article' AND
					specific_note='$old_note' AND posology='$old_posology' AND route='$old_route' AND dose='$old_dose'";
					$dose_result = mysqli_query($con,$dose_sql);
				}
			}
			if (strcmp($amount,$old_dose)) {
				$animal_sql = "INSERT INTO ANIMAL(animal_name,family,group_name,drug_name) VALUES ('$animal','$family','$group_name','$drug_name')";
				$category_sql = "INSERT INTO CATEGORY(category_name) VALUES ('$category')";
				$animal_result = mysqli_query($con,$animal_sql);
				$category_result = mysqli_query($con,$category_sql);
				for ($i=0;$i<count($specific_notes);$i++) {
					$note = $specific_notes[$i];
					$insert_dose = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','$book_reference','$article_reference','$note','$posology','$route','$amount')";
					$result_insert = mysqli_query($con,$insert_dose);
				}
				$insert_dose = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','$book_reference','$article_reference','','$posology','$route','$amount')";
				$result_insert = mysqli_query($con,$insert_dose);
			}
			
			for ($i=$notes_amount;$i<count($specific_notes);$i++) {
				$note = $specific_notes[$i];
				$insert_sql = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) VALUES ('$animal','$drug_name','$family','$group_name','$category','$book_reference','$article_reference','$note','$posology','$route','$amount')";
				$insert_result = mysqli_query($con,$insert_sql);
			} 
			echo "http://www.marinemammalformulary.com/showDose.php?animal_name=$animal&&drug_name=$drug_name&&family=$family&&group=$group_name&&category_name=$category&&book_reference=$book_reference
			&&article_reference=$article_reference&&posology=$posology&&route=$route&&dose=$amount&&option=Edit";
		
		
			
		}
		
}

?>