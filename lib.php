<?php
require_once ('managerdb.php');
// Save Data
$pageId = sqlite_escape_string($_REQUEST['pageId']);
$contentId = sqlite_escape_string($_REQUEST['contentId']);
$content =  sqlite_escape_string($_REQUEST['content']);

//crear una conexion a la db
function getAlohaContent($editableID) {
	//$pageId = $_SERVER['SCRIPT_NAME'];
	$objconexion = new ConnectClass();
	$objconexion->connect();
	$objconexion->getContenidos($editableID);
}
?>
