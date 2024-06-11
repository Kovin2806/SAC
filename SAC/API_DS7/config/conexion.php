<?php
//ESTOS SON LOS PARAMETROS DE LA CONEXION
$hostname = "localhost";
$database = "sac";
$user = "root";
$pass = "";

//ESTA LINEA ES LA QUE PERMTE REALIZAR LA CONEXION
$conexion = new mysqli($hostname, $user, $pass, $database);

//ESTA LINEA VALIDA ERRORES QUE PUEDEN EXISTIR AL CONECTARNOS
if ($conexion->connect_errno) {
    echo 'Error al conectar con la base de datos';
}
