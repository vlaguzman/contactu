<?php 

$id_usuario = $_GET['id_usuario'];

$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');

//mysql_set_charset(utf8);

//$consulta = sprintf("SELECT t1.id_usuario, t2.nombre, t2.email, t2.areas, t2.img FROM registro AS t1, usuario AS t2
	//WHERE t1.id_usuario = t2.id AND t1.id_evento=%s", $id_evento);

$consulta = sprintf("SELECT id, nombre, img, avatar, areas, twitter, email from usuario WHERE id='%s'", $id_usuario);

$query_datosusuario = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

mysql_close($conexion);


if($query_datosusuario)
{

	$registros = array();
	if(mysql_num_rows($query_datosusuario)){
		while ($unRegistro = mysql_fetch_assoc($query_datosusuario)) {
			$registros[] = array(
				'id' => $unRegistro['id'],
				'nombre' => $unRegistro['nombre'],
				'foto'  => $unRegistro['img'],
				'avatar'  => $unRegistro['avatar'],
				'area' => $unRegistro['areas'],
				'twitter' => $unRegistro['twitter'],
				'correo' => $unRegistro['email'],
				'q1' => $unRegistro['nombre'],
				'r1'=> $unRegistro['nombre'],
				'q2' => $unRegistro['nombre'],
				'r2'=> $unRegistro['nombre'],
				'q3' => $unRegistro['nombre'],
				'r3'=> $unRegistro['nombre'],

				);
		}
	}
}


/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$query_datosusuario) {
    $resultados["mensaje"] = "Error";
	$resultados["validacion"] = "error";
}
else{

	$resultados["mensaje"] = "Consulta exitosa";
	$resultados["validacion"] = "ok";
	$resultados["datos"] = $registros;

}

/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);
/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';


?>