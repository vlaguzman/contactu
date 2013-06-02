<?php

$user = $_GET["user"];

$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');
//$conexion = mysql_connect("localhost", "adminwb", "Lounge140") or die ("Error conexión BD");
//mysql_select_db('wasabi', $conexion)or die('No se encuentra la base de datos');


$consulta = sprintf("SELECT id FROM usuario WHERE email='%s'", $user);
$resultado = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

if($resultado)
{
	if(mysql_num_rows($resultado)){
		while ($unRegistro = mysql_fetch_assoc($resultado)) {
			$id_usuario = $unRegistro['id'];
		}
	}
}

mysql_close($conexion);




$resultados = array();
$resultados["hora"] = date("F j, Y, g:i a"); 

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$resultado) {
    $resultados["mensaje"] = " en SELECT id FROM ";
	$resultados["validacion"] = "error";
}
else{
	$resultados["mensaje"] = "Validacion Correcta";
	$resultados["validacion"] = "ok";
}


/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);
/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';


?>