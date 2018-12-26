<?php  
  session_start();
?>
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
        if (isset($_SESSION["errorContrasena"])) {
            echo "<div class='content-widget pink-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Error</h2>";
            echo "<p class='margin-bottom-0'>Las contraseñas no son iguales</p>";
            echo "</div>";
            unset($_SESSION["errorContrasena"]);
        }
        ?>

        <div class="content-widget login-widget white-bg">

            <header class="text-center">
                <div class="square"></div>
                <h1>SCAP CISEG </h1>
                <h2><?PHP echo $usuario?></h2>
                
            </header>
            <form class="login-form" method="post" action="controlador/controlador.php">
                <p>Por favor, introduzca su correo registrado en el sistema</p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
                        <input type="mail" class="form-control" placeholder="Correo" name="correo" id="correo">         
                    </div>	
                </div>
                <div class="form-group">
                    <button type="submit" class="blue-button width-100" name="recuperarContrasena" id="recuperarContrasena">Recuperar contraseña</button>
                </div>
            </form>
        </div>
        
        <div class="content-widget login-widget register-widget white-bg">
            <p><a href="index.php" class="blue-text">Regresar <strong></a></strong></p>
        </div>
    </body>
</html>