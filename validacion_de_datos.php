<?php

/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

$passwordEnviadoE = sha1($passwordEnviado);
 
$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');
 
$consulta = sprintf("SELECT pass, mostrarPreguntas, nombre, img, email, twitter, areas FROM usuario WHERE email='%s'", $usuarioEnviado);
$resultado = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

if($resultado)
{
	$registros = array();
	if(mysql_num_rows($resultado)){
		while ($unRegistro = mysql_fetch_assoc($resultado)) {
			$passwordValido = $unRegistro['pass'];
			$registros[] = array(
				'mostrarPreguntas' => $unRegistro['mostrarPreguntas'],
				'nombre' => $unRegistro['nombre'],
				'imagen' => $unRegistro['img'],
				'email' => $unRegistro['email'],
				'twitter' => $unRegistro['twitter'],
				'area' => $unRegistro['areas'],
			);
		}
	}
}

$query = sprintf("SELECT COUNT(*) FROM registro WHERE id_evento='1'");
//mysql_query("UPDATE wsb_plato SET precio='"+$precio+"' WHERE FirstName='Peter' AND LastName='Griffin'");
$contador = mysql_query($query);

if($contador)
	{
		if(mysql_num_rows($contador)){
			while ($unRegistro = mysql_fetch_assoc($contador)) {
				$numero = $unRegistro['COUNT(*)'];
			}
		}
	
	}



mysql_close($conexion);

$usuarioValido = $usuarioEnviado;
 
 
/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();

 
/* verifica que el usuario y password concuerden correctamente */
if(  $usuarioEnviado == $usuarioValido  && $passwordEnviadoE == $passwordValido ){
	/*esta informacion se envia solo si la validacion es correcta */
	$resultados["mensaje"] = "Validacion Correcta";
	$resultados["validacion"] = "ok";
	$resultados["numero"] = $numero;
	$resultados["usuario"] = $registros;
 
}else{
	/*esta informacion se envia si la validacion falla */
	$resultados["mensaje"] = "Usuario o password incorrectos p1: ".$passwordEnviadoE." p2: ".$passwordValido;
	$resultados["validacion"] = "error";
}
 
 
/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);
 
/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
 
?>