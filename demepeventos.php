<?php 

$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');

//mysql_set_charset(utf8);
$consulta = "SELECT id, nombre, descripcion, fecha, hora, lugar, imagen, estado, registros FROM evento";
$resultado = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

mysql_close($conexion);


if($resultado)
{

	$registros = array();
	if(mysql_num_rows($resultado)){
		while ($unRegistro = mysql_fetch_assoc($resultado)) {
			$registros[] = array(
				'id' => $unRegistro['id'],
				'nombre' => utf8_encode($unRegistro['nombre']),
				'descripcion' => $unRegistro['descripcion'],
				'fecha' => $unRegistro['fecha'],
				'hora' => $unRegistro['hora'],
				'lugar' => $unRegistro['lugar'],
				'imagen'=> $unRegistro['imagen'],
				'estado'=> $unRegistro['estado'],
				'registros'=> $unRegistro['registros'],
				);
			
		}
	}

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$resultado) {
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





}