<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objetoModelo = new Modelo();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
if (($rol != null) && ($rol == 1)) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">  
            <title>SCAP CISEG</title>
            <meta name="description" content="">
            <link href="../../css/font-awesome.min.css" rel="stylesheet">
            <link href="../../css/bootstrap.min.css" rel="stylesheet">
            <link href="../../css/style.css" rel="stylesheet">
        </head>
        <body>  
            <!-- Menu -->
            <div class="flex-row">
                <div class="sidebar">
                    <header class="site-header">
                        <div class="square"></div>
                        <h1>SCAP CISEG</h1>
                    </header>


                    <div class="mobile-menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <nav class="left-nav"> 
                        <?PHP
                        $objetoMenu->MenuAdmin();
                        ?>

                    </nav>
                </div>
                <!-- Main content --> 
                <div class="content col-1 light-gray-bg">


                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Alta de usuario</h2>
                        <p>Por favor, complete la siguiente información:</p>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Nombre del usuario</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" maxlength="80" required>                  
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputLastName">Correo electrónico</label>
                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" maxlength="45" required>                  
                                </div> 
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Tipo de usuario</label>
                                    <select class="form-control" name="tipoUsuario" id="tipoUsuario" required>
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaTiposUsuario();
                                        ?>
                                    </select>                
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="reset" class="white-button" onclick="window.location.href = 'gestionusuarios.php'">Cancelar</button>
                                <button type="submit" class="blue-button" name="altaUsuario" id="agregarUsuario">Guardar</button>
                            </div>  
                        </form>
                    </div>
                    <footer class="text-right">
                        <p>Copyright &copy; 2018 CISEG | CIC IPN </p>
                    </footer>
                </div>
            </div>

            <script src="../../js/jquery-1.11.2.min.js"></script>
            <script src="../../js/jquery-migrate-1.2.1.min.js"></script> 
            <script src="../../js/script.js" type="text/javascript" ></script>

        </body>
    </html>
    <?php
} else {
    session_destroy();
    header("location:../../common/403.php");
}
?>
