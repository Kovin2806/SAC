<?php

//DEBEMOS INCLUID LA CONEXION PARA PODER UTILIZAR LA VARIABLE PDO
include '../config/conexion.php';

$contrasena = md5($_REQUEST['contrasena']);
$cedula = $_REQUEST['cedula'];

//REALIZAMOS LA CONSULTA QUE DESEAMOS
$consulta = "UPDATE usuario SET contrasena='$contrasena' WHERE cedula='$cedula'";

mysqli_query($conexion, $consulta) or die($mysql->mysqli_error());
mysqli_close($conexion);
?>