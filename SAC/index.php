<?php

//Incluyo los archivos necesarios
require("./controller/controller.php");
require("model/db.php");
//Instancio el controlador
$controller = new Controller;

if (isset($_GET['sel'])){

    $select=$_GET['sel'];

    //Llamar metodo para Loguear
    if($select=="loguear")
    {
        $controller->Loguear();
    }


    
    //Llamar metodo para Cerrar Sesion
    elseif ($select=="cerrarSesion")
    {
        $controller->CerrarSesion();
    }



    //Llamar metodo para volver al Login
    elseif($select=="login")
    {
        $controller->index();
    }



    //Llamar metodo para entrar a la pantalla Principal
    elseif ($select=="principal")
    {
    $controller->Principal();
    }


    //Llamar metodo para entrar a la pantalla Citas
    elseif ($select=="citas")
    {
    $controller->Citas();
    }


    //Llamar metodo para entrar a la pantalla Consultas
    elseif($select=="consultaCC")
    {
        $_SESSION["idCitaa"] = $_GET['idCita'];
        $controller->consultaCC();
    }


    //Llamar metodo para entrar a la pantalla Consultas
    elseif($select=="consultaSC")
    {
    $controller->consultaSC();
    }

    

    elseif($select=="buscarDatosPaciente")
    {
    $controller->busquedaPaciente();
    }


    //Llamar al metodo para crear Consulta (SIN CITA)
    elseif($select=="crearConsulta")
    {
    $controller->crearConsultaSC();
    }


    //Llamar al metodo para crear Consulta (CON CITA)
    elseif($select=="crearConsultaCC")
    {
    $controller->crearConsultaCC();
    }


    //Llamar metodo para entrar a la pantalla Historial
    elseif($select=="historial")
    {
    $controller->historial();
    }

    elseif($select=="datosHistorial")
    {
    $controller->pacienteHistorial();
    }


    //Llamar metodo para entrar a la pantalla Capacitacion
    elseif($select=="capacitacion"){
    $controller->Capacitacion();
    }
}

else{
    $controller->index();
}