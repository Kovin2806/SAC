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
    <link rel="stylesheet" href="public/css/style-capacitacion.css">
    
    <title>Capacitacion</title>
</head>

<body>
    <?php include("view/template/header.php") ?>
    <div class="Titulo_Planti_Capa">
        <h1>PLANTILLA DE CAPACITACION</h1>
    </div>

    <Section class="Info_sect1">
        <div href="#" class="Plant_Capa_Banner1">

            <div class="bloque"><img src="public/images/Doctora_1.png" alt=""></div>
            <div class="bloque">
                <h2>Sigue el proceso de sintomas o enfemedades</h2>
                <p> En nuestras manos con los mejores doctores</p>
            </div>
            <div class="bloque"><img src="public/images/Doctora_1.png" alt=""></div>

        </div>

    </Section>

    <Section class="Info_sect2">
        <div href="#" class="Plant_Capa_Banner2">

            <div class="bloque"><img src="public/images/Doctora_2.png" alt=""></div>
            <div class="bloque">
                <h2>¿Como debo preparame antes de venir a la clinica?</h2>
            </div>
            <div class="bloque"><img src="public/images/Doctora_2.png" alt=""></div>

        </div>

    </Section>



    <Section class="Info_sect3">
        <div href="#" class="Plant_Capa_Banner3">

            <div class="bloque"><img src="../public\img\Doctor_1.png" alt=""></div>
            <div class="bloque">
                <h2>¿Eres practicante?</h2>
                <p>Nosotros te capacitamos</p>
                <p>Somos tu mejor opcion</p>
            </div>
            <div class="bloque"><img src="../public\img\Doctor_1.png" alt=""></div>

        </div>

    </Section>


    <!--     <Section class="Info_sect3">
        <div class="Plant_Capa_Banner3">

            <div class="bloque"><img src="../public\img\Doctor_1.png" alt=""></div>
            <div class="bloque">
            <h2>¿Eres practicante?</h2>
            <p>Nosotros te capacitamos</p>
            <p>Somos tu mejor opcion</p>
            </div>
            <div class="bloque"><img  src="../public\img\Doctor_1.png" alt=""></div>
            
        </div>
        
    </Section> -->
    <?php include("view/template/footer.html") ?>
</body>

</html>