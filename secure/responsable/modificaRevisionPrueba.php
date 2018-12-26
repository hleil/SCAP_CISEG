<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objetoModelo = new Modelo();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];

$fabricante=$_SESSION["fabricante"];
$producto=$_SESSION["producto"];
$version=$_SESSION["version"];
$edicion=$_SESSION["edicion"];
$ediSoft=$_SESSION["ediSoft"];
$comentarios=$_SESSION["comentarios"];
$tipoRevision=$_SESSION["tipoRevision"];
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
                        <h2 class="margin-bottom-10">Modificar la Revision de Configuraciones</h2>
                        <p>Por favor, complete la siguiente información:</p>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Fabricante</label>
                                    <input type="text" class="form-control" name="fabricante" id="fabricante" placeholder="grupo" maxlength="80" value="<?PHP echo $fabricante;?>"  required>              
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Producto</label>
                                    <input type="text" class="form-control" name="producto" id="producto" placeholder="titulo" maxlength="80" value="<?php echo $producto; ?>" required>                
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Version</label>
                                    <input type="text" class="form-control" name="version" id="version" placeholder="grupo" maxlength="80" value="<?php echo $version; ?>" required>              
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Edicion</label>
                                    <input type="text" class="form-control" name="edicion" id="edicion" placeholder="titulo" maxlength="80" value="<?php echo $edicion; ?>" required>                
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Edicion de Software</label>
                                    <input type="text" class="form-control" name="ediSoftware" id="ediSoftware" placeholder="grupo" maxlength="80" value="<?php echo $ediSoft; ?>" required>              
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Comentarios</label>
                                    <textarea class="form-control" id="comentario"  name="comentarios" rows="3"><?php echo $comentarios ;?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Tipo de revisión</label>
                                    <select class="form-control" name="tipoRevision" id="tipoRevision" required>
                                        <option disabled > -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaConsTiposRevisiones($tipoRevision);
                                        ?>
                                    </select>                
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <!--<button type="reset" class="white-button" onclick="window.location.href = 'gestionactivos.php'">Cancelar</button>-->
                                <input type='hidden' name='idRevConf' id='idRevConf' value='<?php echo $idRevConf; ?>'>
                                <button type="reset" class="white-button" onclick="window.location.href = 'consultaCasosPrueba.php'">Cancelar</button>
                                <button type="submit" class="blue-button" name="saveModRevConf" id="saveModRevConf">Guardar</button>
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
