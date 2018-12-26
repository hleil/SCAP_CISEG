<?PHP session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <title>SCAP CISEG</title>
        <meta name="description" content="">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body class="light-gray-bg">
        <?PHP
        if (isset($_SESSION["errorBD"])) {
            echo "<div class='content-widget pink-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Error</h2>";
            echo "<p class='margin-bottom-0'>Ha ocurrido un error interno</p>";
            echo "</div>";
            unset($_SESSION["errorBD"]);
        }
        if (isset($_SESSION["recuperarContrasena"])) {
            echo "<div class='content-widget orange-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Reestablecer contraseña</h2>";
            echo "<p class='margin-bottom-0'>Si su usuario está registrado en el sistema, recibirá un correo para reestablecer su contraseña</p>";
            echo "</div>";
            unset($_SESSION["recuperarContrasena"]);
        }
        if (isset($_SESSION["error"])) {
            echo "<div class='content-widget pink-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Error</h2>";
            echo "<p class='margin-bottom-0'>Usuario o contraseña incorrectos</p>";
            echo "</div>";
            unset($_SESSION["error"]);
        }
        if (isset($_SESSION["errorLogin"])) {
            echo "<div class='content-widget pink-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Error</h2>";
            echo "<p class='margin-bottom-0'>Por favor, contacte al administrador</p>";
            echo "</div>";
            unset($_SESSION["errorLogin"]);
        }
        if (isset($_SESSION["logout"])) {
            echo "<div class='content-widget green-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Logout</h2>";
            echo "<p class='margin-bottom-0'>Se ha cerrado sesión</p>";
            echo "</div>";
            unset($_SESSION["logout"]);
        }
        if (isset($_SESSION["primerLogin"])) {
            echo "<div class='content-widget green-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Registro correcto</h2>";
            echo "<p class='margin-bottom-0'>Se ha creado la contraseña para el usuario</p>";
            echo "</div>";
            unset($_SESSION["primerLogin"]);
        }
        ?>

        <div class="content-widget login-widget white-bg">

            <header class="text-center">
                <div class="square"></div>
                <h1>SCAP CISEG </h1>
            </header>
            <form class="login-form" method="post" action="controlador/controlador.php">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
                        <input type="email" class="form-control" placeholder="correo" name="correo" id="correo" maxlength="45" required>           
                    </div>	
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
                        <input type="password" class="form-control" placeholder="contrasena" name="contrasena" id="contrasena" required>           
                    </div>	
                </div>
                <div class="form-group">
                    <button type="submit" class="blue-button width-100" name="iniciarSesion" id="iniciarSesion">Ingresar</button>
                </div>
            </form>
        </div>
        <div class="content-widget login-widget register-widget white-bg">
            <p><a href="recuperar.php" class="blue-text">Recuperar contraseña <strong></a></strong></p>
        </div>
    </body>
</html>
