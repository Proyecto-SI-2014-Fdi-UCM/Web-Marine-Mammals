<?php 

//Configuración para la conexión con el servidor
/*$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
if (mysqli_connect_errno ($con)){
   echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
}*/

//Conexión para local (xampp)
$con = mysqli_connect ("localhost","root","","marinemammalformulary_");
if (mysqli_connect_errno ($con)){
   echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
}


?>