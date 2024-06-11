<?php

//DEBEMOS INCLUID LA CONEXION PARA PODER UTILIZAR LA VARIABLE PDO
include '../config/conexion.php';

$celular = $_REQUEST['celular'];
$provincia = $_REQUEST['provincia'];
$ciudad = $_REQUEST['ciudad'];
$direccion = $_REQUEST['direccion'];
$cedula = $_REQUEST['cedula'];

//REALIZAMOS LA CONSULTA QUE DESEAMOS
$consulta = "UPDATE usuario SET celular='$celular', provincia='$provincia',
ciudad='$ciudad', direccion = '$direccion' WHERE cedula='$cedula'";

mysqli_query($conexion, $consulta) or die($mysql->mysqli_error());
mysqli_close($conexion);
?>