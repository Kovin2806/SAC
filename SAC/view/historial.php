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
    <link rel="stylesheet" href="public/css/styles-historial.css">
    <link rel="stylesheet" href="public/css/style-header.css">
    

    <title>Historial Medico</title>
</head>

<body>
    <!-- counter section ends
     contact section starts  -->

    <?php include("view/template/header.php") ?>

<?php
    if(isset($_POST['buscarP'])){

        foreach($historialResultado as $historial){
            $nombre = $historial->NombrePaciente;
            $cedula = $historial->Cedula;

        }
?>


<!-- Datos generales de la persona  -->
<div class="container_padre">
    <div class="datosGenerales">
            <p class="nombre">Nombre Completo: </p>
            <label for="">&nbsp;&nbsp;<?php echo $nombre?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

            <p class="cedula">Cédula: </p>
            <label for="">&nbsp;&nbsp;<?php echo $cedula?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        </div>
</div>

    

    <div class="container_P">
        <div class="hijo">

            <table width="50%" aling="center" class="content-table center ">

            <thead class="thead-color" aling="center">
                <tr aling="center">
                <th class="primera_fila col-1 ">HISTORIAL</th>
                <th class="primera_fila col-1 ">FECHA</th>
                <th class="primera_fila col-4 ">NOTA DE DOCTOR</th>
                <th class="primera_fila col-1 ">RECETA</th>

                </tr>
            </thead>

            <tbody id="myTable">
            <?php
                $n=1;
                    foreach($historialResultado as $historial)
                    {
                ?>
                        <tr>
                        <td  aling="center"><?php echo $n ?></td>
                        <td  aling="center"><?php echo $historial->Fecha; ?></td>
                        <td  aling="center"><?php echo $historial->NotaDoctor; ?></td>
                        <td  aling="center"><?php echo $historial->Receta; ?></td>
                        </tr>
                <?php
                $n++;
                    }
                ?>
            </tbody>


            </table>
        </div>
    </div>

    
    <?php
    }else{
    ?>
        <div class="boxInput">
            <form method="POST" action="?sel=datosHistorial">
                <label class="t_2">Seleccione al Paciente</label>
                    <select class="select-css" name="pacientes">
                        <?php
                            foreach($listaHistorial as $lista)
                            {
                        ?>
                            <option value="<?php echo $lista->cedula; ?>"><?php echo $lista->cedula; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <input class="button-89" type="submit" name="buscarP" value="Buscar Paciente" />
            </form>
         </div>
    <div class="general-datos">
    <img class="banner" src="public/images/banner_principal.png" alt="">
    </div>

        

    <?php
    }

?>







<?php include("view/template/footer.html") ?>
</body>

</html>