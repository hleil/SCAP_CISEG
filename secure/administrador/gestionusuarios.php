<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
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
                    <div class="col-1">             
                        <?PHP
                        if (isset($_SESSION["errorEmail"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Enviar email</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al enviar email al usuario</p>";
                            echo "</div>";
                            unset($_SESSION["errorEmail"]);
                        }
                        if (isset($_SESSION["errorUsuario"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar usuario</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al agregar al usuario</p>";
                            echo "</div>";
                            unset($_SESSION["errorUsuario"]);
                        }
                        if (isset($_SESSION["altaUsuario"])) {
                            echo "<div class='content-widget green-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar usuario</h2>";
                            echo "<p class='margin-bottom-0'>Se ha agregado al usuario correctamente</p>";
                            echo "</div>";
                            unset($_SESSION["altaUsuario"]);
                        }
                        if (isset($_SESSION["errorEliminarUsuario"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Eliminar usuario</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al eliminar al usuario</p>";
                            echo "</div>";
                            unset($_SESSION["errorEliminarUsuario"]);
                        }
                        if (isset($_SESSION["bajaUsuario"])) {
                            echo "<div class='content-widget green-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Eliminar usuario</h2>";
                            echo "<p class='margin-bottom-0'>Se ha eliminado al usuario correctamente</p>";
                            echo "</div>";
                            unset($_SESSION["bajaUsuario"]);
                        }
                        if (isset($_SESSION["errorActualizarUsuario"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Modificar usuario</h2>";
                            echo "<p class='margin-bottom-0'>Ocurrió un error al modificar el usuario</p>";
                            echo "</div>";
                            unset($_SESSION["errorActualizarUsuario"]);
                        }
                        if (isset($_SESSION["actualizarUsuario"])) {
                            echo "<div class='content-widget green-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Modificar usuario</h2>";
                            echo "<p class='margin-bottom-0'>Se ha modificado el usuario correctamente</p>";
                            echo "</div>";
                            unset($_SESSION["actualizarUsuario"]);
                        }
                        ?>         
                    </div>   


                    <div class="content-widget white-bg">
                        <center>
                            <h2 class="margin-bottom-10">Gestión de usuarios</h2>
                        </center>
                        <p class="margin-bottom-0">Seleccione una opción:</p>
                        <br>

                        <div class="row form-group">
                            <form action="altaUsuario.php" class="login-form" method="post">
                                <div class="col-lg-3 col-md-3 form-group">                  
                                    <button class="blue-button">Alta usuario</button>               
                                </div>
                            </form>
                            <form action="eliminarUsuario.php" class="login-form" method="post">
                                <div class="col-lg-3 col-md-3 form-group">                  
                                    <button class="blue-button">Eliminar usuario</button>                
                                </div>
                            </form>
                            <form action="modificarUsuario.php" class="login-form" method="post">
                                <div class="col-lg-3 col-md-3 form-group">                  
                                    <button class="blue-button">Modificar usuario</button>                
                                </div>
                            </form>
                            <form action="consultarUsuario.php" class="login-form" method="post" >
                                <div class="col-lg-3 col-md-3 form-group">                  
                                    <button class="blue-button">Consultar usuario</button>              
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
