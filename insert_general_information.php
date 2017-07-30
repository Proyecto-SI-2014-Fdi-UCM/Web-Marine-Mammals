<?php
	
	 /*$tmp1= $_POST['drug_name'];
	 $tmp2= $_POST['anatomic_group'];
	 $tmp3=$_POST['therapeutic_group'];


	 echo $tmp1;
	 echo $tmp2;
	 echo $tmp3;
	 echo $_POST['code'];
	echo $_POST['description'];
	echo $_POST['available'];
	echo $_POST['license_AEMPS'];*/
	if (isset($_POST['drug_name']) && isset($_POST['anatomic_group']) && isset($_POST['therapeutic_group']) && isset($_POST['code'])) {
		include './config_db.php';
		
		$drug_name = $_POST['drug_name'];
		$anatomic_group = $_POST['anatomic_group'];
		$therapeutic_group = $_POST['therapeutic_group'];
		$code = $_POST['code'];

		if (isset($_POST['description'])) {
			$description = $_POST['description'];
		}
		if (isset($_POST['available'])) {
			$available = $_POST['available'];
		}
		if (isset($_POST['license_AEMPS'])) {
			$license_AEMPS = $_POST['license_AEMPS'];
		}
		if (isset($_POST['license_EMA'])) {
			$license_EMA = $_POST['license_EMA'];
		}
		if (isset($_POST['license_FDA'])) {
			$license_FDA = $_POST['license_FDA'];
		}
		
		if (strcmp($drug_name,"") && strcmp($anatomic_group,"Anatomic Target (1st level ATCvet)") && strcmp($therapeutic_group,"") && strcmp($code,"")) {
			$general_info = "INSERT INTO DRUG(drug_name, description, available, license_AEMPS, license_EMA, license_FDA,co_estado) VALUES ('$drug_name','$description','$available', '$license_AEMPS', '$license_EMA', '$license_FDA','ED')";
			$general_info_result = mysqli_query($con,$general_info);
			/*for ($i=0;$i<count($codes);$i++) {
				$code = $codes[$i];
				$anatomic_group = $anatomic_groups[$i];
				$therapeutic_group = $therapeutic_groups[$i];
				$codes_info = "INSERT INTO CODE(code_number, anatomic_group_name, therapeutic_group_name, drug_name) VALUES ('$code', '$anatomic_group', '$therapeutic_group', '$drug_name')";
				$codes_info_result = mysqli_query($con,$codes_info);
				$therapeutic_group_sql = "INSERT INTO THERAPEUTIC_GROUP(name) VALUES ('$therapeutic_group')";
				$therapeutic_group_result = mysqli_query($con,$therapeutic_group_sql);
			}*/
			$code_info = "INSERT INTO CODE(code_number, anatomic_group_name, therapeutic_group_name, drug_name) VALUES ('$code', '$anatomic_group', '$therapeutic_group', '$drug_name')";
			$code_info_result = mysqli_query($con,$code_info);
			$therapeutic_group_sql = "INSERT INTO THERAPEUTIC_GROUP(name) VALUES ('$therapeutic_group')";
			$therapeutic_group_result = mysqli_query($con,$therapeutic_group_sql);
			echo "http://www.marinemammalformulary.com/general.php?drug_name=$drug_name&&option=Edit";
			
		}
		
		//echo "http://www.marinemammalformulary.com/general.php?drug_name=$drug_name&&option=Edit";
		//echo '<script>location.href = "general.php?drug_name=$drug_name&&option=Edit"</script>';		
	}

	else { 
		echo "http://www.marinemammalformulary.com/general.php?";
	}
?>