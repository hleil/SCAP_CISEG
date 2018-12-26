<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
$objModelo = new Modelo();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
$idCasoPrueba = $_SESSION["idCasoPrueba"];
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
                        $objetoMenu->MenuEvaluador();                    
                        ?>

                    </nav>
                </div>
                <!-- Main content --> 
                <div class="content col-1 light-gray-bg">


                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Evaluación de caso de prueba</h2>
                        <p>Por favor, complete la siguiente información:</p>
                    </div>
                        <?php $objModelo->resultadosDetalle($idCasoPrueba);?>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                    <div class="content-widget white-bg">        
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-6 form-group">                  
                                    <label for="inputFirstName">Grupo</label>
                                    <p><?PHP echo $_SESSION["grupo"];?></p>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">                  
                                    <label for="inputFirstName">Título</label>
                                    <p><?PHP echo $_SESSION["titulo"];?></p>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">                  
                                    <label for="inputFirstName">Descripción 1</label>
                                    <p><?PHP echo $_SESSION["descripcion"];?></p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Entrada 1 (Script)</label>
                                    <textarea class="form-control"  name="entrada" id="entrada" rows="4" cols="50" maxlength="200" disabled required><?php echo $_SESSION["entrada1"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Resultado 1</label>
                                    <textarea class="form-control"  name="resultado" id="resultado" rows="4" cols="50" maxlength="200" disabled ><?php echo $_SESSION["resultado1"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Información complementaria 1</label>
                                    <textarea class="form-control"  name="infComp" id="infComp" rows="4" cols="50" maxlength="200" disabled required><?php echo $_SESSION["infoComp1"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Evidencias 1</label>
                                    <textarea class="form-control"  name="evidencias" id="evidencias" rows="4" cols="50" maxlength="200" disabled ><?php echo $_SESSION["eviden1"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Recomendación 1</label>
                                    <textarea class="form-control"  name="recomendacion" id="recomendacion" rows="4" cols="50" maxlength="200" disabled ><?php echo $_SESSION["recom1"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Resultado de la evaluación</label>
                                    <input type="text" class="form-control" value="<?php echo $_SESSION["res1"];?>" disabled>
                                    <!--<select class="form-control" name="resultadoEval" id="tipoUsuario" >
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <option value="Correcto">Configuración correcta</option>;
                                        <option value="Incorrecto">Configuración incorrecta</option>; 
                                    </select>  -->
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Entrada 2 (Script)</label>
                                    <textarea class="form-control"  name="entrada" id="entrada" rows="4" cols="50" maxlength="200" disabled required><?php echo $_SESSION["entrada2"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Resultado 2</label>
                                    <textarea class="form-control"  name="resultado" id="resultado" rows="4" cols="50" maxlength="200" disabled ><?php echo $_SESSION["resultado2"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Información complementaria 2</label>
                                    <textarea class="form-control"  name="infComp" id="infComp" rows="4" cols="50" maxlength="200" disabled required><?php echo $_SESSION["infoComp2"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Evidencias 2</label>
                                    <textarea class="form-control"  name="evidencias" id="evidencias" rows="4" cols="50" maxlength="200" disabled ><?php echo $_SESSION["eviden2"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Recomendación 2</label>
                                    <textarea class="form-control"  name="recomendacion" id="recomendacion" rows="4" cols="50" maxlength="200" disabled ><?php echo $_SESSION["recom2"];?></textarea>
                                </div>
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Resultado de la evaluación</label>
                                    <input type="text" class="form-control" value="<?php echo $_SESSION["res2"];?>" disabled>
                                    <!--<select class="form-control" name="resultadoEval" id="tipoUsuario" >
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <option value="Correcto">Configuración correcta</option>;
                                        <option value="Incorrecto">Configuración incorrecta</option>; 
                                    </se-lect>  -->
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6 form-group">                  
                                <label for="inputFirstName">Comentario</label>
                                <textarea class="form-control"  name="comentario" id="comentario" rows="4" cols="50" maxlength="200" ></textarea>
                            </div>
                    </div>        
                            
                    <input type="hidden" name="idTipoPrueba" value="<?php echo $_SESSION["idTipoPrueba"];?>">
                            <input type="hidden" name="id1" value="<?php echo $_SESSION["ID1"];?>">
                            <input type="hidden" name="id2" value="<?php echo $_SESSION["ID2"];?>">
                            <div class="form-group text-right">
                                <button type="submit" class="white-button" name="rechazarCasoPrueba">Rechazar</button>
                                <button type="submit" class="blue-button" name="validarCasoPrueba" id="registrarResultado">Validar</button>
                            </div>  
                        </form>
                    


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
