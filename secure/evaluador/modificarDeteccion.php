<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objModelo = new Modelo();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
$idPrueba = $_SESSION["idPrueba"];
$idSegCal = $_SESSION["idSegCal"];
$idDeteccion = $_POST["idTADETECCSCAP"];
if (($rol != null) && ($rol == 3)) {
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
                        $objetoMenu->MenuEvaluador();
                        ?>

                    </nav>
                </div>
                <!-- Main content --> 
                <div class="content col-1 light-gray-bg">
                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Modificar Detección</h2>
                        <p>Por favor, llene todos los campos solicitados:</p>
                        <?PHP //echo $idDeteccion ?>
                        <div class="content-container">
                        <form class="login-form" method="post" action="../../controlador/controlador.php">

                           <?PHP
                                $objModelo->obtenerDatosDeteccion($idDeteccion);
                            ?>
                            
                            <div class="form-group text-right">
                                <button type="reset" class="white-button" onclick="window.location.href = 'consultarCasoPRUEBA.php'">Cancelar</button>
                                <button type="submit" class="blue-button" name="actualizarDeteccion" id="actualizarDeteccion">Guardar</button>
                            </div>  
                        </form>
                        </div>
                        <footer class="text-right">
                            <p>Copyright &copy; 2018 CISEG | CIC IPN </p>
                        </footer>
                    </div>
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
