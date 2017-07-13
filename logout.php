<?php
session_start();
include('config_db.php');
//libera todas las variables de sesión actualmente registradas.
session_unset();

session_destroy();
header("Location: index.html");
?>