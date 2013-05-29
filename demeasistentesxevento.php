<?php

$id_evento = $_GET["idevento"];
 
$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');

$id_pregunta = 2;
$consulta = sprintf("SELECT t1.id_usuario, t2.nombre, t2.email, t2.areas, t2.img, t2.avatar, t3.respuesta FROM registro AS t1, usuario AS t2, respuesta AS t3
	WHERE t1.id_usuario = t2.id AND t3.id_usuario = t2.id AND t1.id_evento=%s AND t3.id_pregunta=%s", $id_evento, $id_pregunta);
$resultado = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

//$resultado = mysql_num_rows($resultado)

if($resultado)
{
$registros = array();
	if(mysql_num_rows($resultado)){
		while ($unRegistro = mysql_fetch_assoc($resultado)) {
			$registros[] = array(
				'id_usuario' => $unRegistro['id_usuario'],
				'nombre' => $unRegistro['nombre'],
				'imagen' => $unRegistro['img'],
				'email' => $unRegistro['email'],
				'twitter' => $unRegistro['twitter'],
				'area' => $unRegistro['areas'],
				'avatar' => $unRegistro['avatar'],
				'intereses' => $unRegistro['respuesta'],
			);
		}
	}
			
}

// crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion 
$arreglo = array();

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$resultado) {
    $arreglo["mensaje"] = "en con_asistentes";
	$arreglo["validacion"] = "error";
}
else{

	$arreglo["mensaje"] = "Validacion Correcta";
	$arreglo["validacion"] = "ok";
	$arreglo["usuarios"] = $registros;

}


//convierte los resultados a formato json
$resultadosJson = json_encode($arreglo);
//muestra el resultado en un formato que no da problemas de seguridad en browsers 
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>