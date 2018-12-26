<?php  
  session_start();
  $idUsuario = $_SESSION["idUsuario"];
  if($idUsuario != null){
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
        if (isset($_SESSION["errorPoliticaContrasena"])) {
            echo "<div class='content-widget pink-bg'>";
            echo "<h2 class='text-uppercase margin-bottom-10'>Error</h2>";
            echo "<p class='margin-bottom-0'>La contraseña no cumple con las políticas requeridas</p>";
            echo "<p class='margin-bottom-0'>La contraseña debe tener una letra mayúscula, una minúscula, un número y un caracter especial (. , ;)</p>";
            echo "</div>";
            unset($_SESSION["errorPoliticaContrasena"]);
        }
        ?>

        <div class="content-widget login-widget white-bg">

            <header class="text-center">
                <div class="square"></div>
                <h1>SCAP CISEG </h1>
                <h2><?PHP echo $usuario?></h2>
                
            </header>
            <form class="login-form" method="post" action="controlador/controlador.php">
                <p>Por favor, introduzca su nueva contraseña</p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
                        <input type="password" class="form-control" placeholder="Introduce contraseña" name="contrasena" id="contrasena" required>         
                    </div>	
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
                        <input type="password" class="form-control" placeholder="Verifica contraseña" name="contrasena2" id="contrasena2" required>           
                    </div>	
                </div>
                <div class="form-group">
                    <button type="submit" class="blue-button width-100" name="primerLogin" id="primerLogin">Crear contraseña</button>
                </div>
            </form>
        </div>
    </body>
</html>
<?php
  }
  else{
    session_destroy();
    header("location:common/403.php");
  }
?>
