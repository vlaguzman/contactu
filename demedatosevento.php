<?php 
$id_evento = $_GET['idevento'];

$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');

$consulta = sprintf("SELECT nombre, descripcion, fecha, hora, lugar, imagen FROM evento WHERE id='%s'", $id_evento);
$query_eventos = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

if($query_eventos)
{

	$registros = array();
	if(mysql_num_rows($query_eventos)){
		while ($unRegistro = mysql_fetch_assoc($query_eventos)) {
			$registros[] = array(
				'nombre' => utf8_encode($unRegistro['nombre']),
				'descripcion' => utf8_encode($unRegistro['descripcion']),
				'fecha' => $unRegistro['fecha'],
				'hora' => $unRegistro['hora'],
				'lugar' => utf8_encode($unRegistro['lugar']),
				'imagen'=> $unRegistro['imagen'],
				);
		}
	}
}

mysql_close($conexion);

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$query_eventos) {
    $resultados["mensaje"] = "Error";
	$resultados["validacion"] = "error";
}
else{

	$resultados["mensaje"] = "Consulta exitosa";
	$resultados["validacion"] = "ok";
	$resultados["registros"] = $registros;

}

/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);
/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';


?>