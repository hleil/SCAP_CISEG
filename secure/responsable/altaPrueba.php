<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT']."/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$objetoModelo = new Modelo();
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
                        
                        if (isset($_SESSION["errorPruebaMetodologia"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Tipo de prueba y Metodología</h2>";
                            echo "<p class='margin-bottom-0'>No existe un flujo para la metodología y tipo de prueba seleccionados.</p>";
                            echo "</div>";
                            unset($_SESSION["errorPruebaMetodologia"]);
                        }
                        ?>
       
                    </div> 

                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Alta de prueba</h2>
                        <p>Por favor, complete la siguiente información:</p>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Tipo de prueba</label>
                                    <select class="form-control" name="tipoPrueba" id="tipoPrueba" required>
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaTiposPrueba();
                                        ?>
                                    </select>                
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Metodología</label>
                                    <select class="form-control" name="tipoMetodologia" id="tipoMetodologia" required>
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaTiposMetodologia();
                                        ?>
                                    </select>                 
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Evaluador 1</label>
                                    <select class="form-control" name="evaluador1" id="evaluador1" required>
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaEvaluadores();
                                        ?>
                                    </select>                
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Evaluador 2</label>
                                    <select class="form-control" name="evaluador2" id="evaluador2" required>
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaEvaluadores();
                                        ?>
                                    </select>                 
                                </div>
                            </div>
                           
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Validador</label>
                                    <select class="form-control" name="validador" id="validador" required>
                                        <option disabled selected value> -- Seleccione una opción  -- </option>
                                        <?PHP
                                            $objetoModelo ->listaValidadores();
                                        ?>
                                    </select>                   
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                               
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputUsername">Fecha de inicio</label> 
                                    <input type="date" class="form-control" id="finicioPrueba" name="finicioPrueba" max="2030-12-31" required><br><br>                  
                                </div>

                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="inputUsername">Fecha de conclusión</label>                  
                                    <input type="date" class="form-control" id="ffinPrueba" name="ffinPrueba" max="2030-12-31" required><br><br>
                                </div> 
                                
                            </div>

                            

                            <div class="form-group text-right">
                                <button type="reset" class="white-button" onclick="window.location.href = 'gestionactivos.php'">Cancelar</button>
                                <button type="submit" class="blue-button" name="agregarPrueba" id="agregarPrueba">Agregar Prueba</button>
                            </div>  
                        </form>
                    </div>
                    <footer class="text-right">
                        <p>Copyright &copy; 2018 CISEG | CIC IPN </p>
                    </footer>
                </div>
            </div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script>
                var dtToday = new Date();
    
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;
                $('#finicioPrueba').attr('min', maxDate);
                $('#ffinPrueba').attr('min', maxDate);
            </script>

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
