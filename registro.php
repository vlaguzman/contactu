<?php

$nombre = $_GET["nombre"];
$email = $_GET["email"];
$linkedin = $_GET["linkedin"];
$twitter = $_GET["twitter"];
$telefono = $_GET["telefono"];
$pass = $_GET["password"];
$areas = $_GET["areas"];


$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');
//$conexion = mysql_connect("localhost", "adminwb", "Lounge140") or die ("Error conexión BD");
//mysql_select_db('wasabi', $conexion)or die('No se encuentra la base de datos');


$query = sprintf("INSERT INTO usuario (nombre, email, pass, linkedin, twitter, telefono, areas) VALUES ('%s','%s','%s','%s','%s','%s','%s')", $nombre, $email, $pass, $linkedin, $twitter, $telefono, $areas);
//mysql_query("UPDATE wsb_plato SET precio='"+$precio+"' WHERE FirstName='Peter' AND LastName='Griffin'");
$result = mysql_query($query);

mysql_close($conexion);

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
$resultados["hora"] = date("F j, Y, g:i a"); 

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $resultados["mensaje"] = "Registro ";
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