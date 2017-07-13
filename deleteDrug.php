<?php
include('config_db.php');
$drug=$_POST["name"];

$sql1 = "DELETE FROM DRUG_aplicated_to_GROUP WHERE drug_name='$drug'";
$sql2 = "DELETE FROM ANIMAL_has_CATEGORY WHERE drug_name='$drug'";
$sql3 = "DELETE FROM ANIMAL WHERE drug_name='$drug'";
$sql4 = "DELETE FROM CODE WHERE drug_name='$drug'";
$sql5 = "DELETE FROM DRUG WHERE drug_name='$drug'";

mysqli_query($con,$sql1);
mysqli_query($con,$sql2);
mysqli_query($con,$sql3);
mysqli_query($con,$sql4);
mysqli_query($con,$sql5);

?>