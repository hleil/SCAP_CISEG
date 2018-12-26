<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objModelo = new Modelo();
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];

$idUsuario = $_SESSION["idUsuario"];
$idActivo = $_SESSION["idActivo"];
$idTipoPrueba = $_SESSION["idTipoPrueba"];
$idPrueba = $_SESSION["idPrueba"];

if (($rol != null) && ($rol == 4)) {
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
                        $objetoMenu->MenuValidador();
                        ?>

                    </nav>
                </div>
                <!-- Main content --> 
                <div class="content col-1 light-gray-bg">


                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Consultar Casos de Prueba del Activo</h2>
                        <p>Por favor, seleccione el activo que desea consultar:</p>
                        <div class="content-container">
                            <div class="content-widget no-padding">
                                <div class="panel panel-default table-responsive">
                                    <table class="table table-striped table-bordered user-table">
                                        <thead>
                                            <tr>
                                                <td><a href="" class="white-text sort-by">Id </a></td>
                                                <td><a href="" class="white-text sort-by">Prueba </a></td>
                                                <td><a href="" class="white-text sort-by">Metodología</a></td>
                                                <!--<td><a href="" class="white-text sort-by">Revisión</a></td>-->
                                                <td><a href="" class="white-text sort-by">Estatus</a></td>
                                                <!--<td><a href="" class="white-text sort-by">Pruebas </a></td>-->                                                
                                                <td>Ver resultados</td>
                                                <!--<td>Modificar activo</td>-->
                                                <!--<td>Cerrar activo</td>-->
                                            </tr>
                                        </thead>
                                        <?php 
                                        /*
                                        echo 'idActivo '.$idActivo.'<br/>';
                                        echo 'idTipoPrueba '.$idTipoPrueba.'<br/>';
                                        echo 'idPrueba '.$idPrueba.'<br/>';
                                        echo 'idUsuario '.$idUsuario.'<br/>';
                                        */
                                        $objModelo->listarCasosDePrueba($idUsuario, $idActivo, $idTipoPrueba, $idPrueba);      
                                        ?> 

                                    </table>
                                </div>
                            </div>
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
