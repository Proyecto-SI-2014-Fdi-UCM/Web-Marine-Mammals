<?php
	if (isset($_POST['drug_name']) && isset($_POST['anatomic_groups']) && isset($_POST['therapeutic_groups']) && isset($_POST['codes'])) {
		include './config_db.php';
		$drug_name = $_POST['drug_name'];
		$anatomic_groups = $_POST['anatomic_groups'];
		$therapeutic_groups = $_POST['therapeutic_groups'];
		$codes = $_POST['codes'];
		
		if (isset($_POST['description'])) {
			$description = $_POST['description'];
		}
		if (isset($_POST['available'])) {
			$available = $_POST['available'];
			//echo $available;
		}
		if (isset($_POST['license_AEMPS'])) {
			$license_AEMPS = $_POST['license_AEMPS'];
			//echo $license_AEMPS;
		}
		if (isset($_POST['license_EMA'])) {
			$license_EMA = $_POST['license_EMA'];
		}
		if (isset($_POST['license_FDA'])) {
			$license_FDA = $_POST['license_FDA'];
		}
		
		if (isset($_POST['old_drug'])) {
			$old_drug = $_POST['old_drug'];
			if (strcmp($drug_name, "")) {
				if (strcmp($drug_name, $old_drug)) {
					$old_codes = "SELECT * FROM CODE WHERE drug_name='$old_drug'";
					$old_codes_result = mysqli_query($con,$old_codes);
					$notes = "SELECT * FROM DRUG_aplicated_to_GROUP WHERE drug_name='$old_drug'";
					$notes_result = mysqli_query($con,$notes);
					$dose = "SELECT * FROM ANIMAL_has_CATEGORY WHERE drug_name='$old_drug'";
					$dose_result = mysqli_query($con,$dose);
					$animal = "SELECT * FROM ANIMAL WHERE drug_name='$old_drug'";
					$animal_result = mysqli_query($con,$animal);
					$delete_codes = "DELETE FROM CODE WHERE drug_name='$old_drug'";
					$delete_codes_result = mysqli_query($con,$delete_codes);
					$delete_notes = "DELETE FROM DRUG_aplicated_to_GROUP WHERE drug_name='$old_drug'";
					$delete_notes_result = mysqli_query($con,$delete_notes);
					$delete_dose = "DELETE FROM ANIMAL_has_CATEGORY WHERE drug_name='$old_drug'";
					$delete_dose_result = mysqli_query($con,$delete_dose);
					$delete_animal = "DELETE FROM ANIMAL WHERE drug_name='$old_drug'";
					$delete_animal_result = mysqli_query($con,$delete_animal);
					$delete_general_information = "DELETE FROM DRUG WHERE drug_name='$old_drug'";
					$delete_general_information_result = mysqli_query($con,$delete_general_information);
					$insert_general_information = "INSERT INTO DRUG(drug_name,description,available,license_AEMPS,license_EMA,license_FDA,co_estado) 
					VALUES ('$drug_name','$description','$available','$license_AEMPS','$license_EMA','$license_FDA','ED')";
					$insert_general_information_result = mysqli_query($con,$insert_general_information);
					$i = 0;
					while ($row_codes = mysqli_fetch_row($old_codes_result)) {
						if (strcmp($codes[$i],"")) {
							$new_code = $codes[$i];
						}
						else {
							$new_code = $row_codes[$i][0];
						}
						if (strcmp($anatomic_groups[$i],"Anatomic Target (1st level ATCvet")) {
							$anatomic_group = $anatomic_groups[$i];
						}
						else {
							$anatomic_group = $row_codes[$i][1];
						}
						if (strcmp($therapeutic_groups[$i],"")) {
							$therapeutic_group = $therapeutic_groups[$i];
						}
						else {
							$therapeutic_group = $row_codes[$i][2];
						}
						$insert_code = "INSERT INTO CODE(code_number,anatomic_group_name,therapeutic_group_name,drug_name) VALUES ('$new_code','$anatomic_group','$therapeutic_group','$drug_name')";
						$insert_code_result = mysqli_query($con,$insert_code);
						$insert_therapeutic_group = "INSERT INTO THERAPEUTIC_GROUP(name) VALUES ('$therapeutic_group')";
						$insert_therapeutic_group_result = mysqli_query($con,$insert_therapeutic_group);
						$i++;
					}
					if ($i < count($codes) && $i < count($anatomic_groups) && $i < count($therapeutic_groups)) {
						$new_code = $codes[$i];
						$anatomic_group = $anatomic_groups[$i];
						$therapeutic_group = $therapeutic_groups[$i];
						if (strcmp($new_code,"") && strcmp($anatomic_group,"Anatomic Target (1st level ATCvet)") && strcmp($therapeutic_group,"")) {
							$code_info = "INSERT INTO CODE(code_number, anatomic_group_name, therapeutic_group_name, drug_name) VALUES ('$new_code', '$anatomic_group', '$therapeutic_group', '$drug_name')";
							$code_info_result = mysqli_query($con,$code_info);
							$therapeutic_group_sql = "INSERT INTO THERAPEUTIC_GROUP(name) VALUES ('$therapeutic_group')";
							$therapeutic_group_result = mysqli_query($con,$therapeutic_group_sql);
						}
					}
					$i = 0;
					while ($row_notes = mysqli_fetch_row($notes_result)) {
						$group_name = $row_notes[$i][1];
						$general_note = $row_notes[$i][2];
						$insert_note = "INSERT INTO DRUG_aplicated_to_GROUP(drug_name,group_name,general_note) VALUES ('$drug_name','$group_name','$general_note')";
						$insert_note_result = mysqli_query($con,$insert_note);
						$i++;
					}
					$i = 0;
					while ($row_animal = mysqli_fetch_row($animal_result)) {
						$animal_name = $row_animal[$i][0];
						$family = $row_animal[$i][1];
						$group_name = $row_animal[$i][2];
						$insert_animal = "INSERT INTO ANIMAL(animal_name,family,group_name,drug_name) VALUES ('$animal_name','$family','$group_name','$drug_name')";
						$insert_animal_result = mysqli_query($con,$insert_animal);
						$i++;
					}
					$i = 0;
					while ($row_dose = mysqli_fetch_row($dose_result)) {
						$animal_name = $row_dose[$i][0];
						$family = $row_dose[$i][2];
						$group_name = $row_notes[$i][3];
						$category_name = $row_dose[$i][4];
						$book_reference = $row_dose[$i][5];
						$article_reference = $row_dose[$i][6];
						$specific_note = $row_dose[$i][7];
						$posology = $row_dose[$i][8];
						$route = $row_dose[$i][9];
						$amount = $row_dose[$i][10];
						$insert_dose = "INSERT INTO ANIMAL_has_CATEGORY(animal_name,drug_name,family,group_name,category_name,book_reference,article_reference,specific_note,posology,route,dose) 
						VALUES ('$animal_name','$drug_name','$family','$group_name','$category_name','$book_reference','$article_reference','$specific_note','$posology','$route','$amount')";
						$insert_dose_result = mysqli_query($con,$insert_dose);
						$i++;
					}
				}
				else {
					$old_codes = "SELECT code_number FROM CODE WHERE drug_name='$old_drug'";
					$old_codes_result = mysqli_query($con,$old_codes);
					$i=0;
					while ($row = mysqli_fetch_row($old_codes_result)) {
						$old_code = $row[0];
						$new_code = $codes[$i];
						$anatomic_group = $anatomic_groups[$i];
						$therapeutic_group = $therapeutic_groups[$i];
						if (strcmp($new_code,"") && strcmp($anatomic_group,"Anatomic Target (1st level ATCvet)") && strcmp($therapeutic_group,"")) {
							$code_sql = "UPDATE CODE SET code_number='$new_code', anatomic_group_name='$anatomic_group', therapeutic_group_name='$therapeutic_group', drug_name='$drug_name'
							WHERE code_number='$old_code'";
							$code_result = mysqli_query($con,$code_sql);
							$therapeutic_group_sql = "INSERT INTO THERAPEUTIC_GROUP(name) VALUES ('$therapeutic_group')";
							$therapeutic_group_result = mysqli_query($con,$therapeutic_group_sql);
						}
						$i++;
					}
					if ($i < count($codes) && $i < count($anatomic_groups) && $i < count($therapeutic_groups)) {
						$new_code = $codes[$i];
						$anatomic_group = $anatomic_groups[$i];
						$therapeutic_group = $therapeutic_groups[$i];
						if (strcmp($new_code,"") && strcmp($anatomic_group,"Anatomic Target (1st level ATCvet)") && strcmp($therapeutic_group,"")) {
							$code_info = "INSERT INTO CODE(code_number, anatomic_group_name, therapeutic_group_name, drug_name) VALUES ('$new_code', '$anatomic_group', '$therapeutic_group', '$drug_name')";
							$code_info_result = mysqli_query($con,$code_info);
							$therapeutic_group_sql = "INSERT INTO THERAPEUTIC_GROUP(name) VALUES ('$therapeutic_group')";
							$therapeutic_group_result = mysqli_query($con,$therapeutic_group_sql);
						}
					}
					$info_sql = "UPDATE DRUG SET drug_name='$drug_name', description='$description', available='$available', license_AEMPS='$license_AEMPS', license_EMA='$license_EMA', license_FDA='$license_FDA'
					WHERE drug_name='$old_drug'";
					//echo $info_sql;
					$result = mysqli_query($con,$info_sql);    
				}	
				
				echo "http://www.marinemammalformulary.com/general.php?drug_name=$drug_name&&option=Edit";
		
			}
			else {
				echo "http://www.marinemammalformulary.com/general.php?drug_name=$old_drug&&option=Edit";
			}
			
		}
	}
?>