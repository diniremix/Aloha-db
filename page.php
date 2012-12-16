<?php 
	require_once 'lib.php';
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en"> 
	<head>
		<title>Aloha Editor | guardar el contenido en una DB</title>
		<script type="text/javascript" src="aloha/src/lib/require.js"></script>
		<script type="text/javascript" src="aloha/src/lib/vendor/jquery-1.7.2.js"></script>
		<link rel="stylesheet" href="aloha/src/css/aloha.css" type="text/css">
		<script src="./aloha-config.js"></script>
		<script src="aloha/src/lib/aloha.js"
      data-aloha-plugins="common/ui,common/format,common/highlighteditables,common/link,common/paste,common/image,common/contenthandler,common/undo,common/commands,common/abbr,common/block,common/table,common/list"></script>
		<link rel="stylesheet" href="style.css" type="text/css">
		<!-- save the content of the page -->
		<script src="./aloha-save.js"></script>
		<script type="text/javascript">
			Aloha.ready( function() {
				var $ = Aloha.jQuery;
				$('.editable').aloha();
			});
		</script>
	</head>
	<body>
		<div id="log"></div>
		<h1>Ejemplo de uso de Aloha Editor</h1>
		<p>HAga click en cada item para editar, una vez termine de editarlos cambios se guardaran de forma automatica.</p>
		<input type="button" id="guardar" name="guardar" value="Guardar cambios" placeholder="">
		<div class="editable" id="headline"><?=getAlohaContent('headline')?></div>
		<div class="editable" id="article"><?=getAlohaContent('article')?></div>
		<p id="edithtml5" contentEditable="true">Prueba a editar este contenido sin usar aloha!.</p>
		<h2>Textarea</h2>
		<textarea name="mytextarea" id="mytextarea" rows="10" class="editable"><?=getAlohaContent('mytextarea')?></textarea>
	</body>
</html>
