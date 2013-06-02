<?php

$id_evento = $_GET["idevento"];
$email = $_GET["email"];

$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');


$consulta = sprintf("SELECT * FROM registro AS t1, usuario AS t2 WHERE t1.id_usuario = t2.id AND t1.id_evento = '%s' AND t2.email = '%s'", $id_evento, $email);
$registrado = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);


$arreglo = array();
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if ($registrado) {
    $arreglo["mensaje"] = "Validacion Correcta";
	$arreglo["validacion"] = "ok";
	

}
else{

	$arreglo["mensaje"] = "error consulta";
	$arreglo["validacion"] = "no";


}


mysql_close($conexion);

//convierte los resultados a formato json
$resultadosJson = json_encode($arreglo);
//muestra el resultado en un formato que no da problemas de seguridad en browsers 
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>