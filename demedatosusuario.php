<?php 

$id_usuario = $_GET['id_usuario'];
$id_evento = $_GET['evento'];
$email = $_GET["email"];

$conexion = mysql_connect("localhost", "brain140_contact", "1de4s") or die ("Error conexión BD");
mysql_select_db('brain140_contactu', $conexion)or die('No se encuentra la base de datos');

//mysql_set_charset(utf8);

//$consulta = sprintf("SELECT t1.id_usuario, t2.nombre, t2.email, t2.areas, t2.img FROM registro AS t1, usuario AS t2
	//WHERE t1.id_usuario = t2.id AND t1.id_evento=%s", $id_evento);

//$consulta = sprintf("SELECT t1.id, t1.nombre, t1.img, t1.avatar, t1.areas, t1.twitter, t1.email, t2.respuesta FROM usuario AS t1, respuesta AS t2 WHERE t1.id=t2.id_usuario AND t1.id='%s' ", $id_usuario);


$consulta = sprintf("SELECT id, nombre, img, avatar, areas, twitter, email from usuario WHERE id='%s' ", $id_usuario);
$query_datosusuario = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

$id_pregunta = 1;
$consulta = sprintf("SELECT respuesta from respuesta WHERE id_usuario='%s' AND id_pregunta='%s'", $id_usuario, $id_pregunta);
$query_r1 = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

$id_pregunta = 2;
$consulta = sprintf("SELECT respuesta from respuesta WHERE id_usuario='%s' AND id_pregunta='%s'", $id_usuario, $id_pregunta);
$query_r2 = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

$id_pregunta = 3;
$consulta = sprintf("SELECT respuesta from respuesta WHERE id_usuario='%s' AND id_pregunta='%s'", $id_usuario, $id_pregunta);
$query_r3 = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

$id_pregunta = 4;
$consulta = sprintf("SELECT respuesta from respuesta WHERE id_usuario='%s' AND id_pregunta='%s' AND id_evento='%s'", $id_usuario, $id_pregunta, $id_evento);
$query_r4 = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

$id_pregunta = 5;
$consulta = sprintf("SELECT respuesta from respuesta WHERE id_usuario='%s' AND id_pregunta='%s' AND id_evento='%s'", $id_usuario, $id_pregunta, $id_evento);
$query_r5 = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

$id_pregunta = 6;
$consulta = sprintf("SELECT respuesta from respuesta WHERE id_usuario='%s' AND id_pregunta='%s' AND id_evento='%s'", $id_usuario, $id_pregunta, $id_evento);
$query_r6 = mysql_query($consulta, $conexion) or die ('Error en SQL: '.$consulta);

$consulta2 = sprintf("SELECT t2.id_user2 FROM usuario AS t1, desbloqueo AS t2 WHERE t1.id = t2.id_user AND t1.email='%s'", $email);
$desbloqueados = mysql_query($consulta2, $conexion) or die ('Error en SQL: '.$consulta2);


if($query_datosusuario)
{

	$registros = array();
	if(mysql_num_rows($query_datosusuario)){
		while ($unRegistro = mysql_fetch_assoc($query_datosusuario)) {
			
			$desbloqueado = 0;
			$temp = mysql_query($consulta2, $conexion) or die ('Error en SQL: '.$consulta2);
			if($temp)
				{
					$desbloqueado = 8;
					if(mysql_num_rows($temp)){
						$desbloqueado = 9;
						while ($otroRegistro = mysql_fetch_assoc($temp)) {
							$desbloqueado = 11;
							if ($otroRegistro['id_user2']==$unRegistro['id']) {
							 	$desbloqueado = 1;
							 } 

								
						}
					}
							
				}
			$registros[] = array(
				'id' => $unRegistro['id'],
				'nombre' => $unRegistro['nombre'],
				'foto'  => $unRegistro['img'],
				'avatar'  => $unRegistro['avatar'],
				'area' => $unRegistro['areas'],
				'twitter' => $unRegistro['twitter'],
				'correo' => $unRegistro['email'],
				'desbloqueado' => $desbloqueado,
				);
		}
	}
}

if($query_r1)
{
	if(mysql_num_rows($query_r1)){
		while ($unRegistro = mysql_fetch_assoc($query_r1)) {
			//$r1 = $unRegistro['id'];
				$registros[1] = array(
				'r1'=> $unRegistro['respuesta'],
				);
		}
	}
}

if($query_r2)
{
	if(mysql_num_rows($query_r2)){
		while ($unRegistro = mysql_fetch_assoc($query_r2)) {
			//$r2 = $unRegistro['id'];
				$registros[2] = array(
				'r2'=> $unRegistro['respuesta'],
				);
		}
	}
}

if($query_r3)
{
	if(mysql_num_rows($query_r3)){
		while ($unRegistro = mysql_fetch_assoc($query_r3)) {
			//$r3 = $unRegistro['id'];
				$registros[3] = array(
				'r3'=> $unRegistro['respuesta'],
				);
		}
	}
}

if($query_r4)
{
	if(mysql_num_rows($query_r4)){
		while ($unRegistro = mysql_fetch_assoc($query_r4)) {
			//$r1 = $unRegistro['id'];
				$registros[4] = array(
				'r4'=> $unRegistro['respuesta'],
				);
		}
	}
}

if($query_r5)
{
	if(mysql_num_rows($query_r5)){
		while ($unRegistro = mysql_fetch_assoc($query_r5)) {
			//$r2 = $unRegistro['id'];
				$registros[5] = array(
				'r5'=> $unRegistro['respuesta'],
				);
		}
	}
}

if($query_r6)
{
	if(mysql_num_rows($query_r6)){
		while ($unRegistro = mysql_fetch_assoc($query_r6)) {
			//$r3 = $unRegistro['id'];
				$registros[6] = array(
				'r6'=> $unRegistro['respuesta'],
				);
		}
	}
}

mysql_close($conexion);

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$query_datosusuario) {
    $resultados["mensaje"] = "Error consultando usuario";
	$resultados["validacion"] = "error";
}
elseif (!$query_r1) {
    $resultados["mensaje"] = "Error consultando r1";
	$resultados["validacion"] = "error";
}
elseif (!$query_r2) {
	$resultados["mensaje"] = "Error consultando r2";
	$resultados["validacion"] = "error";
}
elseif (!$query_r3) {
	$resultados["mensaje"] = "Error  consultando r3";
	$resultados["validacion"] = "error";
}
elseif (!$query_r4) {
    $resultados["mensaje"] = "Error consultando r4";
	$resultados["validacion"] = "error";
}
elseif (!$query_r5) {
	$resultados["mensaje"] = "Error consultando r5";
	$resultados["validacion"] = "error";
}
elseif (!$query_r6) {
	$resultados["mensaje"] = "Error  consultando r6";
	$resultados["validacion"] = "error";
}
elseif (!$desbloqueados) {
	$resultados["mensaje"] = "Error desbloqueados";
	$resultados["validacion"] = "error";
}
else{

	$resultados["mensaje"] = "Consulta exitosa";
	$resultados["validacion"] = "ok";
	$resultados["datos"] = $registros;
	//$resultados["r1"] = $r1;
	//$resultados["r2"] = $r2;
	//$resultados["r3"] = $r3;	

}

/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);
/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';


?>