<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objetoModelo = new Modelo();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];

$eval1 = $_SESSION["evaluador1"];
$eval2 = $_SESSION["evaluador2"];

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
                        <h2 class="margin-bottom-10">Alta de revisión de configuraciones</h2>
                        <p>Por favor, complete la siguiente información:</p>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Fabricante</label>
                                    <input type="text" class="form-control" name="fabricante" id="fabricante" placeholder="Fabricante" maxlength="80" required>              
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Producto</label>
                                    <input type="text" class="form-control" name="producto" id="producto" placeholder="Producto" maxlength="80" required>                
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Versión</label>
                                    <input type="text" class="form-control" name="version" id="version" placeholder="1.0" maxlength="80" required>              
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Edición</label>
                                    <input type="text" class="form-control" name="edicion" id="edicion" placeholder="XXXX" maxlength="80" required>                
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Edición de Software</label>
                                    <input type="text" class="form-control" name="ediSoftware" id="ediSoftware" placeholder="XXX-XXX" maxlength="80" required>              
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Comentarios</label>
                                    <textarea class="form-control" id="comentario" name="comentarios" rows="3"></textarea>
                                </div>
                            </div>
                            <input type='hidden' name="eval1" value="<?php echo $eval1; ?>">
                            <input type='hidden' name="eval2" value="<?php echo $eval2; ?>">

                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Tipo de revisión</label>
                                    <select class="form-control" name="tipoRevision" id="tipoRevision" required>
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaTiposRevisiones();
                                        ?>
                                    </select>                
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="reset" class="white-button" onclick="window.location.href = 'gestionactivos.php'">Cancelar</button>
                                <button type="submit" class="blue-button" name="agregarRevConf" id="agregarRevConf">Siguiente</button>
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
