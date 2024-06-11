<?php
@session_start();

if ($_SESSION["acceso"] != true) {
    header('Location: ?sel=login');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="public/css/styles-consulta.css" />
    
    <!--- <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">--->

    <title>Consulta Medica</title>
</head>

<body>
    <!-- counter section ends -->

    <!-- contact section starts  -->
    <?php include("view/template/header.php") ?>
    <div>
        <section class="general-datos">
            <h1 class="heading">Consulta Medica</h1>
            <form method="POST" action="?sel=crearConsultaCC">
                <div class="boxInput">

                    <div class="box">
                        <p class="pe">Numero de Cita: </p>
                        <input type="text" name="idCita" placeholder="Nombre" value="<?php echo $_SESSION["idCitaa"]?>" readonly>
                    </div>

                    <div class="boxInput">
                        <div class="box">
                        <p class="pe">Nombre Completo:</p>
                            <label>&nbsp;&nbsp;<?php echo $datosPaciente->nombre ." ".$datosPaciente->apellido?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <p class="pe">Cedula:</p>
                            <input type=text name="cedula" value="<?php echo $datosPaciente->cedulaP?>" readonly>
                            <p class="pe">Correo:</p>
                            <input type=text name="correo" value="<?php echo $datosPaciente->correoUsuario?>" readonly>

                        </div>
                    </div>

                    <div class="text">
                        <p>Motivo de consulta</p>
                        <textarea name="motivo" id="" cols="60" rows="8" placeholder="Escriba el motivo de Consulta" required></textarea>
                        <p>Receta</p>
                        <textarea name="receta" id="" cols="60" rows="8" placeholder="Escriba la Receta a Enviar" required></textarea>
                    </div>

                    <input type="submit" name="buscarP" value="Crear Consulta" class="button-89"/>

            </form>

    </div>
    </section>
    <?php include("view/template/footer.html") ?>
    </div>
</body>

</html>