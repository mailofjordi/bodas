nupticSimulator =  function (id_simulador) {
	var recorridoTotal = 0;
	var direccion;
	var requestData;

	for (var i = 60; i > 0; i--) {
		//create our data for request
		direccion = {
			norte : Math.floor((Math.random() * 1000) + 1),
			sur : Math.floor((Math.random() * 1000) + 1),
			este : Math.floor((Math.random() * 1000) + 1),
			oeste : Math.floor((Math.random() * 1000) + 1)
		}

		requestData = {
			id_simulador : id_simulador,
			num : i,
			direccion: direccion,
			recorrido: Math.floor((Math.random() * 10) + 10)
		}

		//create an ajax request to orval
		$.ajax({
		  url:"/orval",
		  type:"POST",
		  data:JSON.stringify(requestData),
		  contentType:"application/json; charset=utf-8",
		  dataType:"json",
		  success: function(data, textStatus, jqxhr){
		  	recorridoTotal = recorridoTotal + data.recorrido;
		  	$('#results').append(
		  		'<br>Orval ha registrado una petición con id: ' + data.idPeticion 
		  		+ ', dirección norte->' + data.direccion.norte
		  		+ ' sur->' + data.direccion.sur
		  		+ ' este->' + data.direccion.este
		  		+ ' oeste->' + data.direccion.oeste
		  		+ ' i recorrido ' + data.recorrido
		  		+ '. TOTAL recorrido por nuptic42: ' + recorridoTotal
		  	);
		  }
		});
	}
}