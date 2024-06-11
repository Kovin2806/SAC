<?php

//DEBEMOS INCLUID LA CONEXION PARA PODER UTILIZAR LA VARIABLE PDO
include '../config/conexion.php';

$cedulaP = $_REQUEST['cedulaP'];
$cedulaD = $_REQUEST['cedulaD'];
$estadoCita = $_REQUEST['cedulaD'];
$fechaCita = $_REQUEST['fechaCita'];
$horaCita = $_REQUEST['horaCita'];
$descripcion = $_REQUEST['descripcion'];

//REALIZAMOS LA CONSULTA QUE DESEAMOS
$consulta = "CALL Insertar_Cita('$cedulaP', '$cedulaD','$descripcion','$fechaCita','$horaCita')";

mysqli_query($conexion, $consulta) or die($mysql->mysqli_error());
mysqli_close($conexion);
?>