$(function() {
	console.log("obteniendo info de los contenidos");
	$.ajax({
		url: 'managerdb.php?options=getcontent',
		method: 'GET',
		dataType:'json',
		success: function(data) {
			console.log("recibiendo de json");
			console.log(data);
			$("#headline").html('');
			$("#article").html('');
			$("#mytextarea").html('');
			//$.each(data,function(index,value) {
				$("#headline").html(data[0].contenido);
				$("#article").html(data[1].contenido);
				$("#mytextarea").html(data[2].contenido);
			//});		
		},
		error:function(e,error){
			console.log("Error:",error);
		}
	});
});