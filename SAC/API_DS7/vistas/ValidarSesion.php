<?php

include '../config/conexion.php';

$correo = $_GET['correo'];
$contrasena = md5($_GET['contrasena']);

$consulta = "SELECT * FROM usuario WHERE correoUsuario='$correo'
    AND contrasena='$contrasena' AND tipoUsuario=1";


//OBTENEMOS LA CONSULTA
$resultado = $conexion->query($consulta);

//RECORREMOS EL SELECT PARA TRAER TODOS LOS DATOS NECESARIOS
while ($fila = $resultado->fetch_array()) {
    $prueba[] = array_map('utf8_encode', $fila);
}

//LO CONVERTIMOS A FORMATO JSON
echo json_encode($prueba);

//CERRAMOS TODA LA CONSULTA Y CONEXION
$resultado->close();

mysqli_query($conexion, $consulta) or die($mysql->mysqli_error());
mysqli_close($conexion);

?>