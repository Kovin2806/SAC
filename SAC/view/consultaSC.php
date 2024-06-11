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
    
    <title>Consulta Medica</title>
</head>

<body>
    <!-- contact section starts  -->
    <?php include("view/template/header.php") ?>

    <?php
        if(isset($_POST['buscarP'])){
    ?>
            <section class="general-datos">
            <h1 class="heading">Consulta Medica</h1>
            <form method="POST" action="?sel=crearConsulta">
                <div class="boxInput">

                    <div class="boxInput">
                        <div class="box">
                            <p class="pe">Nombre Completo:</p>
                            <label>&nbsp;&nbsp;<?php echo $pacienteResultado->nombre ." ".$pacienteResultado->apellido?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <p class="pe">Cedula:</p>
                            <input type=text name="cedula" value="<?php echo $pacienteResultado->cedula?>" readonly>
                            <p class="pe">Correo:</p>
                            <input type=text name="correo" value="<?php echo $pacienteResultado->correoUsuario?>" readonly>
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
        </section>
        
        <?php
        }else{
        ?>
    <div class="boxInput">
        <form method="POST" action="?sel=buscarDatosPaciente">
        <label class="t_2">Seleccione al Paciente</label>
            <select class="select-css" name="pacientes">
            <?php
                foreach($listaPacientes as $lista)
                {
            ?>
                <option value="<?php echo $lista->cedula; ?>"><?php echo $lista->cedula; ?></option>
            <?php
                }
            ?>
            </select>
            <input type="submit" name="buscarP" class="button-89" value="Buscar Paciente" />
        </form>
    </div>
    <div class="general-datos">
    <img class="banner" src="public/images/consulta.png" alt="">
    </div>
        <?php
        }

    ?>
    
        
    <?php include("view/template/footer.html") ?>
    </div>
</body>

</html>