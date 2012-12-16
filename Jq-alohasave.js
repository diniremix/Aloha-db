var content;
var contentId;
var pageId = window.location.pathname;

Aloha.ready(function() {
	Aloha.require( ['aloha', 'aloha/jquery'], function( Aloha, jQuery) {
		// save all changes after leaving an editable
		Aloha.bind('aloha-editable-deactivated', function(){
			var content = Aloha.activeEditable.getContents();
			var contentId = Aloha.activeEditable.obj[0].id;		
			// textarea handling -- html id is "xy" and will be "xy-aloha" for the aloha editable
			if ( contentId.match(/-aloha$/gi) ) {
				contentId = contentId.replace( /-aloha/gi, '' );
			}
		});
	});
});

$(function() {
	$("#guardar").click(function(e) {
		content=$("#mytextarea-aloha").html();
		contentId="mytextarea";
		e.preventDefault();
		console.log("intentando guardar",pageId,content,contentId);
		$.ajax({
			url: 'save.php',
			method: 'post',
			data: {
				content : content,
				contentId : contentId,
				pageId : pageId
			},
			dataType: "html",
			success: function(data) {
				console.log("exito",data);
				console.log("actualizando pagina");
				//setTimeout( "window.location.href='page.php'", 2000 );
			},
			error:function(regreso, msgerror){
				console.log("Error al traer",msgerror);
			}
		});
	});
});