<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";

$objetoMenu = new ModeloMenus();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
$idUsuarioCon = $_SESSION["idUsuarioCon"];
$nombreCon = $_SESSION["nombreCon"] ;
$correoCon = $_SESSION["correoCon"] ;
$estatusCon = $_SESSION["estatusCon"];
$rolCon = $_SESSION["rolCon"];

switch ($rolCon) {
    case "1":
        $rolCon = "Administrador";
        breaK;
    case "2":
        $rolCon = "Responsable de evaluación";
        breaK;
    case "3":
        $rolCon = "Evaluador";
        breaK;
    case "4":
        $rolCon = "Validador";
        breaK;
    default:
        $rolCon = "Usuario";
        breaK;
}

switch ($estatusCon) {
    case "1":
        $estatusCon = "Activo";
        breaK;
    case "2":
        $estatusCon = "Eliminado";
        breaK;
    default:
        $estatusCon = "Estatus";
        breaK;
}

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
                        <h2 class="margin-bottom-10">Modificar usuario</h2>
                        <p>Por favor, introduzca los datos del usuario que desea modificar:</p>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario"  value="<?PHP echo $nombreCon;?>"  readonly>                  
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputLastName">Correo electrónico</label>
                                    <input type="text" class="form-control" name="correo" id="correo"  value="<?PHP echo $correoCon;?>" readonly>                  
                                </div> 
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputLastName">Tipo de usuario</label>
                                    <input type="text" class="form-control" name="rol" id="rol"  value="<?PHP echo $rolCon;?>" readonly>                  
                                </div> 
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputLastName">Estatus</label>
                                    <input type="text" class="form-control" name="rol" id="rol"  value="<?PHP echo $estatusCon;?>" readonly>                  
                                </div> 
                            </div>
                            <div class="form-group text-right">
                                <input type="hidden" name="idUsuarioMod" value="<?PHP echo $_SESSION["idUsuarioMod"];?>">
                                <button type="reset" class="white-button" onclick="window.location.href = 'consultarUsuario.php'">Regresar</button>
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
