<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
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
                    <div class="col-1">    
                        <?PHP
                        if (isset($_SESSION["agregarActivo"])) {
                            echo "<div class='content-widget green-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar activo</h2>";
                            echo "<p class='margin-bottom-0'>Se ha agregado el activo y prueba correctamente</p>";
                            echo "</div>";
                            unset($_SESSION["agregarActivo"]);
                        }
                        if (isset($_SESSION["agregarActivo"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar activo</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al agregar un activo</p>";
                            echo "</div>";
                            unset($_SESSION["agregarActivo"]);
                        }
                        if (isset($_SESSION["errorAgregarPrueba"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar prueba</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al agregar una prueba</p>";
                            echo "</div>";
                            unset($_SESSION["errorAgregarPrueba"]);
                        }
                        if (isset($_SESSION["errorAgregarEvaluador"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar evaluador</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al agregar un evaluador</p>";
                            echo "</div>";
                            unset($_SESSION["errorAgregarEvaluador"]);
                        }
                        if (isset($_SESSION["errorAgregarValidador"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar validador</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al agregar un validador</p>";
                            echo "</div>";
                            unset($_SESSION["errorAgregarValidador"]);
                        }
                        ?>
       
                    </div>   


                    <div class="content-widget white-bg">
                        <center>
                            <h2 class="margin-bottom-10">Gestión de activos</h2>
                        </center>
                        <p class="margin-bottom-0">Seleccione una opción:</p>
                        <br>

                        <div class="row form-group">
                            <form action="altaActivo.php" class="login-form" method="post">
                                <div class="col-lg-3 col-md-3 form-group">                  
                                    <button class="blue-button">Alta de activo</button>               
                                </div>
                            </form>
                            <form action="consultarActivos.php" class="login-form" method="post" >
                                <div class="col-lg-3 col-md-3 form-group">                  
                                    <button class="blue-button">Consultar activo</button>              
                                </div>
                            </form>
                            <form action="eliminarUsuario.php" class="login-form" method="post">
                                <div class="col-lg-3 col-md-3 form-group">                  
                                    <button class="blue-button">Histórico de activo</button>                
                                </div>
                            </form>
                        </div>


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
