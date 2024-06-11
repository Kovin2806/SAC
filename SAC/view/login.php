<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="public/css/styles-login.css" />
  <title>Iniciar Sesion</title>
</head>

<body>
  <main>

    <!-- Contenedor general que tendra 2 div, 1 imagen, 2  form-->
    <div class="general">

      <!-- Contenedor de img ilustrativa-->
      <div class="img-container">
        <h1 class="title">No decidas más. <br> ¡Eligenos a nosotros somos la mejor opción!</h1>
        <img src="public/images/login.jpg" alt="centered image" width="350" height="250" />
      </div>

      <!-- Contenedor del form login-->
      <div class="container-login">
        <div class="login-data">
          <h1>Inicio de Sesión</h1>
          <img src="public/images/LogoUTP.png" alt="" width="70" height="70" />
          <img src="public/images/logo2.png" alt="" width="70" height="70" />
          <form method="POST" action="./?sel=loguear" class="login-form">
            <p class="text-danger">
              <?php if (isset($_GET['msg']))
                echo $_GET['msg']; ?>
            </p>
            <div class="input-group">
              <label class="input-fill">
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required />
                <!-- <span class="input-label">Correo Electrónico</span>-->
                <i class="fas fa-envelope"></i>
              </label>
            </div>
            <div class="input-group">
              <label class="input-fill">
                <input type="password" name="password" id="password" placeholder="Contraseña" required />
                <!--<span class="input-label">Contraseña</span>-->
                <i class="fas fa-lock"></i>
              </label>
            </div>
            <input href="?sel=principal" type="submit" value="Iniciar Sesión" class="btn-login" />
          </form>
        </div>
      </div>

    </div>

  </main>
</body>

</html>