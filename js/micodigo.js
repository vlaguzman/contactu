var user;

$('#formulario').submit(function() { 
	// recolecta los valores que inserto el usuario
	var datosUsuario = $("#nombredeusuario").val();
	var datosPassword = $("#clave").val();

  	archivoValidacion = "http://www.contactu.co/app/validacion_de_datos.php?jsoncallback=?";
	
	$.getJSON( archivoValidacion, { usuario:datosUsuario ,password:datosPassword})
	.done(function(respuestaServer) {
		alert(respuestaServer.mensaje + "\nGenerado en: " + respuestaServer.hora);
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
		 	user = datosUsuario;
			$.mobile.changePage("#iniciar");
			document.getElementById("t-nombre").innerHTML=datosUsuario;
			document.getElementById("evento-1").innerHTML=respuestaServer.numero;
		  
		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})
	return false;
})
	
$('#form-preguntas').submit(function() { 
	// recolecta los valores que inserto el usuario 	background-image:url(../img/enrolarme.png);
	var p1 = $("#pregunta1").val();
	var p2 = $("#pregunta2").val();
	var p3 = $("#pregunta3").val();

  	archivoPreguntas = "http://www.contactu.co/app/insertpreguntas.php?jsoncallback=?";
  	$.mobile.changePage("#eventos");  
	$.getJSON( archivoPreguntas, {user:user,p1:p1,p2:p2,p3:p3})
	.done(function(respuestaServer) {
		alert(respuestaServer.mensaje + "\nGenerado en: " + respuestaServer.hora);
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
			$.mobile.changePage("#eventos");  
			document.getElementById("evento-1").innerHTML=respuestaServer.numero;
		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})

	return false;
})

$('#form-registro').submit(function() { 
	// recolecta los valores que inserto el usuario
	var dNombre = $("#nombre").val();
	var dEmail = $("#email").val();
	var dTwitter = $("#twitter").val();	
	var dLinkedin = $("#linkedin").val();
	var dTelefono = $("#telefono").val();	
	var dAreas = $("#areas").val();
	var dPassword = $("#pass").val();


  	archivoRegistro = "http://www.contactu.co/app/registro.php?jsoncallback=?";
	$.mobile.changePage("#home");	
	$.getJSON( archivoRegistro, { nombre:dNombre,email:dEmail,twitter:dTwitter,linkedin:dLinkedin,telefono:dTelefono,areas:dAreas,password:dPassword})
	.done(function(respuestaServer) {
		alert(respuestaServer.mensaje + "\nGenerado en: " + respuestaServer.hora + "\n" +respuestaServer.generador)
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
			

		  
		}else{
			
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})
	return false;
})

$('#btn-enrolarme').click(function(){

	archivoEnrolarse = "http://www.contactu.co/app/enlistarusuario.php?jsoncallback=?";
  	$.mobile.changePage("#eventos");
	$.getJSON( archivoEnrolarse, {user:user})
	.done(function(respuestaServer) {
		alert(respuestaServer.mensaje + "\nGenerado en: " + respuestaServer.hora + "Numero: " + respuestaServer.numero);
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
		 	document.getElementById("evento-1").innerHTML=respuestaServer.numero;
			// document.getElementById("s1").innerHTML=count+1;

		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})

	return false;
});

$('#evento-p1').click(function(){
	
	archivoEnrolarse = "http://www.contactu.co/app/con_asistentesxevento.php?jsoncallback=?";
  	
	$.mobile.changePage("#participantes");
/*	var id_evento = 1;
	$.getJSON( archivoEnrolarse, {id_evento:id_evento})
	.done(function(respuestaServer) {
		
		if(respuestaServer.validacion == "ok"){
			alert("ojoooo");
			$.mobile.changePage("#participantes");
		 	/// si la validacion es correcta, muestra la pantalla "home"
		 			document.getElementById("t-ev1").innerHTML = respuestaServer.registros[0].nombre; 
					document.getElementById("d-ev1").innerHTML = respuestaServer.registros[0].email; 

		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})*/

	
		
/*	$.getJSON('archivoEnrolarse', {format: "json"}, function(usuarios) { 
		alert("registros 0 ");
		$.mobile.changePage("#participantes");
		document.getElementById("t-ev1").innerHTML = usuarios[0].nombre; 
		document.getElementById("d-ev1").innerHTML = usuarios[0].email; 
	});
*/
	return false;
});
	