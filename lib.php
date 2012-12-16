<?php
$dbFile = 'alohadb.sqlite';

createDatabase();

function createDatabase() {
	global $dbFile;

	// create table 'aloha' and insert sample data if SQLite dbFile does not exist
	if ( !file_exists($dbFile) ) {

		//error_log('SQLite Database does not exist: '.$dbFile."\n", 3, "aloha.log");

		try {
			$db = new SQLiteDatabase($dbFile, 0777, $error);

			$db->query("BEGIN;
				CREATE TABLE aloha (
					id INTEGER PRIMARY KEY,
					pageId CHAR(255),
					contentId CHAR(255),
					content TEXT
				);

				INSERT INTO aloha
					(id, pageId, contentId, content)
				VALUES
					(NULL, NULL, NULL, 'click para editar');

				COMMIT;");

			//error_log('SQLite Database created: '.$dbFile."\n", 3, "aloha.log");
		} catch (Exception $e) {
			echo '<pre>';
			print_r($error);
			echo '</pre>';
			die();
		}
	}
}

function getAlohaContent($editableID) {
	global $dbFile;

	$error = false;
	$db = new SQLiteDatabase($dbFile, 0777, $error);
	$pageId = $_SERVER['SCRIPT_NAME'];
	
	$query = "SELECT * FROM aloha WHERE pageId = '".$pageId."' AND contentId = '".$editableID."';";

	$result = $db->query($query, $error);
	$row = array();

	$exists = false;
	if($result->valid()) {
		$exists = true;
		$row = $result->current();
	}

	if ( !empty($error) ) {
		error_log('Error reading contents: '.print_r($error, true)."\n", 3, "aloha.log");
	} else {
		
		if ( array_key_exists('content', $row) ) {
			return $row['content'];
		} else {
			return 'click para editar.';
		}
	}	
}

?>