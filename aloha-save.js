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
			console.log("intentando guardar",pageId,content,contentId);
			var request = jQuery.ajax({
				url: "managerdb.php?options=save",
				type: "GET",
				data: {
					content : content,
					contentId : contentId,
					pageId : pageId
				},
				dataType: "html"
			});

			request.done(function(msg) {
				jQuery("#log").html( msg ).show().delay(800).fadeOut();
				console.log('el resultado fue',msg);
			});		

			request.error(function(jqXHR, textStatus) {
				alert( "Request failed: " + textStatus );
				console.log('el resultado fue un error',textStatus);
			});					
		});
	});
});
