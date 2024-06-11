<head>
<link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;500;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/styles-header.css">
    <link rel="stylesheet" href="public/css/styles-footer.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<Header class = "principal-1">
        <div>
            <a href="?sel=principal"><img  class="logo" src="public/images/LogoUTP.png" alt="logo" ></a>
            <a href="?sel=principal"><img  class="logo" src="public/images/logo_principal.png" alt="logo" ></a>
        </div>
    <div class="menu-nav-user">
        <ul class="formato_ul">
            <li class="formato_li formato_li_2 linea"><a class="formato_a " href="#">
                    <?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"] ?>
                </a>
                <ul>
                    <li><a class="formato_a" href="?sel=cerrarSesion">Cerrar Sesion</a> </li>
                </ul>
            </li>
        </ul>
    </div> 
</Header>

<Header class = "principal-2">


    <nav>
        <ul class="formato_ul menu-nav">
        <li class="formato_li formato_li_2"><a class="formato_a formato_a_2" href="?sel=principal" >Inicio</a></li>
            <li class="formato_li formato_li_2"><a class="formato_a formato_a_2" href="?sel=citas" >Citas</a></li>
            <li class="formato_li formato_li_2"><a class="formato_a formato_a_2" href="?sel=consultaSC" >Consulta</a></li>
            <li class="formato_li formato_li_2"><a class="formato_a formato_a_2" href="?sel=historial" >Historial</a></li>
        </ul>
    </nav>
</Header>