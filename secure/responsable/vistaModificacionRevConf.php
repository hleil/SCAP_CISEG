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
$idRevConf=$_SESSION["idRevConf"];

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
                        
                        
                       <?PHP
                        $objModelo->listaRevConfig($idRevConf);
                        ?>
                        <div class="row form-group">
                            <form action='../../controlador/controlador.php' class='login-form' method='post' >
                                <div class="col-lg-2 col-md-2 form-group">                  
                                    <input type='hidden' name='idActivo' value='" <?php $idActivo ?>"'>
                                    <button type='submit' name='regresarMenu' id='regresarMenu' class='blue-button'>Finalizar</button>
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
 