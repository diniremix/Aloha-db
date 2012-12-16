<?php
require_once ('managerdb.php');
//crear una conexion a la db
$objconexion = new ConnectClass();
$objconexion->connect();
$objconexion->saveContenidos();
?>
