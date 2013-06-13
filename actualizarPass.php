<?php

$pass = $_GET["password"];
$email = $_GET["email"];
$passe = sha1($pass);

$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');

$query = sprintf("UPDATE usuario SET pass='%s' WHERE email='%s'", $passe, $email);
$result = mysql_query($query);

mysql_close($conexion);

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $resultados["mensaje"] = "Error Update ";
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