<?php
@session_start();

if ($_SESSION["acceso"] != true) {
    header('Location: ?sel=login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/styles-principal.css">
    
    <title>Pagina Principal</title>
</head>

<body>
    <?php include("view/template/header.php") ?>

    <div class="contenedor">

        <div class="div__1">
            <h1 class="titulo_P">BIENVENIDO A LA CLINICA UNIVERSITARIA DE ADMINISTRATIVOS </h1>

            
            <p class="txt_cuerpo">La Clínica Universitaria brinda servicios de salud y lleva a cabo actividades clínicas y de capacitación en temas de salud, 
                dirigidas a la población estudiantil, docente, administrativa y de investigación de la Universidad.
            </p>

            <h3 class="titulo_S">
                Objetivos 
            </h3>
            
            <ul class="texto_2">
            <li><a href="#" >Proporcionar al paciente servicios de atención integral para su salud, en lo concerniente a prevención, 
                tratamiento y rehabilitación de enfermedades.</a></li>
                <br>
            <li><a href="#" >Desarrollar actividades inherentes a la promoción de la salud de la comunidad universitaria.</a></li>
        </ul>



        </div>

        <div class="div__2">
            <img class="banner" src="public/images/banner_principal1.png" alt="">
        </div>
    </div>
    <?php include("view/template/footer.html") ?>
</body>

</html>