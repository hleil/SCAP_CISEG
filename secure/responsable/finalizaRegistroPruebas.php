<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";

$objetoMenu = new ModeloMenus();
$objModelo = new Modelo();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];

$idActivo = $_SESSION["idActivo"];
$idPrueba = $_SESSION["idPrueba"];
$nombre = $_SESSION["nombre"];
$fInicio = $_SESSION["fInicio"];
$fFin = $_SESSION["fFin"];
$propietarioActivo = $_SESSION["propietarioActivo"];
$comentarios = $_SESSION["comentarios"];
$version = $_SESSION["version"];
$responsable = $_SESSION["responsable"];

if (($rol != null) && ($rol == 2)) {
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
                        $objetoMenu->MenuRespEval();
                        ?>

                    </nav>
                </div>
                <!-- Main content --> 
                <div class="content col-1 light-gray-bg">


                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Revisión de configuraciones</h2>
                        <div class="content-widget white-bg">
                            <?PHP
                             $objModelo->listaRevConfigAndCasosPrueba($idPrueba);
                             ?>
                        </div>
                    </div>
                    
                    <div class="form-group text-right">
                        <button type="button"  class="blue-button" onclick="window.location.href='gestionactivos.php'">Regresar al menú</button>
                    </div>  
                    
                    <footer class="text-right">
                        <p>Copyright &copy; 2018 CISEG | CIC IPN </p>
                    </footer>
                </div>
            </div>
            <?PHP
                unset($_SESSION["idActivo"]);
                unset($_SESSION["idPrueba"]);
                unset($_SESSION["nombre"]);
                unset($_SESSION["fInicio"]);
                unset($_SESSION["fFin"]);
                unset($_SESSION["propietarioActivo"]);
                unset($_SESSION["comentarios"]);
                unset($_SESSION["version"]);
                unset($_SESSION["responsable"]);

            ?>
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
