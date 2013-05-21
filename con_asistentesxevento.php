<?php
$estado = "solicitado";

 
$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');

//$consulta = sprintf("SELECT t1.id_pedido, t1.id_mesa, t1.totalCuenta, t1.fecha, t2.id_plato, t2.cantidad FROM wsb_pedido AS t1, wsb_platoxpedido AS t2
//       WHERE t1.id_pedido = t2.id_pedido AND t1.estado='%s'", $estado);

$id_evento = 1;

$consulta = sprintf("SELECT t1.id_usuario, t2.nombre, t2.email, t2.area FROM registro AS t1, usuario AS t2
	WHERE t1.id_usuario = t2.id AND t1.id_evento='%s'", $id_evento);
$resultado = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

//$resultado = mysql_num_rows($resultado)

if($resultado)
{
$registros = array();
	if(mysql_num_rows($resultado)){
		while ($unRegistro = mysql_fetch_assoc($resultado)) {
			$registros[] = array(
				'id_usuario' => $unRegistro['id'],
				'nombre' => utf8_encode($unRegistro['nombre']),
				'email' => $unRegistro['email'],
				'twitter' => $unRegistro['twitter'],
				'area' => utf8_encode($unRegistro['area'])
			);
		}
	}
			
}

	
	//header('Content-type: application/json; charset=utf-8');
	//echo '{"registros":'.json_encode($registros).'}';

// crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion 
$resultados = array();

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $resultados["mensaje"] = "Usuario y password incorrectos";
	$resultados["validacion"] = "error";
}
else{

	$resultados["mensaje"] = "Validacion Correcta";
	$resultados["validacion"] = "ok";
	$resultados["usuarios"] = $registros;

}


//convierte los resultados a formato json
$resultadosJson = json_encode($resultados);
//muestra el resultado en un formato que no da problemas de seguridad en browsers 
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>