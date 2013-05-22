var user;
var id_evento = 0;
var pos_evento = 0;
var id_asistente =0;

$( "#eventos" ).on( "pageshow", function( event, ui ) {
	//archivoEventos = "http://www.contactu.co/app/contactu/demeeventos.php?jsoncallback=?";
	archivoEventos = "http://localhost:8888/contactu/demeeventos.php?jsoncallback=?";

	$.getJSON( archivoEventos, { })
	.done(function(respuestaServer) {
		
		if(respuestaServer.validacion == "ok"){
			$('#lista-eventos li').remove();

			for (var i = 0; i < respuestaServer.registros.length; i++) {
				
				var elemento = respuestaServer.registros[i];
				$elmt_li = $('<li data-icon="plus"></li>');
				$elmt_a = $('<a id="evento-a'+i+'" onclick="almaceneIdEvento('+elemento['id']+')" href="#participantes"></a>');
				$elmt_img = $('<img src="'+elemento['imagen']+'">');
				$elmt_h4 = $('<h4>'+elemento['nombre']+'</h4>');
				$elmt_p = $('<p>'+elemento['fecha']+" - "+elemento['hora']+'</p>');
				$elmt_span = $('<span id="evento-'+i+'" class="ui-li-count">'+elemento['registros']+'</span>');
				$elmt_a2 = $('<a onclick="almaceneIdPosEvento('+elemento['id']+', '+i+')" href="#'+elemento['estado']+'" data-rel="popup" data-position-to="window" data-transition="pop">Enrolarme</a>');
				$elmt_a.append($elmt_img);
				$elmt_a.append($elmt_h4);
				$elmt_a.append($elmt_p);
				$elmt_a.append($elmt_span);
				$elmt_li.append($elmt_a);
				$elmt_li.append($elmt_a2);
				$('#lista-eventos').append($elmt_li);

			};

		}else{

		}
		$("#lista-eventos").listview('refresh');
  
	})
	return false;			

})



$( "#participantes" ).on( "pageshow", function( event, ui ) {
	//archivo = "http://www.contactu.co/app/demeasistentesxevento.php?jsoncallback=?";
  	archivoParticipantes = "http://localhost:8888/contactu/demeasistentesxevento.php?jsoncallback=?";
	
	$.getJSON( archivoParticipantes, {idevento: id_evento})
	.done(function(respuestaServer) {
		if(respuestaServer.validacion == "ok"){
			
			$('#lista-participantes li').remove();
			for (var i = 0; i < respuestaServer.usuarios.length; i++) {
				
				var elemento = respuestaServer.usuarios[i];

				$elmt_lip = $('<li></li>');
				$elmt_ap = $('<a onclick="almaceneIdParticipante('+elemento['id_usuario']+')" href="#datos">');
				$elmt_imgp = $('<img src="'+elemento['imagen']+'">');
				$elmt_h4p = $('<h4>'+elemento['nombre']+'</h4>');
				$elmt_pp = $('<p>'+elemento['area']+'</p>');
				$elmt_ap.append($elmt_imgp);
				$elmt_ap.append($elmt_h4p);
				$elmt_ap.append($elmt_pp);
				$elmt_lip.append($elmt_ap);
				$('#lista-participantes').append($elmt_lip);
			};

		}else{

		}
		$("#lista-participantes").listview('refresh');  
	})
	return false;			

})

$( "#datos" ).on( "pageshow", function( event, ui ) {
	//archivo = "http://www.contactu.co/app/demedatosusuario.php?jsoncallback=?";
  	archivoParticipantes = "http://localhost:8888/contactu/demedatosusuario.php?jsoncallback=?";
			
	$.getJSON( archivoParticipantes, {id_usuario: id_asistente})
	.done(function(respuestaServer) {
		if(respuestaServer.validacion == "ok"){
			
				var elemento = respuestaServer.datos[0];
								
				$('#datos-top img').attr("src", elemento['foto']);
	
				$elmt_hd = $('<h4>'+elemento['nombre']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['area']+'</p>');
				$elmt_p2 = $('<p>'+elemento['twitter']+'</p>');
				$elmt_p3 = $('<p>'+elemento['correo']+'</p>');

				$('#datos-top article').append($elmt_hd);
				$('#datos-top article').append($elmt_p1);
				$('#datos-top article').append($elmt_p2);
				$('#datos-top article').append($elmt_p3);

				$elmt_hd = $('<h4>'+elemento['q1']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['r1']+'</p>');

				$('#datos-q1').append($elmt_hd);
				$('#datos-q1').append($elmt_p1);

				$elmt_hd = $('<h4>'+elemento['q2']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['q2']+'</p>');

				$('#datos-q2').append($elmt_hd);
				$('#datos-q2').append($elmt_p1);

				$elmt_hd = $('<h4>'+elemento['q3']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['q3']+'</p>');

				$('#datos-q3').append($elmt_hd);
				$('#datos-q3').append($elmt_p1);

		}else{

		}
		

	})
	return false;			

})

function almaceneIdPosEvento(ev_id, ref_span){
	id_evento = ev_id;
	pos_evento = ref_span;
}

function almaceneIdEvento(ev_id){
	id_evento = ev_id;
}

function almaceneIdParticipante(id_prt){
	id_asistente = id_prt;
}

$('#formulario').submit(function() { 
	// recolecta los valores que inserto el usuario
	var datosUsuario = $("#nombredeusuario").val();
	var datosPassword = $("#clave").val();

  	//archivoValidacion = "http://www.contactu.co/app/validacion_de_datos.php?jsoncallback=?";
	archivoValidacion = "http://localhost:8888/contactu/validacion_de_datos.php?jsoncallback=?";
	
	$.getJSON( archivoValidacion, { usuario:datosUsuario ,password:datosPassword})
	.done(function(respuestaServer) {
		alert(respuestaServer.mensaje + "\nGenerado en: " + respuestaServer.hora);
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
		 	user = datosUsuario;
		 	if(respuestaServer.primeravez == 1)
				$.mobile.changePage("#iniciar");
			else
				$.mobile.changePage("#eventos");
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

  	//archivoPreguntas = "http://www.contactu.co/app/insertpreguntas.php?jsoncallback=?";
  	archivoPreguntas = "http://localhost:8888/contactu/insertpreguntas.php?jsoncallback=?";


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


  	//archivoRegistro = "http://www.contactu.co/app/registro.php?jsoncallback=?";
  	archivoRegistro = "http://localhost:8888/contactu/registro.php?jsoncallback=?";


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

//	archivoEnrolarse = "http://www.contactu.co/app/enlistarusuario.php?jsoncallback=?";
	archivoEnrolarse = "http://localhost:8888/contactu/enlistarusuario.php?jsoncallback=?";

  	alert("Este es el id que vamos a enviar: "+ id_evento);
	$.getJSON( archivoEnrolarse, {user:user,idevento:id_evento})
	.done(function(respuesta) {
		alert(respuesta.mensaje + "Numero: " + respuesta.numero);
		if(respuesta.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
		 	id_ev = "evento-"+pos_evento;
		 	document.getElementById(id_ev).innerHTML=respuesta.numero;
		 	$.mobile.changePage("#eventos");
			// document.getElementById("s1").innerHTML=count+1;

		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})

	return false;
});

