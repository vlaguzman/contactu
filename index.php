<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">	
<title>ContactU</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<!--
<link rel="stylesheet" type="text/css" href="css/jquery.mobile-1.2.1.css">
<link rel="stylesheet" type="text/css" href="css/estilos.css">

-->
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
<link rel="stylesheet" href="css/contactu-themes.css" />

<link rel="stylesheet" type="text/css" href="css/estilos_basicos.css">
<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
<!-- SHA3 -->
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>


<!-- Login LinkedIn  -->
<script src="http://platform.linkedin.com/in.js" type="text/javascript">
        api_key: nyvx5ricm4ew
        onLoad: onLinkedInLoad
        authorize: false
        lang:  es_ES
</script>


<!-- Twitter compartir frases -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="https://da189i1jfloii.cloudfront.net/js/kinvey-phonegap-0.9.14.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>

<!--
<link rel="stylesheet" type="text/css" href="css/jquery.mobile-1.3.1.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script src="phonegap.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.3.1.js"></script>
-->
</head>

<body>
	<div data-role="page" data-theme="a" id="home">
		<div data-role="header">
			
		</div>
		<div data-role="content" data-theme="a">
			<div id="loader-home"><img src="img/loader.gif" /></div>
			<img src="img/logo.png">
			<!--<img src="img/copy.png">-->
			<h1 id="bumperstick">Hacemos visibles ContactUs Efectivos</h1>

			<div id="login">
				<script type="IN/Login"></script>
			</div>

			<div id="login-safari">
				<a id="linkedin-safari" class="brand" href="https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=nyvx5ricm4ew&scope=r_fullprofile%20r_emailaddress%20r_contactinfo&state=YCEEFWF45453sdffef424&redirect_uri=http://beta.contactu.co/authLinkedin.php" target="_blank"> 
		       		<img src="img/linkedin-button.png"/> 
		      	</a>
	      	</div>

			
			<div id="msj-error">
			</div>
			<form id="formulario" >
      			<input data-theme="b" type="email" id="nombredeusuario" name="nombredeusuario" placeholder="Email" required>
     			<input data-theme="b" type="password" id="clave" name="clave" placeholder="Contraseña" >
      			<input data-theme="b" type="submit" value="Iniciar Sesión" id="botonLogin">
    		</form>	
	
	 		<a data-theme="b" href="#registro" data-role="button" data-theme="a"> Registrarse </a>

	 		
		</div>	

		<div id="redes-home">
			<a class="brand" href="https://www.facebook.com/contactuapp" target="_blank"> 
	       		<img src="img/fb.png"/> 
	      	</a>
	      	<a class="brand" href="http://twitter.com/contactuapp" target="_blank">   
	       	 <img src="img/tw.png"/> 
	      	</a> 
		</div>

		<div data-role="footer" class="ui-bar" data-position="fixed" data-id="footer1">
			
		</div>
	</div>

	<div data-role="page" data-theme="a" id="registro" data-add-back-btn="true">
		<div data-role="header">
			<h1>Registro</h1>
		</div>
		<div data-role="content" data-theme="b">
			<form id="form-registro">
				
				<label for="nombre">Nombre</label>
				<input type="text" id="nombre" name="nombre" required>
				
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required>
				
                <label for="password">Password</label><input type='password' id='p1' required>
                <label for="password">Confirm Password</label><input type='password' onfocus="validatePass(document.getElementById('p1'), this);" oninput="validatePass(document.getElementById('p1'), this);" required>
            	
            	<label for="areas">Selecciona el perfil con el que te identificas más:</label>
				<select id="areas" name="areas" data-native-menu="false" required>
					<option value="Administración/Negocios">Administración/Negocios</option>
					<option value="Arte">Arte</option>
					<option value="Dirección/Gerencia">Dirección/Gerencia</option>
					<option value="Deporte">Deporte</option>
					<option value="Economía/Contabilidad/Finanzas">Economía/Contabilidad/Finanzas</option>
					<option value="Ingeniería/Técnico/Programador">Ingeniería/Técnico/Programador</option>
					<option value="Legal">Legal</option>
					<option value="Marketing/Ventas">Marketing/Ventas</option>
					<option value="Medicina/Salud">Medicina/Salud</option>
					<option value="Música">Música</option>
					<option value="Recursos Humanos">Recursos Humanos</option>
					<option value="Literatura Redacción">Literatura Redacción</option>
				</select>

				<label for="linkedin">Linkedin</label>
				<input type="text" id="linkedin" name="linkedin">

				<label for="twitter">Twitter</label>
				<input type="text" id="twitter" name="twitter">

				<label for="telefono">Telefono</label>
				<input type="text" id="telefono" name="telefono">


				<input type="submit" value="enviar" id="botonRegistro"/>
			</form>

		</div>	
		<div data-role="footer" class="ui-bar">
			<h4>www.contactu.co</h4>		
		</div>

	</div>

	<div data-role="page" data-theme="a" id="registro-pass">
		<div data-role="header">
			<h1>Registro</h1>
		</div>
		<div data-role="content" data-theme="b">
			<form id="form-registro-pass">
				
				<h3>Para terminar el registro ingresa una contraseña.</h3>
				
                <label for="password">Password</label><input type='password' id='p1-lk' required>
                <label for="password">Confirm Password</label><input type='password' onfocus="validatePass(document.getElementById('p1-lk'), this);" oninput="validatePass(document.getElementById('p1-lk'), this);" required>


				<input type="submit" value="enviar" id="botonPass"/>
			</form>

		</div>	
		<div data-role="footer" class="ui-bar">
			<h4>www.contactu.co</h4>		
		</div>

	</div>

	<div data-role="page" data-theme="a" id="iniciar">
		<div data-role="header">
			<h1>ContactU</h1>
		</div>
		<div data-role="content" data-theme="b">
			
			<article id="i-datos-top">
				<img>
				<article>
					<!-- <h3>Yurany López</h3>
					<p>Marketing y ventas</p>
					<p>@yuraloco</p>
					<p>yuraloco@gmail.com</p> -->
				</article>
			</article>
			<div>
				<img src="">
				<h3>DATE A CONOCER PARA QUEDAR EN CONTACTU</h3>
				<h3>Con ContactU podrás hacerte visible a los eventos que asistes y ver el perfil e intereses de otros participantes.</h3>
			</div>
				
				<form id="form-preguntas">
	      
	      			<label for="pregunta1"> ¿En qué cosas ocupas tu tiempo actualmente? </label>
	      			<!--<span class="counter">200</span> -->
	      			<textarea id="pregunta1" name="pregunta1" maxlength="200" placeholder="200 caracteres"></textarea>
	      			<label for="pregunta3"> ¿Qué le puedes aportar a otras personas? </label>
	      			<textarea id="pregunta3" name="pregunta3" maxlength="200" placeholder="200 caracteres"></textarea>
	      			
	      			<label for="pregunta2"> Intereses (etiquetas). Así sabrás de qué más puedes hablar con otros participantes.</label>
					<p>Ej: Cine, viajes, tecnología, videojuegos. </p>
	      			<textarea id="pregunta2" name="pregunta2" maxlength="200"></textarea>

	      			<input type="submit" value="Listo!" id="botonpreguntas"/>

	    		</form>	
				
		</div>	
		<div data-role="footer" class="ui-bar" data-position="fixed" data-id="footer1">
			
		</div>
	</div>



	<div data-role="page" data-theme="c" id="eventos">
		
		<div data-theme="a" data-role="header" >
			<a href="#home" onclick="cerrarSesion()" data-icon="delete">Cerrar</a>
			<h2></h2>
		</div>
		<div data-theme="b" id="titulo-eventos" data-role="header" >

			<h1>ENRÓLATE EN UN EVENTO</h1>
		</div>
		<div data-role="content" data-theme="b">
			<div id="loader-eventos"><img src="img/loader.gif" /></div>
			<ul id="lista-eventos" data-role="listview"  data-theme="c" >
			 	
			<!--	<li data-icon="plus">
					<a id="evento-p1" href="#participantes">
						<img src="img/talk.jpg">
						<h4>APPS.CO EXPO</h4>
						<p>Lunes 20 de Mayo - 8:00 </p>
						<span id="evento-1" class="ui-li-count">0</span>
					</a>
				    <a href="#enrolarme" data-rel="popup" data-position-to="window" data-transition="pop">Enrolarme</a>
				</li>  -->
			
			
			</ul>

			<div data-role="popup" id="ev-enrolarme" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
			    <h3>¿Aparecer en la lista de asistentes?</h3>
			    <p>Quieres que tu información se adicione a la lista de asistentes.</p>
			    <a id="btn-enrolarme" href="#eventos" data-role="button" data-rel="back" data-theme="b" data-icon="check" data-inline="true" data-mini="true">Enrolarme</a>
			    <a href="#eventos" data-role="button" data-rel="back" data-inline="true" data-mini="true">Cancel</a>
			</div>

			<div data-role="popup" id="ev-inactivo"  data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
			    <h3>El registro a este evento aún no está disponible.</h3>
			    <p>Pronto podrás buscar más ContactUs.</p>
			    <a href="#eventos" data-role="button" data-rel="back" data-theme="b" data-icon="check" data-inline="true" data-mini="true">OK</a>
			</div>

			<div data-role="popup" id="ev-pasado"  data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
			    <h3>El registro a este evento ya no está disponible.</h3>
			    <p>Busca eventos futuros para hacerte visible.</p>
			    <a href="#eventos" data-role="button" data-rel="back" data-theme="b" data-icon="check" data-inline="true" data-mini="true">OK</a>
			</div>

		</div>	

		<div class="footer" data-role="footer" class="ui-bar" data-position="fixed" data-id="footer1">
			<div data-role="navbar">
				<h4>Powered by www.conectandomentes.com</h4>
				<!--<ul>
					<li><a href="#p2" data-icon="search" class="ui-btn-active">Explora</a></li>
					<li><a href="#p2" data-icon="grid">Mis Eventos</a></li>
					<li><a href="#p2" data-icon="star">Contactus</a></li>
				</ul>-->
			</div>
		</div>

	</div>


	<div data-role="page" data-theme="a" id="preguntas2">
		<div data-role="header">
			<h1></h1>
		</div>
		<div data-role="content" data-theme="b">
			
			<div>
				<img src="">
				<h3>PARA POTENCIAR LA EXPERIENCIA EN EL ESPACIO DE NETWORKING:</h3>
			</div>
				
				<form id="form-preguntas2" >
	      
	      			<label for="pregunta5">¿Qué perfil específico estás buscando?</label>
	      			<select id="pregunta5" name="pregunta5" data-native-menu="false">
						<option value="Administración/Negocios">Administración/Negocios</option>
						<option value="Dirección/Gerencia">Dirección/Gerencia</option>
						<option value="Ingeniería/Técnico/Programador">Ingeniería/Técnico/Programador</option>
						<option value="Diseño gráfico">Diseño gráfico</option>
						<option value="Marketing/Ventas">Marketing/Ventas</option>
						<option value="Economía/Contabilidad/Finanzas">Economía/Contabilidad/Finanzas</option>
						<option value="Literatura Redacción">Literatura Redacción</option>
						<option value="Legal">Legal</option>
						<option value="Deporte">Deporte</option>
						<option value="Arte">Arte</option>
						<option value="Medicina/Salud">Medicina/Salud</option>
						<option value="Música">Música</option>
						<option value="Recursos Humanos">Recursos Humanos</option>
						<option value="Ninguno en particular">Ninguno en particular</option>
					</select>

					<label for="pregunta6">¿Esperas encontrar algo en particular?</label>
	      			 <select id="pregunta6" name="pregunta6" data-native-menu="false">
						<option value="Nuevas oportunidades de trabajo">Nuevas oportunidades de trabajo</option>
						<option value="Contacto de potenciales socios">Contacto de potenciales socios</option>
						<option value="Contacto de potenciales clientes">Contacto de potenciales clientes</option>
						<option value="Buscar gente para mi empresa">Buscar gente para mi empresa</option>
						<option value="Nada en particular">Nada en particular</option>
		
					</select>

					<label for="pregunta4">Usa este espacio para detallar una de las respuestas anteriores o cuéntanos si hay algo de lo que NO quisieras hablar durante el networking.</label>
	      			<textarea id="pregunta4" name="pregunta4" maxlength="200" placeholder="200 caracteres" required></textarea>
	      			
	      			<input type="submit" value="Listo!" id="botonpreguntas"/>

	    		</form>	
				
		</div>	
		<div data-role="footer" class="ui-bar" data-position="fixed" data-id="footer1">
			
		</div>
	</div>


	<div data-role="page" data-theme="c" id="participantes" data-add-back-btn="true">
		<div data-role="header" >
			<h1></h1>
		</div>
		<div id="event-header" data-role="collapsible" data-inset="true" data-theme="d">
			<h1> Información de evento</h1>
			<h4 id="event-header-h3"></h4>
			<p id="event-header-p1"></p>
			<p id="event-header-p2"></p>
			<p id="event-header-p3"></p>
			
		</div>
		<div data-role="content" data-theme="b">
			<div id="loader-participantes"><img src="img/loader.gif" /></div>
			<ul id="lista-participantes" data-role="listview" data-theme="c" data-filter="true" data-filter-placeholder="Buscar Contactus">
				<!-- <li>
					<a href="#datos">
						<img src="img/foto_yura.png">
						<h4 id="t-ev1">Yurany Lopéz</h4>
						<p id="d-ev1">Marketing y ventas </p>
					</a>
				</li> -->
			</ul>


		</div>	

		<div data-role="footer" class="ui-bar" data-position="fixed" data-id="footer1">
			<div data-role="navbar">
				<!--<ul>
					<li><a href="#p2" data-icon="search" class="ui-btn-active">Explora</a></li>
					<li><a href="#p2" data-icon="grid">Mis Eventos</a></li>
					<li><a href="#p2" data-icon="star">Contactus</a></li>
				</ul>-->
			</div>
		</div>

	</div>

	<div data-role="page" data-theme="a" id="datos" data-add-back-btn="true" data-add-back-btn="true">
		<div data-role="header">
			<h1></h1>
		</div>
		<div data-role="content" data-theme="b">
			<div id="loader-datos"><img src="img/loader.gif" /></div>
			<article id="datos-top">
				<img>
				<article>
					<!-- <h3>Yurany López</h3>
					<p>Marketing y ventas</p>
					<p>@yuraloco</p>
					<p>yuraloco@gmail.com</p> -->
				</article>
			</article>

			<div data-role="popup" id="des-contactu" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
			    <h3>¿Desbloquear este ContactU?</h3>
			    <p>Regálanos un Tweet a cambio de este ContactU.</p>

			   <!-- <a id="btn-enrolarme" href="#eventos" data-role="button" data-rel="back" data-theme="b" data-icon="check" data-inline="true" data-mini="true">Enrolarme</a> -->

			    <a data-role="button" onclick="mostrarBtnDesbloquear()" data-theme="b" data-icon="check" data-inline="true" data-mini="true" href="https://twitter.com/intent/tweet?screen_name=contactuapp&text=ya está al aire la %23versiónBeta. Entra y %23QuedaEnContactU http://beta.contactu.co/" data-lang="es" data-size="large" data-related="conectandoments">Desbloquear con un tweet</a>

			    <a id="btn-desbloquear" href="#eventos" data-role="button" data-rel="back" data-inline="true" data-mini="true">¡Ya! ;)</a>
			</div>
		
			<section>
				<article id="datos-q1">
					<h4>En qué cosas ocupo mi tiempo actualmente:</h4>
					<!--
					<p>Hacer mermeladas, estar en un emprendimiento digital.</p>
					-->
				</article>
				<article id="datos-q2">
					<h4>Intereses:</h4>
					<!--
					<p>Música, gastronomía, emprendimiento, mermeladas, diseño, publicidad, comunidades.</p>
					-->
				</article>
				<article id="datos-q3">
					<h4>¿Qué le puedo aportar a otras personas?</h4>
					<!--
					<p>Experiencia en diseño, publicidad, gastronomía y orientación al logro.</p>
					-->
				</article>
				<article id="datos-q4">
					<h4>Información adicional:</h4>
					<!--
					<p>Hacer mermeladas, estar en un emprendimiento digital.</p>
					-->
				</article>
				<article id="datos-q5">
					<h4>Perfil de persona que estoy buscando:</h4>
					<!--
					<p>Música, gastronomía, emprendimiento, mermeladas, diseño, publicidad, comunidades.</p>
					-->
				</article>
				<article id="datos-q6">
					<h4>Lo que espero del networking:</h4>
					<!--
					<p>Experiencia en diseño, publicidad, gastronomía y orientación al logro.</p>
					-->
				</article>
			</section>
				
		</div>	
		<div data-role="footer" class="ui-bar" data-position="fixed" data-id="footer1">
			<h4>Powered by www.conectandomentes.com</h4>
		</div>
	</div>

<script type="text/javascript" src="js/micodigo.js"> </script>
<?php
	if (isset($_GET['fname'])) {
		$twitter = $_GET['twitter'];
		$name = $_GET['fname']." ".$_GET['lname']; 
		$industry = $_GET['industry']; 
		$email = $_GET['email']; 
		$photo = $_GET['photo'];
		?>
		<script> 
			loginLinkedinP('<? echo $name?>','<? echo $email?>','<? echo $twitter?>','<? echo $industry?>','<? echo $photo?>','<? echo $email?>');
		</script>
		<?php
	} 
?>



<!-- 
	código Kinvey
<script type="text/javascript" src="js/oauth.js"> </script>
-->
  <!-- Analytics -->

  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-40633893-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>

</body>

</html>