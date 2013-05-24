<?php

$p1 = $_GET["p1"];
$p2 = $_GET["p2"];
$p3 = $_GET["p3"];
$user = $_GET["user"];
$id_evento = $_GET["evento"];

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

$id_pregunta = 4;
$query = sprintf("INSERT INTO respuesta (id_usuario, id_pregunta, id_evento, respuesta) VALUES (%s,%s,%s,'%s')", $id_usuario, $id_pregunta, $id_evento, $p1);
//mysql_query("UPDATE wsb_plato SET precio='"+$precio+"' WHERE FirstName='Peter' AND LastName='Griffin'");
$result = mysql_query($query);

$id_pregunta = 5;
$query = sprintf("INSERT INTO respuesta (id_usuario, id_pregunta, id_evento, respuesta) VALUES (%s,%s,%s,'%s')", $id_usuario, $id_pregunta, $id_evento, $p2);
//mysql_query("UPDATE wsb_plato SET precio='"+$precio+"' WHERE FirstName='Peter' AND LastName='Griffin'");
$result2 = mysql_query($query);

$id_pregunta = 6;
$query = sprintf("INSERT INTO respuesta (id_usuario, id_pregunta, id_evento, respuesta) VALUES (%s,%s,%s,'%s')", $id_usuario, $id_pregunta, $id_evento, $p3);
//mysql_query("UPDATE wsb_plato SET precio='"+$precio+"' WHERE FirstName='Peter' AND LastName='Griffin'");
$result3 = mysql_query($query);



mysql_close($conexion);


/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $resultados["mensaje"] = "en Preguntas 1";
	$resultados["validacion"] = "error";
}
elseif (!$result2) {
    $resultados["mensaje"] = "en Preguntas 2";
	$resultados["validacion"] = "error";
}
elseif (!$result3) {
    $resultados["mensaje"] = "en Preguntas 3";
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