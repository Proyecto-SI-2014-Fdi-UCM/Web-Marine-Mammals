<?php 


//$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
$con = mysqli_connect ("localhost","root","","marinemammalformulary_");
if (mysqli_connect_errno ($con)){
   echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
}

?>