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

                    <div class="col-1">    
                        <?PHP
                        
                        if (isset($_SESSION["ErrorCierreActivo"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Error al Cerrar Activo</h2>";
                            echo "<p class='margin-bottom-0'>No se puede cerrar un activo si las pruebas no están finalizadas.</p>";
                            echo "</div>";
                            unset($_SESSION["ErrorCierreActivo"]);
                        }
                        ?>
       
                    </div> 

                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Cerrar activo</h2>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Nombre</label>
                                    <input type="text" class="form-control" name="nombreActivo" id="nombreActivo" maxlength="80" value="<?PHP echo $nombre;?>"  readonly>                  
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Propietario del activo</label>
                                    <input type="text" class="form-control" name="propietario" id="propietario" maxlength="80" value="<?PHP echo $propietarioActivo;?>"  readonly>                  
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Versión</label>
                                    <input type="text" class="form-control" name="versión" id="versión" maxlength="80" value="<?PHP echo $version;?>"  readonly>                  
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Comentarios</label>
                                    <input type="text" class="form-control" name="comentarios" id="comentarios"  maxlength="80" value="<?PHP echo $comentarios;?>"  readonly>                  
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputUsername">Fecha de inicio</label> 
                                    <input type="text"  class="form-control" name="fInicio" id="fInicio" value="<?PHP echo $fInicio;?>"  readonly><br><br>                  
                                </div>

                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="inputUsername">Fecha de conclusión</label>                  
                                    <input type="text" class="form-control" name="fFin" id="fFin" value="<?PHP echo $fFin;?>"  readonly><br><br>
                                </div> 
                                
                            </div>
                        </form>
                        <div class="content-container">
                            <h2 class="margin-bottom-10">Pruebas de activo</h2>
                            <div class="content-widget no-padding">
                                
                                <div class="panel panel-default table-responsive">
                                    <table class="table table-striped table-bordered user-table">
                                        <thead>
                                            <tr>
                                                <td><a href="" class="white-text sort-by">Id </a></td>                                                
                                                <td><a href="" class="white-text sort-by">Fecha Inicio </a></td>
                                                <td><a href="" class="white-text sort-by">Fecha Fin </a></td>
                                                <td><a href="" class="white-text sort-by">Tipo de prueba </a></td>
                                                <td><a href="" class="white-text sort-by">Metodología </a></td>  
                                                <td><a href="" class="white-text sort-by">Estatus</a></td>                                                                                              
                                                
                                            </tr>
                                        </thead>
                                        <?php 
                                            $objModelo->listarEstatusPruebas($idActivo);      
                                        ?> 

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-2 col-md-2 form-group">  
                                 <form class="login-form" method="post" action="../../controlador/controlador.php">
                                <input type='hidden' name='idActivo' value='<?php echo $idActivo; ?>'>
                                <button name='cierraActivo' id='cierraActivo'  class="blue-button">Cerrar Activo</button>          
                                </form>
                            </div>
                            <div class="col-lg-2 col-md-2 form-group">                  
                                <form action="consultarActivos.php" class="login-form" method="post">
                                <button class="white-button">Cancelar</button>  
                            </form>             
                            </div>

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
