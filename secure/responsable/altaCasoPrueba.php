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
            <script type='text/javascript'>
                function guardaCasoPrueba(){
                    document.getElementById("opcionValue").value = "1";
                    console.log(document.getElementById("opcionValue").value);
                }
                function agregaRevConf(){
                    document.getElementById("opcionValue").value = "2";
                    console.log(document.getElementById("opcionValue").value);
                }
            </script>
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
                    </div>
                    <?PHP
                        if (isset($_SESSION["altaCasoPrueba"])) {
                            echo "<div class='content-widget green-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Agregar caso de prueba</h2>";
                            echo "<p class='margin-bottom-0'>Se ha agregado el caso de prueba correctamente</p>";
                            echo "</div>";
                            unset($_SESSION["altaCasoPrueba"]);
                        }
                    ?>


                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Alta de caso de prueba</h2>
                        <p>Por favor, complete la siguiente información:</p>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Grupo</label>
                                    <input type="text" class="form-control" name="grupo" id="grupo" placeholder="Grupo" maxlength="150" required>              
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Título</label>
                                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" maxlength="150" required>                
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-6 form-group">                  
                                    <label for="inputFirstName">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                                 
                                </div>                                
                            </div>
                            
                            <input type='hidden' name="eval1" value="<?php echo $eval1; ?>">
                            <input type='hidden' name="eval2" value="<?php echo $eval2; ?>">
                            <div class="form-group text-right">                                
                                <!--<button type="reset" class="white-button" onclick="window.location.href = 'gestionactivos.php'">Cancelar</button>-->
                                <input type="hidden" id="opcionValue" name="opcionValue" value="0">
                                <button type="submit" class="blue-button" onclick="guardaCasoPrueba()" name="agregarCasoPrueba" id="agregarCasoPrueba">Finalizar</button>
                                <button type="submit" class="blue-button" name="agregarCasoPrueba" id="agregarCasoPrueba">Guardar y Agregar Caso de prueba</button>
                                <button type="submit" class="blue-button" onclick="agregaRevConf()" name="agregarCasoPrueba" id="agregarCasoPrueba">Guardar y Agregar Revision de configuraciones</button>
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
