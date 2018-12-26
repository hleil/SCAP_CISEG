<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/SCAP/controlador/controladorMenus.php";
$objetoMenu = new ModeloMenus();
$idUsuario = $_SESSION["idUsuario"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];
unset($_SESSION["errorPruebaMetodologia"]);

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

            <script type="text/javascript">
               function resetForm(myFormId)
               {
                   var myForm = document.getElementById(myFormId);

                   for (var i = 0; i < myForm.elements.length; i++)
                   {
                       if ('submit' != myForm.elements[i].type && 'reset' != myForm.elements[i].type)
                       {
                           myForm.elements[i].checked = false;
                           myForm.elements[i].value = '';
                           myForm.elements[i].selectedIndex = 0;
                       }
                   }
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
                        <?PHP
                        if (isset($_SESSION["errorFechasIguales"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Error en las fechas</h2>";
                            echo "<p class='margin-bottom-0'>Las fechas de inicio y fin no pueden ser iguales</p>";
                            echo "</div>";
                            unset($_SESSION["errorFechasIguales"]);
                        }
                        if (isset($_SESSION["errorFechaMayor"])) {
                            echo "<div class='content-widget pink-bg'>";
                            echo "<h2 class='text-uppercase margin-bottom-10'>Error en las fechas</h2>";
                            echo "<p class='margin-bottom-0'>Las fechas de fin no pueden menor a la fecha de inicio</p>";
                            echo "</div>";
                            unset($_SESSION["errorFechaMayor"]);
                        }
                        ?>
                    </div>


                    <div class="content-widget white-bg">
                        <h2 class="margin-bottom-10">Alta de activo</h2>
                        <p>Por favor, complete la siguiente información:</p>
                        <form class="login-form" method="post" action="../../controlador/controlador.php">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Nombre</label>
                                    <input type="text" class="form-control" name="nombreActivo" id="nombreActivo" placeholder="Nombre" maxlength="80" <?PHP if (isset($_SESSION["nombreActivo"])) { echo "value='".$_SESSION["nombreActivo"]."'"; unset($_SESSION["nombreActivo"]);} ?> required>                  
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Propietario del activo</label>
                                    <input type="text" class="form-control" name="propietario" id="propietario" placeholder="Propietario" maxlength="80" <?PHP if (isset($_SESSION["propietario"])) {echo "value='".$_SESSION["propietario"]."'"; unset($_SESSION["propietario"]);}?> required>                  
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Versión</label>
                                    <input type="text" class="form-control" name="version" id="version" placeholder="Versión" maxlength="80" <?PHP if (isset($_SESSION["version"])) {echo "value='".$_SESSION["version"]."'"; unset($_SESSION["version"]);}?> required>                  
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputFirstName">Comentarios</label>
                                    <input type="text" class="form-control" name="comentarios" id="comentarios" placeholder="Comentarios" maxlength="80" <?PHP if (isset($_SESSION["comentarios"])) {echo "value='".$_SESSION["comentarios"]."'"; unset($_SESSION["comentarios"]);}?> required>                  
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">                  
                                    <label for="inputUsername">Fecha de inicio</label> 
                                    <input type="date" class="form-control" id="fInicio" name="fInicio" max="2030-12-31" required><br><br>                  
                                </div>
  


                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="inputUsername">Fecha de conclusión</label>                  
                                    <input type="date" class="form-control" id="fFin" name="fFin" min="2018-12-01" max="2030-12-31" required><br><br>
                                </div> 

                            </div>



                            <div class="form-group text-right">
                                <button type="reset" class="white-button" onclick="window.location.href = 'gestionactivos.php'">Cancelar</button>
                                <button type="submit" class="blue-button" name="agregarActivo" id="agregarActivo">Siguiente</button>
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
                $('#fInicio').attr('min', maxDate);
                $('#fFin').attr('min', maxDate);
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
