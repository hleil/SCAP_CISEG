<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
if (isset($_SESSION["ultimoLogin"])) {
    $ultimoLogin = $_SESSION["ultimoLogin"];
    $ultimoLogin = date_create($ultimoLogin);
}
else{
    $ultimoLogin ="";
}
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
                        <center>
                            <h2 class="margin-bottom-10">Bienvenido</h2>
                            <h3 class="margin-bottom-0"><?PHP echo $nombre ?></h3><br>
                            <p class="margin-bottom-0">Último inicio de sesión: <?PHP echo date_format($ultimoLogin, 'd/m/Y H:i:s'); ?></p>
                        </center>
                    </div>
                    <footer class="text-right">
                        <p>Copyright &copy; 2018 CISEG | CIC IPN </p>
                    </footer>
                </div>
            </div>

            <script src="../js/jquery-1.11.2.min.js"></script>
            <script src="../js/jquery-migrate-1.2.1.min.js"></script> 
            <script type="text/javascript" src="../js/script.js"></script>

        </body>
    </html>
    <?php
} else {
    session_destroy();
    header("location:../../common/403.php");
}
?>
