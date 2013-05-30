
// #70B3A0 verde superior - #F98800 naranja
const url_base = "http://www.contactu.co/demoday/";
//const url_base = "http://localhost:8888/contactu/";
const url_eventos = "demeeventos.php?jsoncallback=?"
const url_asistentes = "demeasistentesxevento.php?jsoncallback=?";
const url_datosParticipante = "demedatosusuario.php?jsoncallback=?";
const url_validacionUsuario = "validacion_de_datos.php?jsoncallback=?";
const url_insertarPreguntas = "insertpreguntas.php?jsoncallback=?";
const url_insertarPreguntas2 = "insertpreguntas2.php?jsoncallback=?";
const url_registroUsuario = "registro.php?jsoncallback=?";
const url_enrolarse = "enlistarusuario.php?jsoncallback=?";

var user;
var id_evento = 0;
var pos_evento = 0;
var id_asistente = 0;
var id_contactu = 0;
var pos_lista = 0;

function onLinkedInLoad() {
     IN.Event.on(IN, "auth", onLinkedInAuth);
}

function onLinkedInAuth() {
     IN.API.Profile("me")
     .fields("firstName", "lastName", "industry", "emailAddress", "primaryTwitterAccount", "pictureUrl")
     .result(displayProfiles);
}

function displayProfiles(profiles) {
    member = profiles.values[0];
     
    var dNombre = member.firstName + " " + member.lastName;
	var dEmail = member.emailAddress;
	var dTwitter = member.primaryTwitterAccount.providerAccountName;	
	var dLinkedin = "";
	var dTelefono = "";	
	var dAreas = member.industry;
	var dPassword = member.emailAddress;
	var dPicture = member.pictureUrl;
	 archivoRegistro = url_base + url_registroUsuario;
	

	$.getJSON( archivoRegistro, { nombre:dNombre,email:dEmail,twitter:dTwitter,linkedin:dLinkedin,telefono:dTelefono,areas:dAreas,password:dPassword,picture:dPicture})
	.done(function(respuestaServer) {
		if(respuestaServer.validacion == "ok"){
			
		 	/// si la validacion es correcta, muestra la pantalla "home"
		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})

				var datosUsuario = dEmail;
			var datosPassword = dPassword;

		  	archivoValidacion = url_base + url_validacionUsuario;
			
			$.getJSON( archivoValidacion, { usuario:datosUsuario ,password:datosPassword})
			.done(function(respuestaServer) {
				
				if(respuestaServer.validacion == "ok"){
					
				 	/// si la validacion es correcta, muestra la pantalla "home"
				 	user = datosUsuario;
				 	pass = datosPassword;
					var elemento = respuestaServer.usuario[0];
				 	if(elemento['mostrarPreguntas'] == 1){
						$.mobile.changePage("#iniciar");

						$('#i-datos-top img').attr("src", elemento['imagen']);
						$elmt_hd = $('<h4>'+elemento['nombre']+'</h4>');
						$elmt_p1 = $('<p>Area: '+elemento['area']+'</p>');
						$elmt_p2 = $('<p>Twitter: '+elemento['twitter']+'</p>');
						$elmt_p3 = $('<p>Correo: '+elemento['email']+'</p>');

						$('#i-datos-top article').append($elmt_hd);
						$('#i-datos-top article').append($elmt_p1);
						$('#i-datos-top article').append($elmt_p2);
						$('#i-datos-top article').append($elmt_p3);

					}
					else{
						$.mobile.changePage("#eventos");
					}
					//document.getElementById("t-nombre").innerHTML=datosUsuario;
					//document.getElementById("evento-1").innerHTML=respuestaServer.numero;  
				}else{
				  /// ejecutar una conducta cuando la validacion falla
				}
		  
			})
	return false;

}

$('#form-registro').submit(function() { 
	// recolecta los valores que inserto el usuario
	var dNombre = $("#nombre").val();
	var dEmail = $("#email").val();
	var dTwitter = $("#twitter").val();	
	var dLinkedin = $("#linkedin").val();
	var dTelefono = $("#telefono").val();	
	var dAreas = $("#areas").val();
	var dPassword = $("#pass").val();
	var dPicture = "http://contactu.co/app/img/avatar_mario.jpg";

  	archivoRegistro = url_base + url_registroUsuario;

	$.mobile.changePage("#home");	
	$.getJSON( archivoRegistro, { nombre:dNombre,email:dEmail,twitter:dTwitter,linkedin:dLinkedin,telefono:dTelefono,areas:dAreas,password:dPassword, picture:dPicture})
	.done(function(respuestaServer) {
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})
	return false;
})

$('#formulario').submit(function() { 
	// recolecta los valores que inserto el usuario
	var datosUsuario = $("#nombredeusuario").val();
	var datosPassword = $("#clave").val();

  	archivoValidacion = url_base + url_validacionUsuario;
	
	$.getJSON( archivoValidacion, { usuario:datosUsuario ,password:datosPassword})
	.done(function(respuestaServer) {

		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
		 	user = datosUsuario;
		 	pass = datosPassword;
		 	var elemento = respuestaServer.usuario[0];
		 	if(elemento['mostrarPreguntas'] == 1){
				$.mobile.changePage("#iniciar");

				$('#i-datos-top img').attr("src", elemento['imagen']);
				$elmt_hd = $('<h4>'+elemento['nombre']+'</h4>');
				$elmt_p1 = $('<p>Area: '+elemento['area']+'</p>');
				$elmt_p2 = $('<p>Twitter: '+elemento['twitter']+'</p>');
				$elmt_p3 = $('<p>Correo: '+elemento['email']+'</p>');

				$('#i-datos-top article').append($elmt_hd);
				$('#i-datos-top article').append($elmt_p1);
				$('#i-datos-top article').append($elmt_p2);
				$('#i-datos-top article').append($elmt_p3);

			}
			else{
				$.mobile.changePage("#eventos");
			}
			//document.getElementById("t-nombre").innerHTML=datosUsuario;
			//document.getElementById("evento-1").innerHTML=respuestaServer.numero;
		  
		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})

	return false;
})

$( "#eventos" ).on( "pageshow", function( event, ui ) {


	archivoEventos = url_base + url_eventos;

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
				$elmt_a2 = $('<a class="links-plus" onclick="almaceneIdPosEvento('+elemento['id']+', '+i+')" href="#'+elemento['estado']+'" data-rel="popup" data-position-to="window" data-transition="pop">Enrolarme</a>');
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

  	archivoParticipantes = url_base + url_asistentes;
	
	$.getJSON( archivoParticipantes, {idevento: id_evento, email: user})
	.done(function(respuestaServer) {
		if(respuestaServer.validacion == "ok"){
			
			$('#lista-participantes li').remove();
			for (var i = 0; i < respuestaServer.usuarios.length; i++) {
				var elemento = respuestaServer.usuarios[i];
				$elmt_lip = $('<li></li>');
			
				if ((i<3)||(elemento['desbloqueado']==1)) {
					
					$elmt_ap = $('<a onclick="almaceneIdParticipante('+elemento['id_usuario']+','+i+')" href="#datos">');
					$elmt_imgp = $('<img src="'+elemento['imagen']+'">');
					$elmt_h4p = $('<h4>'+elemento['nombre']+'</h4>');
					$elmt_pp = $('<p>'+elemento['area']+'</p>');

				}else{
					$elmt_ap = $('<a onclick="almaceneIdParticipante('+elemento['id_usuario']+','+i+')" href="#datos">');
					$elmt_imgp = $('<img src="'+elemento['avatar']+'">');
					$elmt_h4p = $('<h4>'+elemento['area']+'</h4>');
					$elmt_pp = $('<p>'+elemento['intereses']+'</p>');
				};

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
  	archivoParticipante = url_base + url_datosParticipante;

  	$('#datos-top article').empty();
  	$('#datos-q1 p').empty();
  	$('#datos-q2 p').empty();
	$('#datos-q3 p').empty();
	$('#datos-q4 p').empty();
	$('#datos-q5 p').empty();
	$('#datos-q6 p').empty();
	$.getJSON( archivoParticipante, {id_usuario: id_asistente, evento: id_evento})
	.done(function(respuestaServer) {
		if(respuestaServer.validacion == "ok"){
			
				var elemento = respuestaServer.datos[0];
								
				if (pos_lista<3) {
					$('#datos-top img').attr("src", elemento['foto']);
					$elmt_hd = $('<h4>'+elemento['nombre']+'</h4>');
					$elmt_p1 = $('<p>Area: '+elemento['area']+'</p>');
					$elmt_p2 = $('<p>Twitter: '+elemento['twitter']+'</p>');
					$elmt_p3 = $('<p>Correo: '+elemento['correo']+'</p>');

					$('#datos-top article').append($elmt_hd);
					$('#datos-top article').append($elmt_p1);
					$('#datos-top article').append($elmt_p2);
					$('#datos-top article').append($elmt_p3);
				}else{
					$('#datos-top img').attr("src", elemento['avatar']);	
					$elmt_hd = $('<h4>'+elemento['area']+'</h4>');
					$elmt_btn = $('<a href="#des-contactu" onclick="almaceneIdContactu('+elemento['id']+')" data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-theme="a">Desbloquear ContactU</a>');

					$('#datos-top article').append($elmt_hd);
					$('#datos-top article').append($elmt_btn);
					$('#datos-top article').trigger('create');

				};

				elemento = respuestaServer.datos[1];
				//$elmt_hd = $('<h4>'+elemento['q1']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['r1']+'</p>');
				//$('#datos-q1').append($elmt_hd);
				
				$('#datos-q1').append($elmt_p1);

				elemento = respuestaServer.datos[2];
				//$elmt_hd = $('<h4>'+elemento['q2']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['r2']+'</p>');
				//$('#datos-q2').append($elmt_hd);
				$('#datos-q2').append($elmt_p1);

				elemento = respuestaServer.datos[3];
				//$elmt_hd = $('<h4>'+elemento['q3']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['r3']+'</p>');
				//$('#datos-q3').append($elmt_hd);

				$('#datos-q3').append($elmt_p1);

				elemento = respuestaServer.datos[4];
				//$elmt_hd = $('<h4>'+elemento['q1']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['r4']+'</p>');
				//$('#datos-q1').append($elmt_hd);
				$('#datos-q4').append($elmt_p1);

				elemento = respuestaServer.datos[5];
				//$elmt_hd = $('<h4>'+elemento['q2']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['r5']+'</p>');
				//$('#datos-q2').append($elmt_hd);
				$('#datos-q5').append($elmt_p1);

				elemento = respuestaServer.datos[6];
				//$elmt_hd = $('<h4>'+elemento['q3']+'</h4>');
				$elmt_p1 = $('<p>'+elemento['r6']+'</p>');
				//$('#datos-q3').append($elmt_hd);
				$('#datos-q6').append($elmt_p1);

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

function almaceneIdParticipante(id_prt, pos){
	id_asistente = id_prt;
	pos_lista = pos;
}

function almaceneIdContactu(id_ctu){
	id_contactu = id_ctu;
	alert(id_ctu);
}




	
$('#form-preguntas').submit(function() { 
	// recolecta los valores que inserto el usuario 	background-image:url(../img/enrolarme.png);
	var p1 = $("#pregunta1").val();
	var p2 = $("#pregunta2").val();
	var p3 = $("#pregunta3").val();

  	archivoPreguntas = url_base + url_insertarPreguntas;

  //	$.mobile.changePage("#eventos");  
	$.getJSON( archivoPreguntas, {user:user,p1:p1,p2:p2,p3:p3})
	.done(function(respuestaServer) {
	
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
			$.mobile.changePage("#eventos");  
			//document.getElementById("evento-1").innerHTML=respuestaServer.numero;
		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})

	return false;
})

$('#form-preguntas2').submit(function() { 
	// recolecta los valores que inserto el usuario 	background-image:url(../img/enrolarme.png);
	var p1 = $("#pregunta4").val();
	var p2 = $("#pregunta5").val();
	var p3 = $("#pregunta6").val();


  	archivoPreguntas = url_base + url_insertarPreguntas2;

	$.getJSON( archivoPreguntas, {user:user,evento:id_evento,p1:p1,p2:p2,p3:p3})
	.done(function(respuestaServer) {
	
		if(respuestaServer.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
			$.mobile.changePage("#eventos");  
			//document.getElementById("evento-1").innerHTML=respuestaServer.numero;
		}else{
		  /// ejecutar una conducta cuando la validacion falla
		}
  
	})

	return false;
})



$('#btn-enrolarme').click(function(){

	archivoEnrolarse = url_base + url_enrolarse;


	$.getJSON( archivoEnrolarse, {user:user,idevento:id_evento})
	.done(function(respuesta) {

		if(respuesta.validacion == "ok"){
		 	/// si la validacion es correcta, muestra la pantalla "home"
		 	id_ev = "evento-"+pos_evento;
		 	document.getElementById(id_ev).innerHTML=respuesta.numero;
		 
		 	$.mobile.changePage("#preguntas2");
			// document.getElementById("s1").innerHTML=count+1;

		}else{
		//	document.getElementById("#mensajes").innerHTML="Ya estas registrado en este evento";
		  	$.mobile.changePage("#eventos");
		}
  
	})

	return false;
});

