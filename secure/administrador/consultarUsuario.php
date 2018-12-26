<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objModelo = new Modelo();
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
                        <h2 class="margin-bottom-10">Consultar usuario</h2>
                        <p>Por favor, seleccione el usuario que desea consultar:</p>
                        <div class="content-container">
                            <div class="content-widget no-padding">
                                <div class="panel panel-default table-responsive">
                                    <table class="table table-striped table-bordered user-table">
                                        <thead>
                                            <tr>
                                                <td><a href="" class="white-text sort-by">Usuario </a></td>
                                                <td><a href="" class="white-text sort-by">Tipo de usuario </a></td>
                                                <td><a href="" class="white-text sort-by">Estatus </a></td>
                                                <td>Ver información</td>
                                            </tr>
                                        </thead>
                                        <?php 
                                            $objModelo->listarUsuarioConsultar();      
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
