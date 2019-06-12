<?php 
session_start();
unset($_SESSION["tu"]);
unset($_SESSION["email"]);
unset($_SESSION["ids"]);
session_destroy();
header('location: http://localhost/pruebas/');
?>