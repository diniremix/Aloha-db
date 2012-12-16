<?php
require_once 'lib.php';

$db = new SQLiteDatabase($dbFile, 0777, $error);

// Save Data
$pageId = sqlite_escape_string($_REQUEST['pageId']);
$contentId = sqlite_escape_string($_REQUEST['contentId']);
$content =  sqlite_escape_string($_REQUEST['content']);

/* salvar los cambios a un archivo
$myFile = "page2.php";
$fh = fopen($myFile, 'w') or die("no se puede crear el archivo");
fwrite($fh, $pageId);
fwrite($fh, $contentId);
fwrite($fh, $content);
fclose($fh);
if (file_exists($myFile)){
	echo "todo bn";
}else{
	echo "todo bn MAL";
}*/

//echo $pageId.'->'.$contentId.'->'.$content;
//exit();
$query = "SELECT id FROM aloha 
			WHERE
				pageId = '".$pageId."'
				AND contentId = '".$contentId."';";

$result = $db->query($query, $error);

$exists = false;
if($result->valid()) {
	$exists = true;
    $row = $result->current();
}

if ($exists == true) {
	$query = "BEGIN;
		UPDATE aloha SET
			content = '".$content."'
		WHERE
			id = ".$row['id'].";
		COMMIT;";
} else {
	$query = "BEGIN;
		INSERT INTO aloha 
			(id, pageId, contentId, content)
		VALUES
			(NULL, '".$pageId."', '".$contentId."', '".$content."');
		COMMIT;";
}

$db->query($query, $error);

if ( empty($error) ) {
	echo 'Content saved.';
} else {
	echo 'Error: content not saved.';
	//error_log('Error: '.print_r($error, true)."\n", 3, "aloha.log");
}

?>