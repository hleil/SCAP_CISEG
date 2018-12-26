<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objModelo = new Modelo();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
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
                    
                    <div class="col-1">             
                        <?PHP
                        if (isset($_SESSION["errorAgregarResultado"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar evaluación</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al agregar el resultado de la evaluación</p>";
                            echo "</div>";
                            unset($_SESSION["errorAgregarResultado"]);
                        }
                        if (isset($_SESSION["agregarResultado"])) {
                            echo "<div class='content-widget green-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar evaluación</h2>";
                            echo "<p class='margin-bottom-0'>Se ha agregado el resultado de la evaluación correctamente</p>";
                            echo "</div>";
                            unset($_SESSION["agregarResultado"]);
                        }
                        if (isset($_SESSION["errorModificarResultado"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Modificar evaluación</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al modificar el resultado de la evaluación</p>";
                            echo "</div>";
                            unset($_SESSION["errorModificarResultado"]);
                        }
                        if (isset($_SESSION["modificarResultado"])) {
                            echo "<div class='content-widget green-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Modificar evaluación</h2>";
                            echo "<p class='margin-bottom-0'>Se ha modificado el resultado de la evaluación correctamente</p>";
                            echo "</div>";
                            unset($_SESSION["modificarResultado"]);
                        }
                        
                        ?>         
                    </div> 


                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Consultar asignaciones</h2>
                        <p>Por favor, seleccione la asignación que desea evaluar</p>
                        <div class="content-container">
                            <div class="content-widget no-padding">
                                <div class="panel panel-default table-responsive">
                                    <table class="table table-striped table-bordered user-table">
                                        <thead>
                                            <tr>
                                                <td><a href="" class="white-text sort-by">Activo </a></td>
                                                <td><a href="" class="white-text sort-by">Prueba </a></td>
                                                <td><a href="" class="white-text sort-by">Casos de prueba</a></td>
                                                <td><a href="" class="white-text sort-by">Producto</a></td>
                                                <td><a href="" class="white-text sort-by">Configuración</a></td>
                                                <td><a href="" class="white-text sort-by">Estatus</a></td>                                               
                                                <td>Evaluar</td>
                                            </tr>
                                        </thead>
                                        <?php 
                                            $objModelo->listarAsignaciones();      
                                            $objModelo->listarAsignacionesCodigo();      
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
