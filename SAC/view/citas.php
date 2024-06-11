<?php

@session_start();

if ($_SESSION["acceso"] != true) {
  header('Location: ?sel=login');
}

if(isset($_POST['botonID'])) {
  $_SESSION["idCita"] =  $tabla->$Cita;
    header('Location: ?sel=consultaM');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="public/css/styles-citas.css">
  

  <title>Pagina Principal</title>
</head>

<body>
  <?php include("view/template/header.php") ?>

  <!-- TITULO BONITO -->

  <div class="Titulo_Planti_Cita">
    <h1>CITAS AGENDADAS</h1>
  </div>

  <!--tabla bonita   --->
  <div class="container_P">
    <div class="hijo">

      <table width="50%" aling="center" class="content-table center">

        <thead aling="center">
          <tr aling="center">
            <th class="primera_fila col-1 ">CITA</th>
            <th class="primera_fila col-1 ">NOMBRE DEL PACIENTE</th>
            <th class="primera_fila col-4">DESCRIPCION DE LA CITA</th>
            <th class="primera_fila col-1 ">ESTADO</th>
            <th class="primera_fila col-1 ">HORA</th>
            <th class="primera_fila col-1 ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FECHA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th class="primera_fila col-1 ">CONSULTA</th>

          </tr>
        </thead>

        <!--Crear for para que se creen automaticos-->
        <!-- Agregarv boton "realizar consulta"-->
        <tbody id="myTable">
        <?php
            $n=1;
              foreach($tablaCitas as $tabla)
              {
            ?>
                  <tr>
                    <td  aling="center"><?php echo $n ?></td>
                    <td  aling="center"><?php echo $tabla->NombrePaciente; ?></td>
                    <td  aling="center"><?php echo $tabla->Descripcion; ?></td>
                    <td  aling="center"><?php echo $tabla->EstadoCita; ?></td>
                    <td  aling="center"><?php echo $tabla->Hora; ?></td>
                    <td  aling="center"><?php echo $tabla->Fecha; ?></td>
                    <?php 
                    if($tabla->EstadoCita=='PENDIENTE')
                    {
                    ?>
                      <th> <a href="?sel=consultaCC&idCita=<?php	echo $tabla->Cita?>" class="button-33">Consulta</a></th>
                    <?php
                    }else{
                      ?>
                      <th>Consulta Realizada</th>
                    <?php
                    }
                    ?>
                    
                  </tr>
            <?php
            $n++;
              }
        ?>
        </tbody>

      </table>
    </div>
  </div>



  <?php include("view/template/footer.html") ?>
</body>

</html>