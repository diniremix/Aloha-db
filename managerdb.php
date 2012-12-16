<?php
date_default_timezone_set("America/Bogota");
class ConnectClass {
		var $conn;
	 	var $host;
	 	var $username;
	 	var $password;
	 	var $db;
	 	var $pageId;
		var $contentId;
		var $content;

	/**
	* [managerClass Constructor de la clase ConnectClass]
	*/
	function ConnectClass(){
	 		$this->host='localhost';
	 		$this->username='root';
	 		$this->password='';
	 		$this->db='alohadb';
	 		$this->conn='';
	 		//save data
	 		$this->pageId = sqlite_escape_string($_REQUEST['pageId']);
			$this->contentId = sqlite_escape_string($_REQUEST['contentId']);
			$this->content =  sqlite_escape_string($_REQUEST['content']);
	}
	
	/**
	 * [connect realiza la conexion al servidor]
	 * @return [obj] $conn [objeto de conexion para la base de datos]
	 */
	function connect(){
		$this->conn = mysql_connect($this->host,$this->username,$this->password) or die( mysql_error() );
		mysql_select_db($this->db,$this->conn) or die( mysql_error() );
		return $this->conn;
	}

	/**
	 * [getContenidos description]
	 * @param  [string] $contentId [nombre del div a buscar]
	 * @return [string] [contenido del div buscado, o mensaje por defecto en caso de no existir]
	 */
	function getContenidos($contentId){
		$pageId = $_SERVER['SCRIPT_NAME'];
		$sql_query = "SELECT content FROM `data_aloha` WHERE pageId = '".$this->pageId."' AND contentId = '".$this->contentId."'";
		$result=mysql_query($sql_query);
		if($row=mysql_fetch_array($result)){
			return $row['content'];
		}else{
			return 'click para editar';			
		}
	}
	/**
	 * [saveContenidos se encarga de guardar en la db el contenido de los div modificados]
	 */
	function saveContenidos(){
		$existe=false;
		$tipo='ninguno';
		$id=0;
		$pageId = $_SERVER['SCRIPT_NAME'];
		$sql_query = "SELECT id FROM `data_aloha` WHERE pageId = '".$this->pageId."' AND contentId = '".$this->contentId."'";
		$result=mysql_query($sql_query);
		if($row=mysql_fetch_array($result)){
			$id=$row['id'];
			$existe=true;
		}else{
			$existe=false;
		}			
		if ($existe){
			$tipo='update';
			$sql_query = "UPDATE `data_aloha` SET content = '".$this->content."' WHERE id = '".$id."'";
			$result=mysql_query($sql_query);
		}else{
			$tipo='insert';
			$sql_query = "INSERT INTO `data_aloha` (`pageId`,`contentId`,`content`) VALUES ('$this->pageId','$this->contentId','$this->content')";
			$result=mysql_query($sql_query);
		}
		$error=mysql_error($this->conn);

		if ( empty($error)) {
			echo 'Contenido salvado. fue: '.$tipo;
		}else{
			echo 'Error: el contenido NO pudo ser salvado.'.$error;
		}
	}
}//class
?>
