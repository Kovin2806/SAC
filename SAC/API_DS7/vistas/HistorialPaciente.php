<?php

include '../config/conexion.php';

$cedulaP = $_GET['cedulaP'];

$consulta = "CALL mostrarHistorialPaciente('$cedulaP')";


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