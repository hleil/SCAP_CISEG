<?php

require $_SERVER['DOCUMENT_ROOT'] . "/SCAP/conexion/conexion.php";

class Modelo {

    var $conn;
    var $conexion;

    function Modelo() {
        $this->conexion = new Conexion();
        $this->conn = $this->conexion->conectarse();
    }

    function login($correo, $password) {
        $sql = "SELECT * FROM TAUSRSCAP WHERE correo= '" . $correo . "'";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);

        if (!$datos["estatus"]) {
            $rol = -1;
        } else {
            $estatus = $datos["estatus"];
            if ($estatus == 2) {

                $rol = -1;
            } else {
                $contrasena = $datos["contrasena"];
                if ($contrasena != $password) {
                    $rol = -1;
                } else {
                    $idUsuario = $datos["idTAUSRSCAP"];
                    $nombre = $datos["nombre"];
                    $primerLogin = $datos["primerLogin"];
                    $rol = $datos["rol"];
                }
            }
        }

        return array($idUsuario, $nombre, $primerLogin, $rol, $estatus);
    }

    function registraLogin($idUsuario) {
        $banderaInsert = false;
        $sql = "INSERT into REGLOGIN (login,idUsr) VALUES (NOW()," . $idUsuario . ")";
        if (mysqli_query($this->conn, $sql)) {
            $banderaInsert = true;
        }
        return $banderaInsert;
    }

    function obtenUltimoLogin($idUsuario) {
        $sql = "SELECT login FROM REGLOGIN WHERE idUsr=" . $idUsuario . " order by login desc limit 1;";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        if ($datos["login"]) {
            $_SESSION["ultimoLogin"] = $datos["login"];
        }
    }
    
    function recuperarContrasena($correo,$contrasena) {
        $banderaUpdate = false;
        $sql = "UPDATE TAUSRSCAP set contrasena = SHA2('".$contrasena."', 256), primerLogin=1 WHERE correo='" . $correo . "'";
        echo $sql;
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function altaUsuario($nombre, $correo, $tipoUsuario) {
        $banderaInsert = false;
        $sql = "INSERT into TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('" . $nombre . "','" . $correo . "',SHA2('Scap;2018', 256),1,NOW()," . $tipoUsuario . ",1)";
        if (mysqli_query($this->conn, $sql)) {
            $banderaInsert = true;
        }
        return $banderaInsert;
    }

    function listarUsuarioEliminar() {
        $sql = "SELECT * FROM TAUSRSCAP  WHERE estatus=1";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {


            $rol = $datos["rol"];
            switch ($rol) {
                case "1":
                    $rol = "Administrador";
                    breaK;
                case "2":
                    $rol = "Responsable de evaluación";
                    breaK;
                case "3":
                    $rol = "Evaluador";
                    breaK;
                case "4":
                    $rol = "Validador";
                    breaK;
                default:
                    $rol = "Usuario";
                    breaK;
            }

            $estatus = $datos["estatus"];
            switch ($estatus) {
                case 1:
                    $estatus = "Activo";
                    breaK;
                case 2:
                    $estatus = "Eliminado";
                    breaK;
                default:
                    $status = "Estatus";
                    breaK;
            }

            if ($datos["rol"] != 1) {
                echo "<tbody>";
                echo "<tr>";
                echo "<td>" . $datos["nombre"] . "</td>";
                echo "<td>" . $rol . "</td>";
                echo "<td>" . $estatus . "</td>";
                echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";


                echo "<td><button type='submit' name='bajaUsuario' id='bajaUsuario' class='edit-btn'>Eliminar</button></td>";
                echo "</form>";
                echo "</tr>";
            }
        }
    }

    function listarUsuarioModificar() {
        $sql = "SELECT * FROM TAUSRSCAP ";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {


            $rol = $datos["rol"];
            switch ($rol) {
                case "1":
                    $rol = "Administrador";
                    breaK;
                case "2":
                    $rol = "Responsable de evaluación";
                    breaK;
                case "3":
                    $rol = "Evaluador";
                    breaK;
                case "4":
                    $rol = "Validador";
                    breaK;
                default:
                    $rol = "Usuario";
                    breaK;
            }

            $estatus = $datos["estatus"];
            switch ($estatus) {
                case 1:
                    $estatus = "Activo";
                    breaK;
                case 2:
                    $estatus = "Eliminado";
                    breaK;
                default:
                    $status = "Estatus";
                    breaK;
            }

            if ($datos["rol"] != 1) {
                echo "<tbody>";
                echo "<tr>";
                echo "<td>" . $datos["nombre"] . "</td>";
                echo "<td>" . $rol . "</td>";
                echo "<td>" . $estatus . "</td>";
                echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";


                echo "<td><button type='submit' name='modificarUsuario' id='modificarUsuario' class='edit-btn'>Modificar</button></td>";
                echo "</form>";
                echo "</tr>";
            }
        }
    }

    function bajaUsuario($idUsuario) {
        $banderaUpdate = false;
        $sql = "UPDATE TAUSRSCAP set estatus = 2 WHERE idTAUSRSCAP=" . $idUsuario . "";
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function consultarUsuario($idUsuario) {
        $sql = "SELECT * FROM TAUSRSCAP WHERE idTAUSRSCAP = " . $idUsuario . "";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        $nombre = $datos["nombre"];
        $correo = $datos["correo"];
        $estatus = $datos["estatus"];
        $rol = $datos["rol"];
        return array($nombre, $correo, $estatus, $rol);
    }

    function modificarDatosUsuario($idUsuario, $estatus) {

        $banderaUpdate = false;
        $sql = "UPDATE TAUSRSCAP SET estatus = " . $estatus . " WHERE idTAUSRSCAP='" . $idUsuario . "'";
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function listarUsuarioConsultar() {
        $sql = "SELECT * FROM TAUSRSCAP ";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {


            $rol = $datos["rol"];
            switch ($rol) {
                case "1":
                    $rol = "Administrador";
                    breaK;
                case "2":
                    $rol = "Responsable de evaluación";
                    breaK;
                case "3":
                    $rol = "Evaluador";
                    breaK;
                case "4":
                    $rol = "Validador";
                    breaK;
                default:
                    $rol = "Usuario";
                    breaK;
            }

            $estatus = $datos["estatus"];
            switch ($estatus) {
                case 1:
                    $estatus = "Activo";
                    breaK;
                case 2:
                    $estatus = "Eliminado";
                    breaK;
                default:
                    $status = "Estatus";
                    breaK;
            }


            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $datos["nombre"] . "</td>";
            echo "<td>" . $rol . "</td>";
            echo "<td>" . $estatus . "</td>";
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";


            echo "<td><button type='submit' name='consultarUsuario' id='consultarUsuario' class='edit-btn'>Ver información</button></td>";
            echo "</form>";
            echo "</tr>";
        }
    }

    function primerLogin($idUsuario, $contrasena) {
        $banderaUpdate = false;
        $idUsuario = $_SESSION["idUsuario"];
        $sql = "UPDATE TAUSRSCAP set  contrasena = '" . $contrasena . "', primerLogin=0 WHERE idTAUSRSCAP='" . $idUsuario . "'";
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function listaTiposUsuario() {
        $sql = "SELECT * FROM CATROL";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            
            if(strcmp($datos["idCATROL"], "1")!=0){
               echo "<option value='".$datos["idCATROL"]."'>".$datos["rol"]."</option>"; 
            }
        }
    }
    
    function listaTiposRevisiones() {
        $sql = "SELECT * FROM CATIPOREVCONFIGURACION";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            
            if(strcmp($datos["idCATREVCONFIGURACION"], "1")!=0){
               echo "<option value='".$datos["idCATIPOREVCONFIGURACION"]."'>".$datos["revision"]."</option>"; 
            }
        }
    }

    function listaConsTiposRevisiones($selected) {
        $sql = "SELECT * FROM CATIPOREVCONFIGURACION";
        $rs = mysqli_query($this->conn, $sql);
        while ($datos = mysqli_fetch_array($rs)) {
            if(strcmp($datos["idCATIPOREVCONFIGURACION"], "1")!=0){
                if(strcmp($datos["idCATIPOREVCONFIGURACION"], $selected)==0){
                    echo "<option value='".$datos["idCATIPOREVCONFIGURACION"]."' selected=\"selected\">".$datos["revision"]."</option>"; 
                }else{
                    echo "<option value='".$datos["idCATIPOREVCONFIGURACION"]."'>".$datos["revision"]."</option>"; 
               }
            }
        }
    }
    
    function listaTiposPrueba() {
        $sql = "SELECT * FROM CATTIPOPRUEBA";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            echo "<option value='".$datos["idCATTIPOPRUEBA"]."'>".$datos["tipoPrueba"]."</option>"; 
        }
    }
    
    function listaTiposMetodologia() {
        $sql = "SELECT * FROM CATMETODOLOGIA";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            echo "<option value='".$datos["idCATMETODOLOGIA"]."'>".$datos["metodologia"]."</option>"; 
        }
    }
    
    function listaEvaluadores() {
        $sql = "SELECT idTAUSRSCAP,nombre FROM TAUSRSCAP US WHERE rol=3 and US.idTAUSRSCAP not in (SELECT idUSR FROM TAUSRCONFSCAP); ";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            echo "<option value='".$datos["idTAUSRSCAP"]."'>".$datos["nombre"]."</option>"; 
        }
    }
    
    function listaValidadores() {
        $sql = "SELECT idTAUSRSCAP,nombre FROM TAUSRSCAP US WHERE rol=4 and US.idTAUSRSCAP not in (SELECT idUSR FROM TAUSRSCAP_TAPRUEBASCAP); ";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            echo "<option value='".$datos["idTAUSRSCAP"]."'>".$datos["nombre"]."</option>"; 
        }
    }
    
    function agregarActivo($nombreActivo,$finicio,$ffin,$propietario,$comentarios,$version,$idUsuario){
        $banderaInsert = false;
        $sql = "INSERT into TAACTIVOSCAP (nombre,fInicio,fFin,propietarioActivo,comentarios,version,fAlta,responsable,estatus) VALUES ('".$nombreActivo."','".$finicio."','".$ffin."','".$propietario."','".$comentarios."','".$version."',NOW(),'".$idUsuario."',1)";
        if (mysqli_query($this->conn, $sql)) {
            $banderaInsert = true;
        }
        return $banderaInsert;
    }
        
    function obtenerIdActivo() {
        $sql = "SELECT idTAACTIVOSCAP FROM TAACTIVOSCAP order by idTAACTIVOSCAP desc limit 1";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        return $datos["idTAACTIVOSCAP"];
    }
    
    function agregarPrueba($finicioPrueba,$ffinPrueba,$tipoMetodologia,$tipoPrueba,$idActivo){
        $banderaInsert = false;
        $sql = "INSERT into TAPRUEBASCAP (fInicio,fFin,fAlta,metodologia,tipoPrueba,estatus,idActivo) VALUES ('".$finicioPrueba."','".$ffinPrueba."',NOW(),".$tipoMetodologia.",".$tipoPrueba.",1,".$idActivo.")";
        if (mysqli_query($this->conn, $sql)) {
            $banderaInsert = true;
        }
        return $banderaInsert;
    }
    
    function agregarRevConfiguraciones($fabricante,$producto,$version,$edicion,$ediSoftware, $comentarios, $idPrueba, $tipoRevision){
        $banderaInsert = false;
        $sql = "INSERT INTO TAREVCONFIGURACION (fabricante,producto,version,edicion,edicionSoftware, tipoRevision, comentarios, idPrueba) VALUES ('".$fabricante."','".$producto."','".$version."','".$edicion."','".$ediSoftware."',".$tipoRevision.",'".$comentarios."',".$idPrueba.")";
        
        if (mysqli_query($this->conn, $sql)) {
            $banderaInsert = true;
        }
        return $banderaInsert;
    }

    function modificaRevConfiguraciones($fabricante,$producto,$version,$edicion,$ediSoftware, $comentarios, $idRevConf, $tipoRevision){
        $banderaUpdate = false;
        $sql = "UPDATE TAREVCONFIGURACION SET fabricante= '".$fabricante."',producto='".$producto."',version='".$version."', edicion='".$edicion."', edicionSoftware='".$ediSoftware."',tipoRevision=".$tipoRevision.", comentarios='".$comentarios."' WHERE idTAREVCONFIGURACION=".$idRevConf;
        
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function modificaCasoPrueba($grupo,$titulo,$descripcion,$idCasoPrueba){
        $banderaUpdate = false;
        $sql = "UPDATE TACASOPRUEBACONFSCAP SET grupo= '".$grupo."',titulo='".$titulo."',descripcion='".$descripcion."' WHERE idTACASOPRUEBASCAP=".$idCasoPrueba;
        //echo $sql; 
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }


    function agregarCasoPrueba($grupo, $titulo, $version, $edicion, $descripcion,$idrevConfiguracion, $idUsr){
        $banderaInsert = false;
        $sql = "INSERT into TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,revConfiguracion,estatus) VALUES ('".$grupo."','".$titulo."','".$descripcion."',NOW(),".$idrevConfiguracion.",1)";        
        
        if (mysqli_query($this->conn, $sql)) {
            $last_id = mysqli_insert_id($this->conn);
            $sql = "INSERT INTO TAUSRCONFSCAP (idUSR,idCasoPruebaConf) VALUES (".$idUsr.",".$last_id.")";
            #echo $sql;
            if(mysqli_query($this->conn, $sql)){
                $banderaInsert = true;
            }else{
                $banderaInsert = false;
            }            
            
        }else{
            $banderaInsert = false;
        }
        return $banderaInsert;
        
    }
    
    function obtenerIdRevConf() {
        $sql = "SELECT idTAREVCONFIGURACION FROM TAREVCONFIGURACION order by idTAREVCONFIGURACION desc limit 1";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        return $datos["idTAREVCONFIGURACION"];
    }
    
    function obtenerIdPrueba() {
        $sql = "SELECT idTAPRUEBASCAP FROM TAPRUEBASCAP order by idTAPRUEBASCAP desc limit 1";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        return $datos["idTAPRUEBASCAP"];
    }
    
    function agregarEvaluador($evaluador,$idPrueba, $idTipoPrueba){    
        $banderaInsert = false;
        
        $tabla = "";
        switch($idTipoPrueba){
            case 1:
                $tabla = "TAUSRCONFSCAP";
            break;
            case 2:
                $tabla = "TAUSRSCSCAP";
            break;
            case 3:
                $tabla = "TAUSRSCAP_TAPRUEBASCAP";
            break;
            default:
                $tabla = "TAUSRSCSCAP";
            break;
        }
        $sql = "INSERT into ".$tabla." VALUES (".$evaluador.",".$idPrueba.")";
        #echo $sql;        
        #$sql = "INSERT into TAUSRCONFSCAP VALUES (".$evaluador.",".$idPrueba.")";
        if (mysqli_query($this->conn, $sql)) {
            $banderaInsert = true;
        }
        return $banderaInsert;
    }
 
     function listaCasoPrueba($idCasoPrueba){
        
        echo "<h2 class=\"margin-bottom-10\">Modificacion de Casos de Prueba</h2>";
        $sql2 = "SELECT * FROM TACASOPRUEBACONFSCAP WHERE idTACASOPRUEBASCAP=".$idCasoPrueba;

        $res = mysqli_query($this->conn, $sql2);

        echo " <div class=\"content-container\">";
                #echo " <h2 class=\"margin-bottom-10\">Casos de prueba</h2>";
                echo "<div class=\"content-widget no-padding\">";
                    
                    echo "<div class=\"panel panel-default table-responsive\">";
                        echo "<table class=\"table table-striped table-bordered user-table\">";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Grupo</a></td>";                                                
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Titulo</a></td>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Descripcion</a></td>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Estatus</a></td>";
                                echo "</tr>";
                            echo "</thead>";

            while ($datos2 = mysqli_fetch_array($res)) {
                $grupo = $datos2["grupo"];
                $titulo = $datos2["titulo"];
                $descripcion = $datos2["descripcion"];
                $estatus = $datos2["estatus"];
                $idCasoPrueba = $datos2["idTACASOPRUEBASCAP"];
                
                #echo "<tbody>";
                echo "<tr>";
                echo "<td>" . $grupo. "</td>";
                echo "<td>" . $titulo. "</td>";
                echo "<td>" . $descripcion . "</td>";
                    
                switch ($estatus) {
                    case 1:
                        echo "<td><label class=\"contro-label block\">Activo</label></td>";
                        break;
                    case 2:
                        echo "<td><label class=\"contro-label block\">En proceso</label></td>";
                        break;
                    case 3:
                        echo "<td><label class=\"contro-label block\">Terminada</label></td>";
                        break;
                    case 4:
                        echo "<td><label class=\"contro-label block\">Rechazada</label></td>";
                        break;
                    case 5:
                        echo "<td><label class=\"contro-label block\">En validacion</label></td>";
                        break;
                }            
               
            }

             echo "</table>";
                echo "</div>";
                echo "</div>";
                echo "</div> ";
        
        
    }

    function listaRevConfig($idRevConf){
        
        $sql1 = "SELECT * FROM TAREVCONFIGURACION WHERE idTAREVCONFIGURACION=".$idRevConf;
        $rs = mysqli_query($this->conn, $sql1);
        
        echo "<h2 class=\"margin-bottom-10\">Revision de Configuraciones</h2>";
        
        
        while ($datos = mysqli_fetch_array($rs)) {
            $fabricante = $datos["fabricante"];
            $producto = $datos["producto"];
            $version = $datos["version"];
            $edicion = $datos["edicion"];
            $edicionSoftware = $datos["edicionSoftware"];
            $comentarios = $datos["comentarios"];
            $idRevConf = $datos["idTAREVCONFIGURACION"];
            
            echo "<div class=\"content-widget white-bg\">";
            #echo "<h4 class=\"margin-botton-10\">Tipo de Revision</h4>";
            #echo "<label class=\"contro-label block\">Tipo de Revision</label>";
            echo "<br>";
            
            echo "<div class=\"row form-group\">";
                echo "<div class=\"col-lg-6 col-md-6 form-group\">";
                echo "<label>Fabricante</label>";
                echo "<label class=\"contro-label block\">".$fabricante."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-6 col-md-6 form-group\">";
                echo "<label>Producto</label>";
                echo "<label class=\"contro-label block\">".$producto."</label>";
                echo "</div>";
            echo "</div>";
   
           
            echo "<div class=\"row form-group\">";
                echo "<div class=\"col-lg-6 col-md-6 form-group\">";
                echo "<label>Version</label>";
                echo "<label class=\"contro-label block\">".$version."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-6 col-md-6 form-group\">";
                echo "<label>Edicion</label>";
                echo "<label class=\"contro-label block\">".$edicion."</label>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row form-group\">";
                echo "<div class=\"col-lg-6 col-md-6 form-group\">";
                echo "<label>Edicion de Software</label>";
                echo "<label class=\"contro-label block\">".$edicionSoftware."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-6 col-md-6 form-group\">";
                echo "<label>Comentarios</label>";
                echo "<label class=\"contro-label block\">".$comentarios."</label>";
                echo "</div>";
            echo "</div>";

        }
    }

    function listaRevConfigAndCasosPruebaActivo($idActivo){
        $sql = "SELECT * FROM TAPRUEBASCAP WHERE idActivo=".$idActivo;
        $resu = mysqli_query($this->conn, $sql);
        $info = mysqli_fetch_array($resu);
        $idPrueba = $info["idTAPRUEBASCAP"];
        $tipoPruebaAct = $info["tipoPrueba"];
        
        $sql1 = "SELECT * FROM TAREVCONFIGURACION WHERE idPrueba=".$idPrueba;
        $rs = mysqli_query($this->conn, $sql1);
                
        
        while ($datos = mysqli_fetch_array($rs)) {
            $fabricante = $datos["fabricante"];
            $producto = $datos["producto"];
            $version = $datos["version"];
            $edicion = $datos["edicion"];
            $edicionSoftware = $datos["edicionSoftware"];
            $comentarios = $datos["comentarios"];
            $idRevConf = $datos["idTAREVCONFIGURACION"];
            
            echo "<div class=\"content-widget white-bg\">";
            echo "<center>";
            if($tipoPruebaAct == 1){
                echo "<h2 class=\"margin-bottom-10\">Revision de Configuraciones</h2>";
            } elseif ($tipoPruebaAct == 2) {
                echo "<h2 class=\"margin-bottom-10\">Seguridad y calidad</h2>";
            }
            echo "</center>";
         
            #echo "<label class=\"contro-label block\">Tipo de Revision</label>";
            echo "<br>";
            
            echo "<div class=\"row form-group\">";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Fabricante</label>";
                echo "<label class=\"contro-label block\">".$fabricante."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Producto</label>";
                echo "<label class=\"contro-label block\">".$producto."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Version</label>";
                echo "<label class=\"contro-label block\">".$version."</label>";
                echo "</div>";
            echo "</div>";
   
           
            echo "<div class=\"row form-group\">";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Edicion</label>";
                echo "<label class=\"contro-label block\">".$edicion."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Edicion de Software</label>";
                echo "<label class=\"contro-label block\">".$edicionSoftware."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Comentarios</label>";
                echo "<label class=\"contro-label block\">".$comentarios."</label>";
                echo "</div>";
            echo "</div>";
            
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                echo "<input type='hidden' name='idRevConf' id='idRevConf' value='".$idRevConf."'>";
                echo "<td><button type='submit' name='modificarRevPrueba' id='modificarRevPrueba' class='blue-button'>Modificar Prueba</button></td>";
                echo "</form>";

           echo " <div class=\"content-container\">";
                echo " <h2 class=\"margin-bottom-10\">Casos de prueba</h2>";
                echo "<div class=\"content-widget no-padding\">";
                    
                    echo "<div class=\"panel panel-default table-responsive\">";
                        echo "<table class=\"table table-striped table-bordered user-table\">";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Grupo</a></td>";                                                
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Titulo</a></td>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Descripcion</a></td>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Estatus</a></td>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Modificar Caso de Prueba</a></td>";
                                echo "</tr>";
                            echo "</thead>";
                         

            
            
            $sql2 = "SELECT * FROM TACASOPRUEBACONFSCAP WHERE revConfiguracion=".$idRevConf;
            $res = mysqli_query($this->conn, $sql2);
                while ($datos2 = mysqli_fetch_array($res)) {
                    $grupo = $datos2["grupo"];
                    $titulo = $datos2["titulo"];
                    $descripcion = $datos2["descripcion"];
                    $estatus = $datos2["estatus"];
                    $idCasoPrueba = $datos2["idTACASOPRUEBASCAP"];
                    
                    if(($idCasoPrueba % 2) == 0 ){
                        $idCasoPruebaCom=$idCasoPrueba - 1;

                    }
                    else{
                        $idCasoPruebaCom=$idCasoPrueba + 1;
                    }
                    
                    $sql5 = "SELECT estatus from TACASOPRUEBACONFSCAP WHERE idTACASOPRUEBASCAP = " . $idCasoPruebaCom . "";
                    $rs5 = mysqli_query($this->conn, $sql5);
                    $datos5 = mysqli_fetch_array($rs5);
                    $estatusComp = $datos5["estatus"];

                    if (($idCasoPrueba % 2) == 0) {
                        
                    
                        #echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $grupo. "</td>";
                        echo "<td>" . $titulo. "</td>";
                        echo "<td>" . $descripcion. "</td>";


                        if($estatus=="1" && $estatusComp=="1"){
                            echo "<td><label class=\"contro-label block\">Activo</label></td>";
                            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                            echo "<input type='hidden' name='idCasoPrueba' value='".$idCasoPrueba."'>";
                            echo "<input type='hidden' name='idRevConf' value='".$idRevConf."'>";
                            echo "<td><button type='submit' name='modificaCasoPrueba' onclick='' id='modificaCasoPrueba' class='edit-btn'>Modificar</button></td>";
                            echo "</form>";
                            echo "</tr>";


                        }
                        
                        if(($estatus=="1" && $estatusComp=="2")||($estatus=="2" && $estatusComp=="1")){
                            echo "<td><label class=\"contro-label block\">En proceso</label></td>";
                            echo "<td></td>";

                        }
                        
                        if($estatus=="3"){
                            echo "<td><label class=\"contro-label block\">Terminada</label></td>";
                            echo "<td></td>";

                        }
                        
                        if($estatus=="4"){
                            echo "<td><label class=\"contro-label block\">Rechazada</label></td>";
                            echo "<td></td>";

                        }
                        
                        
                        if($estatus=="5"){
                            echo "<td><label class=\"contro-label block\">En validacion</label></td>";
                            echo "<td></td>";

                        }

                        /*switch ($estatus) {
                            case 1:
                                echo "<td><label class=\"contro-label block\">Activo</label></td>";
                                echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                                echo "<input type='hidden' name='idCasoPrueba' value='".$idCasoPrueba."'>";
                                echo "<input type='hidden' name='idRevConf' value='".$idRevConf."'>";
                                echo "<td><button type='submit' name='modificaCasoPrueba' onclick='' id='modificaCasoPrueba' class='edit-btn'>Modificar</button></td>";
                                echo "</form>";
                                echo "</tr>";
                                break;
                            case 2:
                                echo "<td><label class=\"contro-label block\">En proceso</label></td>";
                                echo "<td></td>";
                                break;
                            case 3:
                                echo "<td><label class=\"contro-label block\">Terminada</label></td>";
                                echo "<td></td>";
                                break;
                            case 4:
                                echo "<td><label class=\"contro-label block\">Rechazada</label></td>";
                                echo "<td></td>";
                                break;
                            case 5:
                                echo "<td><label class=\"contro-label block\">En validacion</label></td>";
                                echo "<td></td>";
                                break;
                        }     */       
                    
                    }
                                       
                }

                echo "</table>";
                echo "</div>";
                echo "</div>";
                
                echo "</div> ";
                echo "</div> ";
                

        }
    }
    
    function listaRevConfigAndCasosPrueba($idPrueba){
        $sql1 = "SELECT * FROM TAREVCONFIGURACION WHERE idPrueba=".$idPrueba;
        $rs = mysqli_query($this->conn, $sql1);
        
        while ($datos = mysqli_fetch_array($rs)) {
            $fabricante = $datos["fabricante"];
            $producto = $datos["producto"];
            $version = $datos["version"];
            $edicion = $datos["edicion"];
            $edicionSoftware = $datos["edicionSoftware"];
            $comentarios = $datos["comentarios"];
            $idRevConf = $datos["idTAREVCONFIGURACION"];
            
            
            
            echo "<center>";
            echo "<h4 class=\"margin-botton-10\">Revisión de configuraciones</h4>";
            #echo "<label class=\"contro-label block\">Revisión de configuraciones</label>";
            echo "</center>";
            echo "<br>";
            
            echo "<div class=\"row form-group\">";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Fabricante</label>";
                echo "<label class=\"contro-label block\">".$fabricante."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Producto</label>";
                echo "<label class=\"contro-label block\">".$producto."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Versión</label>";
                echo "<label class=\"contro-label block\">".$version."</label>";
                echo "</div>";
            echo "</div>";
   
           
            echo "<div class=\"row form-group\">";
                
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Edición</label>";
                echo "<label class=\"contro-label block\">".$edicion."</label>";
                echo "</div>";
                
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Edición de Software</label>";
                echo "<label class=\"contro-label block\">".$edicionSoftware."</label>";
                echo "</div>";
                echo "<div class=\"col-lg-4 col-md-4 form-group\">";
                echo "<label>Comentarios</label>";
                echo "<label class=\"contro-label block\">".$comentarios."</label>";
                echo "</div>";
                
            echo "</div>";
            
        
            
            echo " <div class=\"content-container\">";
                echo " <h2 class=\"margin-bottom-10\">Casos de prueba</h2>";
                echo "<div class=\"content-widget no-padding\">";
                    
                    echo "<div class=\"panel panel-default table-responsive\">";
                        echo "<table class=\"table table-striped table-bordered user-table\">";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Grupo</a></td>";                                                
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Título</a></td>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Descripción</a></td>";
                                    echo "<td><a href=\"\" class=\"white-text sort-by\">Estatus</a></td>";
                                echo "</tr>";
                            echo "</thead>";
            
            $sql2 = "SELECT * FROM TACASOPRUEBACONFSCAP WHERE revConfiguracion=".$idRevConf;
            $res = mysqli_query($this->conn, $sql2);
                while ($datos2 = mysqli_fetch_array($res)) {
                    $grupo = $datos2["grupo"];
                    $titulo = $datos2["titulo"];
                    $descripcion = $datos2["descripcion"];
                    $estatus = $datos2["estatus"];
                    
                    $idCasoPrueba = $datos2["idTACASOPRUEBASCAP"];

                    if (($idCasoPrueba % 2) == 0) {
                     #echo "<tbody>";
                    echo "<tr>";
                    echo "<td>" . $grupo. "</td>";
                    echo "<td>" . $titulo. "</td>";
                    echo "<td>" . $descripcion . "</td>";
                        
                        switch ($estatus) {
                            case 1:
                            echo "<td><label class=\"contro-label block\">Activo</label></td>";
                            break;
                        case 2:
                            echo "<td><label class=\"contro-label block\">En proceso</label></td>";
                            break;
                        case 3:
                            echo "<td><label class=\"contro-label block\">Terminada</label></td>";
                            break;
                        case 4:
                            echo "<td><label class=\"contro-label block\">Rechazada</label></td>";
                            break;
                        case 5:
                            echo "<td><label class=\"contro-label block\">En validacion</label></td>";
                            break;
                        }
                    }
                }
                
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "<br>";
            echo "<hr/>";
            

         
            
        }
    }
    
    function listarActivos() {
        $sql = "SELECT * FROM TAACTIVOSCAP ";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {

            $estatus = $datos["estatus"];
            switch ($estatus) {
                case 1:
                    $estatus = "Activo";
                    breaK;
                case 2:
                    $estatus = "Eliminado";
                    breaK;
                default:
                    $status = "Estatus";
                    breaK;
            }
            
            
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $datos["idTAACTIVOSCAP"] . "</td>";
            echo "<td>" . $datos["nombre"] . "</td>";
            echo "<td>" . $datos["fInicio"]  . "</td>";
            echo "<td>" . $datos["fFin"]  . "</td>";
            echo "<td>Activo</td>";
            
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idActivo' value='" . $datos["idTAACTIVOSCAP"] . "'>";
            echo "<td><button type='submit' name='consultarActivo' id='consultarActivo' class='edit-btn'>Ver información</button></td>";
            echo "</form>";
            
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";
             echo "<input type='hidden' name='idActivo' value='" . $datos["idTAACTIVOSCAP"] . "'>";
             echo "<input type='hidden' name='modificar' value='1'>";
            echo "<td><button type='submit' name='consultarActivo' id='modificarActivo' class='edit-btn'>Modificar activo</button></td>";
            echo "</form>";
            
            echo "<form action='../../controlador/controlador.php' class='login-form' class='login-form' method='post' >";
            echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";
            echo "<input type='hidden' name='idActivo' value='" . $datos["idTAACTIVOSCAP"] . "'>";
            echo "<input type='hidden' name='cerrar' value='1'>";
            echo "<td><button type='submit' name='consultarActivo' id='consultarActivo' class='edit-btn'>Cerrar activo</button></td>";
            echo "</form>";
            
            echo "</tr>";
        }
    }
    
    function listarPruebas($idActivo) {
        $sql = "SELECT * FROM TAPRUEBASCAP WHERE idActivo='".$idActivo."' AND estatus=1";
        
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            
            $finicio = $datos["fInicio"];
            $fFin = $datos["fFin"];
            $fAlta = $datos["fAlta"];
            $metodologia = $datos["metodologia"];
            $tipoPrueba = $datos["tipoPrueba"];
            $estatus = $datos["estatus"];
            
            switch ($tipoPrueba) {
                case 1:
                    $tipoPrueba = "Revision de configuraciones";
                    breaK;
                case 2:
                    $tipoPrueba = "Seguridad y calidad";
                    breaK;
            }
            
            switch ($metodologia) {
                case 1:
                    $metodologia = "OWASP";
                    breaK;
                case 2:
                    $metodologia = "OSSTMM";
                    breaK;
            }
            
            
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $idActivo. "</td>";
            echo "<td>" . $finicio. "</td>";
            echo "<td>" . $fFin . "</td>";
            echo "<td>" . $tipoPrueba . "</td>";
            echo "<td>" . $metodologia . "</td>";
             switch ($estatus) {
                case 1:
                    $estatus = "Activo";
                    breaK;
                case 2:
                    $estatus = "En proceso";
                    breaK;
                case 3:
                    $estatus = "Terminada";
                    breaK;
            }
            echo "<td>" . $estatus . "</td>";
            
            
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idActivo' value='" . $idActivo. "'>";
            echo "<td><button type='submit' name='consultarPruebas' onclick='' id='consultarPruebas' class='edit-btn'>Ver pruebas</button></td>";
            echo "</form>";
     
            
            echo "</tr>";
        }
    }
    

    function listarEstatusPruebas($idActivo) {
        $sql = "SELECT * FROM TAPRUEBASCAP WHERE idActivo='".$idActivo."' AND estatus=1";
        
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            
            $finicio = $datos["fInicio"];
            $fFin = $datos["fFin"];
            $fAlta = $datos["fAlta"];
            $metodologia = $datos["metodologia"];
            $tipoPrueba = $datos["tipoPrueba"];
            $estatus = $datos["estatus"];
            
            switch ($tipoPrueba) {
                case 1:
                    $tipoPrueba = "Revision de configuraciones";
                    breaK;
                case 2:
                    $tipoPrueba = "Seguridad y calidad";
                    breaK;
            }
            
            switch ($metodologia) {
                case 1:
                    $metodologia = "OWASP";
                    breaK;
                case 2:
                    $metodologia = "OSSTMM";
                    breaK;
            }
            
            
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $idActivo. "</td>";
            echo "<td>" . $finicio. "</td>";
            echo "<td>" . $fFin . "</td>";
            echo "<td>" . $tipoPrueba . "</td>";
            echo "<td>" . $metodologia . "</td>";

            switch ($estatus) {
                case 1:
                    $estatus = "Activo";
                    breaK;
                case 2:
                    $estatus = "En proceso";
                    breaK;
                case 3:
                    $estatus = "Terminada";
                    breaK;
            }
            echo "<td>" . $estatus . "</td>";
            
            echo "</tr>";
        }
    }

    
    function consultarActivo($idActivo){
        $sql = "SELECT * FROM TAACTIVOSCAP WHERE idTAACTIVOSCAP = " . $idActivo . "";
        echo $sql;
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        $nombre = $datos["nombre"];
        $fInicio = $datos["fInicio"];
        $fFin = $datos["fFin"];
        $propietarioActivo = $datos["propietarioActivo"];
        $comentarios = $datos["comentarios"];
        $version = $datos["version"];
        $responsable = $datos["responsable"];
        
        return array($nombre,$fInicio,$fFin,$propietarioActivo,$comentarios,$version,$responsable);
        
    }
    
    
    function listarAsignaciones() {
        $sql = "SELECT idCasoPruebaConf FROM TAUSRCONFSCAP WHERE idUSR=".$_SESSION["idUsuario"]."";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) { 
            
            $idCasoPruebaConf= $datos["idCasoPruebaConf"];
            
            $sql2 = "SELECT * FROM TACASOPRUEBACONFSCAP WHERE idTACASOPRUEBASCAP=".$idCasoPruebaConf."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            
            $idTAREVCONFIGURACION = $datos2["revConfiguracion"];
            $titulo = $datos2["titulo"];
            $idEstatus = $datos2["estatus"];
            
            
            $sql2 = "SELECT estatus FROM CATESTATUSCASOPRUEBA WHERE idCATESTATUSPRUEBA=".$idEstatus."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            
            $estatus = $datos2["estatus"];
            
            
            $sql2 = "SELECT idTAREVCONFIGURACION,producto,tipoRevision,idPrueba from TAREVCONFIGURACION WHERE idTAREVCONFIGURACION=".$idTAREVCONFIGURACION."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            
            $idTAREVCONFIGURACION = $datos2["idTAREVCONFIGURACION"];
            $producto = $datos2["producto"];
            $tipoRevision = $datos2["tipoRevision"];
            $idPrueba = $datos2["idPrueba"];
            
            $sql2 = "SELECT revision from CATIPOREVCONFIGURACION WHERE idCATIPOREVCONFIGURACION=".$tipoRevision."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            
            $revision= $datos2["revision"];
            
            $sql2 = "SELECT idACTIVO,tipoPrueba FROM TAPRUEBASCAP WHERE idTAPRUEBASCAP=".$idPrueba."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            
            $idACTIVO = $datos2["idACTIVO"];
            $tipoPrueba = $datos2["tipoPrueba"];
            
            $sql2 = "SELECT tipoPrueba FROM CATTIPOPRUEBA WHERE idCATTIPOPRUEBA=".$tipoPrueba."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            $tipoPrueba= $datos2["tipoPrueba"];
            
            $sql2 = "SELECT nombre from TAACTIVOSCAP WHERE idTAACTIVOSCAP=".$idACTIVO."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            $activo = $datos2["nombre"];

            
            echo "<tbody>";
            echo "<tr>";
            echo "<td>".$activo."</td>";
            echo "<td>".$tipoPrueba."</td>";
             echo "<td>".$revision."</td>";
            echo "<td>".$producto ."</td>";
            echo "<td>".$titulo."</td>";
            echo "<td>".$estatus."</td>";


            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idCasoPrueba' value='" . $idCasoPruebaConf. "'>";
            if($idEstatus==1){
                echo "<td><button type='submit' name='agregarResultado' id='agregarResultado' class='edit-btn'>Evaluar</button></td>";
            }
            else if($idEstatus==4){
                echo "<td><button type='submit' name='editarResultado' id='editarResultado' class='edit-btn'>Editar evaluación</button></td>";
            }
            else{
                echo "<td></td>";
            }
            
            echo "</form>";

            echo "</tr>";
            
            
        }
    }
    
    function consultarRevisionConfiguraciones($idRevConf){
        
        $sql = "SELECT * FROM TAREVCONFIGURACION WHERE idTAREVCONFIGURACION = " . $idRevConf."";
        echo $sql;
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        
        $fabricante = $datos["fabricante"];
        $producto = $datos["producto"];
        $version = $datos["version"];
        $edicion = $datos["edicion"];
        $ediSoft = $datos["edicionSoftware"];
        $comentarios = $datos["comentarios"];
        $tipoRevision = $datos["tipoRevision"];
        
        return array ($fabricante,$producto,$version,$edicion,$ediSoft,$comentarios,$tipoRevision);     
    }

    function consultarCasoPrueba($idCasoPrueba){
        
        $sql = "SELECT * FROM TACASOPRUEBACONFSCAP WHERE idTACASOPRUEBASCAP = " . $idCasoPrueba . "";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        $grupo = $datos["grupo"];
        $titulo = $datos["titulo"];
        $descripcion = $datos["descripcion"];
        $entrada = $datos["entrada"];
        $resultado = $datos["resultado"];
        $informacionComplementaria = $datos["informacionComplementaria"];
        $evidencias = $datos["evidencias"];
        $recomendacion = $datos["recomendacion"];
        $resultadoPrueba = $datos["resultadoPrueba"];
        $comentariosValidador = $datos["comentariosValidador"];
        $contadorRevision= $datos["contadorRevision"];
        
        return array ($grupo,$titulo,$descripcion,$entrada,$resultado,$informacionComplementaria,$evidencias,$recomendacion,$resultadoPrueba,$comentariosValidador,$contadorRevision);      
    }
    
    function validaEstatusCasoPruebaComp($idCasoPrueba){
        
        $sql = "SELECT estatus from TACASOPRUEBACONFSCAP WHERE idTACASOPRUEBASCAP = " . $idCasoPrueba . "";
        $rs = mysqli_query($this->conn, $sql);
        $datos = mysqli_fetch_array($rs);
        $estatus = $datos["estatus"];
        
        return $estatus;
    }
     
    function  registrarResultado($idCasoPrueba,$entrada,$resultado,$infComp,$evidencias,$recomendacion,$resultadoEval,$estatus){
        $banderaUpdate = false;
        $sql = "UPDATE TACASOPRUEBACONFSCAP set entrada = '".$entrada."', resultado = '".$resultado."', informacionComplementaria = '".$infComp."', evidencias ='".$evidencias."', recomendacion='".$recomendacion."', resultadoPrueba='".$resultadoEval."', fMod=NOW(), estatus=".$estatus." WHERE idTACASOPRUEBASCAP=" . $idCasoPrueba . "";
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
        
    }
    
    function  modificarResultado($idCasoPrueba,$entrada,$resultado,$infComp,$evidencias,$recomendacion,$resultadoEval,$estatus,$comentario,$contador){
        $banderaUpdate = false;
        $sql = "UPDATE TACASOPRUEBACONFSCAP set entrada = '".$entrada."', resultado = '".$resultado."', informacionComplementaria = '".$infComp."', evidencias ='".$evidencias."', recomendacion='".$recomendacion."', resultadoPrueba='".$resultadoEval."', fMod=NOW(), estatus=".$estatus.", comentariosValidador='".$comentario."', contadorRevision=".$contador." WHERE idTACASOPRUEBASCAP=" . $idCasoPrueba . "";
        echo $sql ;
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
        
    }
    
    function  actualizaEstatusCom($idCasoPrueba,$estatus){
        $banderaUpdate = false;
        $sql = "UPDATE TACASOPRUEBACONFSCAP SET estatus = ".$estatus." WHERE idTACASOPRUEBASCAP = ".$idCasoPrueba."";
        
        echo $sql;
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
        
    }

    function cerrarActivo($idActivo){
        $banderaInsert = false;
        $sql = "SELECT estatus FROM TAPRUEBASCAP  WHERE idActivo =".$idActivo;
        
        if ($rs = mysqli_query($this->conn, $sql)) {
            
            $datos = mysqli_fetch_array($rs);
            $estatus = $datos["estatus"];

            if ($estatus == 3) {
                $sql1 = "UPDATE TAACTIVOSCAP SET estatus=".$estatus." WHERE idTAACTIVOSCAP=".$idActivo;
                echo $sql1;
                if (mysqli_query($this->conn, $sql1)) {
                    $banderaInsert = true;
                }
            }
            
        }
        return $banderaInsert;
    }

    function actualizaActivo($fechaIni, $fechaFin, $idActivo){
        $banderaInsert = false;
        $sql = "UPDATE TAACTIVOSCAP SET fInicio=CAST('".$fechaIni."' AS DATETIME), fFin=CAST('".$fechaFin."' AS DATETIME) WHERE idTAACTIVOSCAP=".$idActivo;
        echo $sql;
        if ($rs = mysqli_query($this->conn, $sql)) {
            
             $banderaInsert = true;
            
        }
        return $banderaInsert;
    }

// VALIDADOR
    function listarActivosAsignados($idUsuario) {       
        $sql = "select DISTINCT P.idTAPRUEBASCAP,AC.idTAACTIVOSCAP, P.tipoPrueba as idTipoPrueba, AC.nombre, TP.tipoPrueba, CEP.estatus, CM.metodologia from TAACTIVOSCAP AC".
                " inner join TAPRUEBASCAP P on P.idActivo = AC.idTAACTIVOSCAP".
                " inner join CATESTATUSCASOPRUEBA CEP on CEP.idCATESTATUSPRUEBA = P.estatus".
                " inner join CATTIPOPRUEBA TP on TP.idCATTIPOPRUEBA = P.tipoPrueba".
                " INNER JOIN TAUSRSCAP_TAPRUEBASCAP UP on UP.idPrueba = P.idTAPRUEBASCAP".
                " inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia".
                " inner join TAUSRSCAP US on US.idTAUSRSCAP = UP.idUSR".
                " where US.idTAUSRSCAP = ".$idUsuario.";";

        #echo $sql;
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {            
            
            echo "<tbody>";
            echo "<tr>";
            
            echo "<td>" . $datos["nombre"] . "</td>";
            echo "<td>" . $datos["tipoPrueba"]  . "</td>";
            echo "<td>" . $datos["metodologia"]  . "</td>";
            echo "<td>".$datos["estatus"]."</td>";
            #echo "<td>1</td>";
            #echo $datos["TipoPrueba"];
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idActivo' value='" . $datos["idTAACTIVOSCAP"] . "'>";
            echo "<input type='hidden' name='idUsuario' value='" . $idUsuario . "'>";
            echo "<input type='hidden' name='idTipoPrueba' value='" . $datos["idTipoPrueba"] . "'>";
            echo "<td><button type='submit' name='consultarPruebasVal' id='consultarPruebasVal' class='edit-btn'>Ver Resultados</button></td>";
            echo "</form>";          
            echo "</tr>";
        }        
    }

    function listarPruebasActivos($idUsuario, $idActivo) {       
        $sql = "select * from TAPRUEBASCAP P
                inner join TAACTIVOSCAP AC on AC.idTAACTIVOSCAP = P.idActivo
                inner join TAUSRSCAP_TAPRUEBASCAP UP on UP.idPrueba = P.idTAPRUEBASCAP

                inner join CATTIPOPRUEBA TP on TP.idCATTIPOPRUEBA = P.tipoPrueba
                inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia
                inner join CATESTATUSPRUEBA CEP on CEP.idCATESTATUSPRUEBA = P.estatus
                where UP.idUSR = ".$idUsuario." and AC.idTAACTIVOSCAP = ".$idActivo.";";
                

        #echo $sql;
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {            
            
            echo "<tbody>";
            echo "<tr>";       
            echo "<td>" . $datos["tipoPrueba"]  . "</td>";
            echo "<td>" . $datos["metodologia"]  . "</td>";
            echo "<td>" . $datos["fInicio"]  . "</td>";
            echo "<td>" . $datos["fFin"]  . "</td>";
            echo "<td>".$datos["estatus"]."</td>";
            #echo "<td>1</td>";
            #echo $datos["TipoPrueba"];
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idActivo' value='" . $idActivo. "'>";
            echo "<input type='hidden' name='idPrueba' value='" . $datos["idTAPRUEBASCAP"] . "'>";
            echo "<input type='hidden' name='idTipoPrueba' value='" . $datos["idCATTIPOPRUEBA"]. "'>";
            echo "<input type='hidden' name='idUsuario' value='" . $idUsuario . "'>";
            echo "<td><button type='submit' name='consultarCasosPrueba' id='consultarCasosPrueba' class='edit-btn'>Ver Resultados</button></td>";
            echo "</form>";          
            echo "</tr>";
        }        
    }

    function listarCasosDePrueba($idUsuario, $idActivo, $idTipoPrueba) {
        
        switch($idTipoPrueba){
                case 1:
                        $sql = "select *, ECP.estatus as Estatus from TAREVCONFIGURACION RC 
                            inner join TAPRUEBASCAP P on P.idTAPRUEBASCAP = RC.idPrueba 
                            inner join TAACTIVOSCAP AC on AC.idTAACTIVOSCAP = P.idActivo 
                            inner join TAUSRSCAP_TAPRUEBASCAP UV on UV.idPrueba = P.idTAPRUEBASCAP 

                            inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia
                            inner join CATESTATUSCASOPRUEBA ECP ON ECP.idCATESTATUSPRUEBA = P.estatus
                            where AC.idTAACTIVOSCAP = ".$idActivo." and UV.idUSR= ".$idUsuario." ;";
                        
                break;
                case 2:
                        $sql = "select DISTINCT P.idTAPRUEBASCAP, TP.nombreTipo, CM.metodologia, ECP.estatus as Estatus, SC.contadorRevision as Revision from TASEGCALSCAP SC 
                            inner join TAPRUEBASCAP P on P.idTAPRUEBASCAP = SC.idPrueba
                            inner join TAACTIVOSCAP AC on AC.idTAACTIVOSCAP = P.idActivo
                            inner join TAUSRSCAP_TAPRUEBASCAP UV on UV.idPrueba = P.idTAPRUEBASCAP

                            inner join CATTIPOSCAP TP on TP.idCATTIPOSCAP = SC.idTipo
                            inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia
                            inner join CATESTATUSCASOPRUEBA ECP ON ECP.idCATESTATUSPRUEBA = P.estatus
                            where AC.idTAACTIVOSCAP =".$idActivo." and UV.idUSR = ".$idUsuario.";";
                break;
                default:
                        $sql = "select DISTINCT P.idTAPRUEBASCAP, TP.nombreTipo, CM.metodologia, ECP.estatus as Estatus, SC.contadorRevision as Revision from TASEGCALSCAP SC 
                            inner join TAPRUEBASCAP P on P.idTAPRUEBASCAP = SC.idPrueba
                            inner join TAACTIVOSCAP AC on AC.idTAACTIVOSCAP = P.idActivo
                            inner join TAUSRSCAP_TAPRUEBASCAP UV on UV.idPrueba = P.idTAPRUEBASCAP

                            inner join CATTIPOSCAP TP on TP.idCATTIPOSCAP = SC.idTipo
                            inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia
                            inner join CATESTATUSCASOPRUEBA ECP ON ECP.idCATESTATUSPRUEBA = P.estatus
                            where AC.idTAACTIVOSCAP =".$idActivo." and UV.idUSR = ".$idUsuario.";";
                break;
                }

        #echo $sql;
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {            
            
            switch($idTipoPrueba){
                case 1:
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $datos["idTAPRUEBASCAP"] . "</td>";            
                        echo "<td>" . $datos["producto"]  . "</td>";
                        echo "<td>" . $datos["metodologia"]  . "</td>";
                       #echo "<td>" . $datos["version"]  . "</td>";                        
                        echo "<td>" . $datos["Estatus"]."</td>";
                        #echo "<td>1</td>";
                        #echo $datos["TipoPrueba"];
                        echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                        echo "<input type='hidden' name='idActivo' value='" . $idActivo. "'>";
                        echo "<input type='hidden' name='idPrueba' value='" . $datos["idPrueba"] . "'>";
                        echo "<input type='hidden' name='idTipoPrueba' value='" . $idTipoPrueba . "'>";
                        echo "<input type='hidden' name='idUsuario' value='" . $idUsuario . "'>";
                        echo "<input type='hidden' name='idRefConf' value='" . $datos["idTAREVCONFIGURACION"] . "'>";
                        echo "<td><button type='submit' name='consultarResultados' id='consultarResultados' class='edit-btn'>Ver Resultados</button></td>";
                        echo "</form>";          
                        echo "</tr>";
                break;
                case 2:
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $datos["idTAPRUEBASCAP"] . "</td>";            
                        echo "<td>" . $datos["nombreTipo"]  . "</td>";
                        echo "<td>" . $datos["metodologia"]  . "</td>";
                        #echo "<td>" . $datos["Revision"]  . "</td>";                        
                        echo "<td>" . $datos["Estatus"]."</td>";
                        #echo "<td>1</td>";
                        #echo $datos["TipoPrueba"];
                        echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                        echo "<input type='hidden' name='idActivo' value='" . $idActivo. "'>";
                        echo "<input type='hidden' name='idPrueba' value='" . $idPrueba . "'>";
                        echo "<input type='hidden' name='idTipoPrueba' value='" . $idTipoPrueba . "'>";
                        echo "<input type='hidden' name='idUsuario' value='" . $idUsuario . "'>";
                        echo "<td><button type='submit' name='consultarResultados' id='consultarResultados' class='edit-btn'>Ver Resultados</button></td>";
                        echo "</form>";          
                        echo "</tr>";
                break;
                default:
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $datos["idTAPRUEBASCAP"] . "</td>";            
                        echo "<td>" . $datos["nombreTipo"]  . "</td>";
                        echo "<td>" . $datos["metodologia"]  . "</td>";
                        #echo "<td>" . $datos["Revision"]  . "</td>";                        
                        echo "<td>" . $datos["Estatus"]."</td>";
                        #echo "<td>1</td>";
                        #echo $datos["TipoPrueba"];
                        echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                        echo "<input type='hidden' name='idActivo' value='" . $idActivo. "'>";
                        echo "<input type='hidden' name='idPrueba' value='" . $idPrueba . "'>";
                        echo "<input type='hidden' name='idTipoPrueba' value='" . $idTipoPrueba . "'>";
                        echo "<input type='hidden' name='idUsuario' value='" . $idUsuario . "'>";
                        echo "<td><button type='submit' name='consultarResultados' id='consultarResultados' class='edit-btn'>Ver Resultados</button></td>";
                        echo "</form>";          
                        echo "</tr>";
                break;
        }
        }

    }

    function listarResultadosEvaluadores($idUsuario, $idActivo, $idTipoPrueba, $idPrueba, $idRevConf) {
        $casos = [];
        switch($idTipoPrueba){
            case 1:
                $sql = "select *, ECP.estatus as Estatus, RC.version as Version from TACASOPRUEBACONFSCAP CPC 
                        inner join TAREVCONFIGURACION RC on RC.idTAREVCONFIGURACION = CPC.revConfiguracion
                        inner join TAPRUEBASCAP P on P.idTAPRUEBASCAP = RC.idPrueba
                        inner join TAACTIVOSCAP AC on AC.idTAACTIVOSCAP = P.idActivo
                        inner join TAUSRSCAP_TAPRUEBASCAP UV on UV.idPrueba = P.idTAPRUEBASCAP
                        inner join TAUSRCONFSCAP UC on UC.idCasoPruebaConf= CPC.idTACASOPRUEBASCAP
                        inner join TAUSRSCAP US on US.idTAUSRSCAP = UC.idUSR

                        inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia
                        inner join CATESTATUSCASOPRUEBA ECP ON ECP.idCATESTATUSPRUEBA = CPC.estatus

                        where AC.idTAACTIVOSCAP = ".$idActivo." and P.idTAPRUEBASCAP = ".$idPrueba." and UV.idUSR = ".$idUsuario." and CPC.estatus in (5) and CPC.contadorRevision <=3 AND idTAREVCONFIGURACION = ".$idRevConf.";";                
            break;
            case 2:
                $sql = "
                        select *, ECP.estatus as Estatus from TASEGCALSCAP SC 
                        inner join TAPRUEBASCAP P on P.idTAPRUEBASCAP = SC.idPrueba
                        inner join TAACTIVOSCAP AC on AC.idTAACTIVOSCAP = P.idActivo
                        inner join TAUSRSCAP_TAPRUEBASCAP UV on UV.idPrueba = P.idTAPRUEBASCAP
                        inner join TAUSRSCSCAP USC on USC.idCasoPruebaSC = SC.idTASEGCALSCAP
                        inner join TAUSRSCAP US on US.idTAUSRSCAP = USC.idUSR
                        inner join TADETECCSCAP D on D.idSegCal = SC.idTASEGCALSCAP
                        left join TAREFERSCAP REF on REF.idDeteccion = D.idTADETECCSCAP
                        left join TADIAGSCAP DIA on DIA.idSegCal = SC.idTASEGCALSCAP


                        inner join CATTIPOSCAP TP on TP.idCATTIPOSCAP = SC.idTipo
                        inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia
                        inner join CATESTATUSCASOPRUEBA ECP ON ECP.idCATESTATUSPRUEBA = SC.estatus
                        inner join CATTIPOPRUEBA TPP on TPP.idCATTIPOPRUEBA = P.tipoPrueba
                        INNER JOIN CATSEVERSQSCAP SSQ on SSQ.idCATSEVERSQSCAP = D.idSeveridadSQ
                        inner join CATTIPOAMESCAP TAM on TAM.idCATTIPOAMESCAP = D.idTipoAmenaza
                        inner join CATCATESCAP CA on CA.idCATCATESCAP = D.idCategoria
                        inner join CATTIPOSCAP TS ON TS.idCATTIPOSCAP = SC.idTipo

                        where AC.idTAACTIVOSCAP = ".$idActivo." and P.idTAPRUEBASCAP = ".$idPrueba." and UV.idUSR = ".$idUsuario." and SC.contadorRevision <=3 and SC.estatus in (1,2);";
                        
            break;
            default:
                $sql = "
                        select *, ECP.estatus as Estatus from TASEGCALSCAP SC 
                        inner join TAPRUEBASCAP P on P.idTAPRUEBASCAP = SC.idPrueba
                        inner join TAACTIVOSCAP AC on AC.idTAACTIVOSCAP = P.idActivo
                        inner join TAUSRSCAP_TAPRUEBASCAP UV on UV.idPrueba = P.idTAPRUEBASCAP
                        inner join TAUSRSCSCAP USC on USC.idCasoPruebaSC = SC.idTASEGCALSCAP
                        inner join TAUSRSCAP US on US.idTAUSRSCAP = USC.idUSR
                        inner join TADETECCSCAP D on D.idSegCal = SC.idTASEGCALSCAP
                        left join TAREFERSCAP REF on REF.idDeteccion = D.idTADETECCSCAP
                        left join TADIAGSCAP DIA on DIA.idSegCal = SC.idTASEGCALSCAP


                        inner join CATTIPOSCAP TP on TP.idCATTIPOSCAP = SC.idTipo
                        inner join CATMETODOLOGIA CM on CM.idCATMETODOLOGIA = P.metodologia
                        inner join CATESTATUSCASOPRUEBA ECP ON ECP.idCATESTATUSPRUEBA = SC.estatus
                        inner join CATTIPOPRUEBA TPP on TPP.idCATTIPOPRUEBA = P.tipoPrueba
                        INNER JOIN CATSEVERSQSCAP SSQ on SSQ.idCATSEVERSQSCAP = D.idSeveridadSQ
                        inner join CATTIPOAMESCAP TAM on TAM.idCATTIPOAMESCAP = D.idTipoAmenaza
                        inner join CATCATESCAP CA on CA.idCATCATESCAP = D.idCategoria
                        inner join CATTIPOSCAP TS ON TS.idCATTIPOSCAP = SC.idTipo

                        where AC.idTAACTIVOSCAP = ".$idActivo." and P.idTAPRUEBASCAP = ".$idPrueba." and UV.idUSR = ".$idUsuario." and SC.contadorRevision <=3 and SC.estatus in (1,2);";
            break;
        }
                    
                    
        #echo $sql;
        $rs = mysqli_query($this->conn, $sql);            
                
        if(mysqli_num_rows($rs) == 0){
            echo '<h2 class="margin-bottom-10"> Ningun registro por validar</h2>';
            $cont = 1;
            echo '<div class="content-widget white-bg">';
            while($cont <= 2){
                
                echo '<table class="table table-striped table-bordered user-table">';
                    echo '<thead>';
                        echo '<tr>';
                            switch($idTipoPrueba){
                                case 1:
                                    echo '<td><a href="" class="white-text sort-by">ID </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Evaluador</a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Fabricante </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Producto </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Version </a></td>';
                                    #echo '<td><a href="" class="white-text sort-by">Edicion</a></td>';                  
                                    echo '<td><a href="" class="white-text sort-by">Estatus</a></td>';
                                break;
                                case 2:
                                    echo '<td><a href="" class="white-text sort-by">ID </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Evaluador</a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Amenaza </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Categoria </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Severidad </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Detalles</a></td>';                  
                                    echo '<td><a href="" class="white-text sort-by">Estatus</a></td>';
                                break;
                                default:
                                    echo '<td><a href="" class="white-text sort-by">ID </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Evaluador</a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Amenaza </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Categoria </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Severidad </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Detalles</a></td>';                  
                                    echo '<td><a href="" class="white-text sort-by">Estatus</a></td>';
                                break;
                            }
                        echo '</tr>';
                    echo '</thead>';
                echo "<tbody>";

                switch($idTipoPrueba){   
                    case 1:                                          
                        echo "<tr>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        #echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "</tr>";
                    break;
                    case 2:              
                        echo "<tr>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "</tr>";
                    break;
                    default:              
                        echo "<tr>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        echo "</tr>";
                    break;
                }
                $cont++;
            }
            echo '</table>';
            echo '</div>';
        }else{            
            #echo 'CONTADOR '.mysqli_num_rows($rs);
            while($datos = mysqli_fetch_array($rs)) {
            echo $datos["idTACASOPRUEBASCAP"];
            #for($i=1; $i<=mysqli_num_rows($rs); $i+=2){
            if($datos["idTACASOPRUEBASCAP"]%2 != 0){
                #echo $i;
                
                switch($idTipoPrueba){
                    case 1:
                        $id = $datos["idTACASOPRUEBASCAP"];
                    break;
                    case 2:
                        $id = $datos["idTASEGCALSCAP"];
                    break;
                    default:
                        $id = $datos["idTASEGCALSCAP"];
                    break;
                }   

                array_push($casos, $id);                                
                echo '<div class="content-widget white-bg">';
                echo '<table class="table table-striped table-bordered user-table">';
                    echo '<thead>';
                        echo '<tr>';
                            switch($idTipoPrueba){
                                case 1:
                                    echo '<td><a href="" class="white-text sort-by">ID </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Evaluador</a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Fabricante </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Producto </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Version </a></td>';
                                    #echo '<td><a href="" class="white-text sort-by">Edicion</a></td>';                  
                                    echo '<td><a href="" class="white-text sort-by">Estatus</a></td>';
                                break;
                                case 2:
                                    echo '<td><a href="" class="white-text sort-by">ID </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Evaluador</a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Amenaza </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Categoria </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Severidad </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Detalles</a></td>';                  
                                    echo '<td><a href="" class="white-text sort-by">Estatus</a></td>';
                                break;
                                default:
                                    echo '<td><a href="" class="white-text sort-by">ID </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Evaluador</a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Amenaza </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Categoria </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Severidad </a></td>';
                                    echo '<td><a href="" class="white-text sort-by">Detalles</a></td>';                  
                                    echo '<td><a href="" class="white-text sort-by">Estatus</a></td>';
                                break;
                            }
                        echo '</tr>';
                    echo '</thead>';
                echo "<tbody>";
                switch($idTipoPrueba){   
                    case 1:
                        #echo $datos["idSegCal"];  
                        #$idTipoPrueba = $datos["idCATTIPOPRUEBA"];
                        #echo  $datos["idTASEGCALSCAP"];                    
                        echo "<tr>";
                        echo "<td>" . $datos["idTACASOPRUEBASCAP"] . "</td>";
                        #echo "<td>" . $datos["nombreActivo"] . "</td>";
                        echo "<td>" . $datos["nombre"] . "</td>";
                        echo "<td>" . $datos["fabricante"] . "</td>";
                        echo "<td>" . $datos["producto"]  . "</td>";
                        echo "<td>" . $datos["Version"]  . "</td>";                                
                        echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";   
                        #echo "<td><button type='submit' name='detalleDeteccion' id='detalleDeteccion' class='edit-btn'>Ver</button></td>";
                        echo "<td>" . $datos["Estatus"]  . "</td>";
                        #echo "<td><button type='submit' name='rechazarCasoPrueba' id='rechazarCasoPrueba' class='edit-btn'>Rechazar</button></td>";
                        echo "</form>"; 
                        echo "</tr>";

                        $sql2 = "SELECT *, ECP.estatus as Estatus FROM TACASOPRUEBACONFSCAP CPC
                                 inner join TAREVCONFIGURACION RC on RC.idTAREVCONFIGURACION = CPC.revConfiguracion 
                                 inner join TAUSRCONFSCAP UC on UC.idCasoPruebaConf = CPC.idTACASOPRUEBASCAP
                                    inner join TAUSRSCAP US on US.idTAUSRSCAP = UC.idUSR
                                    inner join TAPRUEBASCAP P on P.idTAPRUEBASCAP = RC.idPrueba
                                inner join CATESTATUSCASOPRUEBA ECP ON ECP.idCATESTATUSPRUEBA = CPC.estatus 
                                 WHERE revConfiguracion=".$idRevConf." and idTACASOPRUEBASCAP = (".$datos["idTACASOPRUEBASCAP"]." + 1) and CPC.estatus = 5;";
                        $res = mysqli_query($this->conn, $sql2);
                        #echo $sql2;
                        $datos2 = mysqli_fetch_array($res);
                        echo "<tr>";
                        echo "<td>" . $datos2["idTACASOPRUEBASCAP"] . "</td>";
                        #echo "<td>" . $datos["nombreActivo"] . "</td>";
                        echo "<td>" . $datos2["nombre"] . "</td>";
                        echo "<td>" . $datos2["fabricante"] . "</td>";
                        echo "<td>" . $datos2["producto"]  . "</td>";
                        echo "<td>" . $datos2["version"]  . "</td>";                                
                        echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";   
                        #echo "<td><button type='submit' name='detalleDeteccion' id='detalleDeteccion' class='edit-btn'>Ver</button></td>";
                        echo "<td>" . $datos2["Estatus"]  . "</td>";
                        #echo "<td><button type='submit' name='rechazarCasoPrueba' id='rechazarCasoPrueba' class='edit-btn'>Rechazar</button></td>";
                        echo "</form>"; 
                        echo "</tr>";
                    break;
                    case 2:
                        #echo $datos["idSegCal"];  
                        #$idTipoPrueba = $datos["c"];
                        #echo  $datos["idTASEGCALSCAP"];
                        #array_push($casos, $datos["idTASEGCALSCAP"]);                
                        echo "<tr>";
                        echo "<td>" . $datos["idTASEGCALSCAP"] . "</td>";
                        #echo "<td>" . $datos["nombreActivo"] . "</td>";
                        echo "<td>" . $datos["nombre"] . "</td>";
                        echo "<td>" . $datos["nombreAmenaza"] . "</td>";
                        echo "<td>" . $datos["nombreCategoria"]  . "</td>";
                        echo "<td>" . $datos["nombreSeveridad"]  . "</td>";                                
                        echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";   
                        echo "<td><button type='submit' name='detalleDeteccion' id='detalleDeteccion' class='edit-btn'>Ver</button></td>";
                        echo "<td>" . $datos["Estatus"]  . "</td>";
                        #echo "<td><button type='submit' name='rechazarCasoPrueba' id='rechazarCasoPrueba' class='edit-btn'>Rechazar</button></td>";
                        echo "</form>"; 
                        echo "</tr>";
                    break;
                    default:
                        #echo $datos["idSegCal"];  
                        #$idTipoPrueba = $datos["idCATTIPOPRUEBA"];
                        #echo  $datos["idTASEGCALSCAP"];
                        #array_push($casos, $datos["idTASEGCALSCAP"]);                
                        echo "<tr>";
                        echo "<td>" . $datos["idTASEGCALSCAP"] . "</td>";
                        #echo "<td>" . $datos["nombreActivo"] . "</td>";
                        echo "<td>" . $datos["nombre"] . "</td>";
                        echo "<td>" . $datos["nombreAmenaza"] . "</td>";
                        echo "<td>" . $datos["nombreCategoria"]  . "</td>";
                        echo "<td>" . $datos["nombreSeveridad"]  . "</td>";                                
                        echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";   
                        echo "<td><button type='submit' name='detalleDeteccion' id='detalleDeteccion' class='edit-btn'>Ver</button></td>";
                        #echo "<td>" . $datos["Estatus"]  . "</td>";
                        echo "</form>"; 
                        echo "</tr>";
                    break;
                }
                            
                echo '</table>';
                echo '</div>';

                echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";                   
                    echo '<div class="form-group text-right"><br/>';
                    #echo "<td><button type='submit' class='blue-button' name='validarCasoPrueba' id='validarCasoPrueba' class='edit-btn'>Validar</button></td>&nbsp;";
                    #echo $datos["idTACASOPRUEBASCAP"];
                    echo "<input type='hidden' name='idEval' value='" . $datos["idTACASOPRUEBASCAP"] . "'>";
                    echo "<td><button type='submit' class='blue-button' name='verResultadoDetalle' id='verResultadoDetalle' class='edit-btn'>Ver Resultados</button></td>";
                echo '</div>';
                echo "</form>";
            }             
        }  


        
        $_SESSION["CasosPrueba"] = $casos;
        $_SESSION["tipoPrueba"] = $idTipoPrueba; 

        }       
    }

    function rechazarResultados($elem, $tipoPrueba, $comentario){
        
        $tabla = '';
        $campo = '';
        $banderaUpdate = false;

        switch ($tipoPrueba) {
                case 1:
                    $tabla = "TACASOPRUEBACONFSCAP";
                    $campo = "idTACASOPRUEBASCAP";
                    break;
                case 2:                    
                    $tabla = "TASEGCALSCAP";
                    $campo = "idTASEGCALSCAP";
                    break;
                default:
                    $tabla = "TASEGCALSCAP";
                    $campo = "idTASEGCALSCAP";
                    break;
            }

            
        #foreach($listaCasosPrueba as $elem){    
            $sqlC = "select contadorRevision from ".$tabla." where ".$campo."=".$elem.";";     
            $rs = mysqli_query($this->conn, $sqlC);
            $datos = mysqli_fetch_array($rs);            

            $sql = "UPDATE ".$tabla." SET estatus = 4, contadorRevision = (".$datos["contadorRevision"]."+1), comentariosValidador = '".$comentario."' where ".$campo."=".$elem.";";
            #echo $sql;
            if (mysqli_query($this->conn, $sql)) {
                $banderaUpdate = true;
            }            
        #}

        return $banderaUpdate;
    }

    function validarResultados($elem, $tipoPrueba){
        
        $tabla = '';
        $campo = '';
        $banderaUpdate = false;
        #echo $tipoPrueba;
        switch ($tipoPrueba) {
                case 1:
                    $tabla = "TACASOPRUEBACONFSCAP";
                    $campo = "idTACASOPRUEBASCAP";
                    break;
                case 2:                    
                    $tabla = "TASEGCALSCAP";
                    $campo = "idTASEGCALSCAP";
                    break;
                default:
                    $tabla = "TASEGCALSCAP";
                    $campo = "idTASEGCALSCAP";
                    break;
            }

            
        #foreach($listaCasosPrueba as $elem){            
            $sql = "UPDATE ".$tabla." SET estatus = 3 where ".$campo."=".$elem.";";
            #echo $sql;
            if (mysqli_query($this->conn, $sql)) {
                $banderaUpdate = true;
            }            
        #}

        return $banderaUpdate;
    }

    function resultadosDetalle($idRes){

       $sql ="SELECT * FROM TACASOPRUEBACONFSCAP WHERE idTACASOPRUEBASCAP = ".$idRes.";";
       $rs = mysqli_query($this->conn, $sql);
       $datos = mysqli_fetch_array($rs);


       $_SESSION["ID1"] = $idRes;
       $_SESSION["entrada1"] = $datos["entrada"];
       $_SESSION["resultado1"] = $datos["resultado"];
       $_SESSION["infoComp1"]= $datos["informacionComplementaria"];
       $_SESSION["eviden1"] = $datos["evidencias"];
       $_SESSION["recom1"] = $datos["recomendacion"];
       $_SESSION["res1"] = $datos["resultadoPrueba"];

       $sql2 ="SELECT * FROM TACASOPRUEBACONFSCAP WHERE idTACASOPRUEBASCAP = (".$idRes." + 1);";
       $rs2 = mysqli_query($this->conn, $sql2);
       $datos2 = mysqli_fetch_array($rs2);      

       $idNext = $idRes +1;
       $_SESSION["ID2"] = $idNext;
       $_SESSION["entrada2"] = $datos2["entrada"];
       $_SESSION["resultado2"] = $datos2["resultado"];
       $_SESSION["infoComp2"]= $datos2["informacionComplementaria"];
       $_SESSION["eviden2"] = $datos2["evidencias"];
       $_SESSION["recom2"] = $datos2["recomendacion"];
       $_SESSION["res2"] = $datos["resultadoPrueba"];


    }
//VALIDADOR    

    
    function agregaPruebaSegCtrl($idPrueba, $idEvaluador){
        $banderaInsert = false;
        $value = 1;
        $sql = "INSERT INTO TASEGCALSCAP (idPrueba, idTipo, estatus, contadorRevision) VALUES (".$idPrueba.",".$value.",".$value.", 0)";
        echo $sql;
        if (mysqli_query($this->conn, $sql)) {
            $idCasoPruebaSC = mysqli_insert_id($this->conn);
            $sql1 = "INSERT INTO TAUSRSCSCAP (idUSR, idCasoPruebaSC) VALUES (".$idEvaluador.",".$idCasoPruebaSC.")";
            echo $sql1;
            if (mysqli_query($this->conn, $sql1)) {
                $banderaInsert = true;
            }
        }    
        return $banderaInsert;
    }

    

/* seguridad y calidad*/
    function listarAsignacionesCodigo() {
        $sql = "SELECT idCasoPruebaSC from TAUSRSCSCAP WHERE idUSR=".$_SESSION["idUsuario"]."";

        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {          
            
            $idPrueba = $datos["idCasoPruebaSC"];
            //echo "idprueba: ".$idPrueba." <br>";
            $sql2 = "SELECT idPrueba,idTipo FROM tasegcalscap WHERE idTASEGCALSCAP=".$idPrueba."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            $idPrueba = $datos2["idPrueba"];
            $tipoPrueba = $datos2["idTipo"];

            $sql2 = "SELECT idACTIVO,tipoPrueba FROM TAPRUEBASCAP WHERE idTAPRUEBASCAP=".$idPrueba."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            $idACTIVO = $datos2["idACTIVO"];
            $tipoPrueba = $datos2["tipoPrueba"];

            //echo "idACTIVO: ".$idACTIVO." <br>";
            //echo "tipoPrueba2: ".$tipoPrueba." <br>";
            if($tipoPrueba == 2){
                $sql2 = "SELECT tipoPrueba FROM CATTIPOPRUEBA WHERE idCATTIPOPRUEBA=".$tipoPrueba."";
                $rs2 = mysqli_query($this->conn, $sql2);
                $datos2 = mysqli_fetch_array($rs2);
                $tipoPrueba= $datos2["tipoPrueba"];
                //echo "tipoPrueba3: ".$tipoPrueba." <br>";
                
                $sql2 = "SELECT nombre from TAACTIVOSCAP WHERE idTAACTIVOSCAP=".$idACTIVO."";
                $rs2 = mysqli_query($this->conn, $sql2);
                $datos2 = mysqli_fetch_array($rs2);
                $activo = $datos2["nombre"];
                //echo "idactivo2: ".$activo." <br>";
                
                //DE AQUI ARMANDOs
                //if()
                $sql2 = "SELECT fInicio,fFin,metodologia,estatus from TAPRUEBASCAP WHERE idTAPRUEBASCAP=".$idPrueba."";
                //echo $sql2;
                $rs2 = mysqli_query($this->conn, $sql2);
                while ($datos3 = mysqli_fetch_array($rs2)) { 

                    $estatus = $datos3["estatus"];
                        if($estatus==1 || $estatus==4){
                            switch ($estatus) {
                                case 1:
                                    $estatus = "Activo";
                                    breaK;
                                case 2:
                                    $estatus = "En proceso";
                                    breaK;
                                case 3:
                                    $estatus = "Terminada";
                                    breaK;
                                case 4:
                                    $estatus = "Rechazada";
                                    breaK;
                                case 5:
                                    $estatus = "En validación";
                                    breaK;
                                default:
                                    $status = "Estatus";
                                    breaK;
                            }
                            $metodologia = $datos3["metodologia"];
                            switch ($metodologia) {
                                case 1:
                                    $metodologia = "OWASP";
                                    breaK;
                                case 2:
                                    $metodologia = "OSSTMM";
                                    breaK;
                                default:
                                    $metodologia = "--";
                                    breaK;
                            }
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $activo . "</td>";
                            echo "<td>" . $tipoPrueba . "</td>";
                            echo "<td>" . $metodologia  . "</td>";
                            echo "<td>" . $datos3["fInicio"]  . "</td>";
                            echo "<td>" . $datos3["fFin"]  . "</td>";
                            echo "<td>" . $estatus  . "</td>";


                            echo "<form class='login-form' method='post' action='../../controlador/controlador.php'>";
                            echo "<input type='hidden' name='idPrueba' value='" . $idPrueba . "'>";
                            echo "<td><button type='submit' name='initEval' id='initEval' class='edit-btn'>Evaluar</button></td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                }
            }
            
        }
    }

    function listarCasoPruebas() {
        //echo "sfhdhsfshf";
        //echo $_SESSION["idPrueba"];

        $sql = "SELECT idCasoPruebaSC FROM TAUSRSCSCAP WHERE idUSR =".$_SESSION["idUsuario"];
        $rs = mysqli_query($this->conn, $sql);
        
        
        while ($datos = mysqli_fetch_array($rs)) {
            $idCasoPrueba = $datos["idCasoPruebaSC"]; 

            $sql = "SELECT * FROM TASEGCALSCAP WHERE idTASEGCALSCAP=" .$idCasoPrueba ."";
            //echo $sql;
            $rs = mysqli_query($this->conn, $sql);
            $blanco = '';
            $var = "";
            while ($datos = mysqli_fetch_array($rs)) {

                $estatus = $datos["estatus"];
                switch ($estatus) {
                    case 1:
                        $estatus = "Activo";
                        breaK;
                    case 2:
                        $estatus = "Eliminado";
                        breaK;
                    default:
                        $status = "Estatus";
                        breaK;
                }
                $_SESSION["idSegCal"] = $datos["idTASEGCALSCAP"];
                echo "<tbody>";
                echo "<tr>";
                echo "<td><center>" . $datos["recomendacion"] . "</center></td>";
                echo "<td><center>" . $datos["contadorRevision"] . "</center></td>";
                echo "<td><center>" . $datos["comentarioValidador"]  . "</center></td>";
                $var = $datos["recomendacion"];
                //$sqlV = "SELECT * FROM TADETECCSCAP WHERE idSegCal =".$datos["idTASEGCALSCAP"]."";
                //echo $sqlV;
                //$numDetecciones = mysql_num_rows(mysql_query($sqlV));
                //echo $numDetecciones;
                $sql2 = "SELECT * FROM TADETECCSCAP WHERE idSegCal =".$_SESSION["idSegCal"]."";
                $rs2 = mysqli_query($this->conn, $sql2);
                $detecionesCont = mysqli_num_rows($rs2);

                if($datos["estatus"] != 2)
                {
                    if($detecionesCont>0){
                        echo "<form action='consultarSeguridadCalidad.php' class='login-form' method='post' >";
                        echo "<input type='hidden' name='idTASEGCALSCAP' value='" . $datos["idTASEGCALSCAP"] . "'>";
                        echo "<td><button type='submit' name='consultarCasoPrueba' id='consultarCasoPrueba' class='edit-btn'>Modificar Recomendación</button></td>";
                        echo "</form>";
                    }
                    else{
                        
                        echo "<td>" . $blanco  . "</td>";
                    }
                    
                }
                else{
                    echo "<td>" . $blanco  . "</td>";
                }
                if(!empty($var) && $datos["estatus"] != 2)
                {
                    
                    echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                    echo "<input type='hidden' name='idTASEGCALSCAP' value='" . $datos["idTASEGCALSCAP"] . "'>";
                    echo "<td><button type='submit' name='enviarValidacion' id='enviarValidacion' class='edit-btn'>Enviar a Validar</button></td>";
                    echo "</form>";
                }
                else{
                    if(empty($var))
                        {
                             echo "<td>Faltan Detecciones y/o Comentarios</td>";
                        }
                        else{
                            echo "<td> En validación</td>";
                        }
                    
                }
                echo "</tr>";
                
            }
        }
        
    }

    function listaSeveridad() {
        $sql = "SELECT * FROM CATSEVERSQSCAP";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
        
               echo "<option value='".$datos["idCATSEVERSQSCAP"]."'>".$datos["nombreSeveridad"]."</option>"; 
                }
    }

    function listaCategoria() {
        $sql = "SELECT * FROM CATCATESCAP";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
        
               echo "<option value='".$datos["idCATCATESCAP"]."'>".$datos["nombreCategoria"]."</option>"; 
                }
    }

    function listaTipoAmenaza() {
        $sql = "SELECT * FROM CATTIPOAMESCAP";
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
        
               echo "<option value='".$datos["idCATTIPOAMESCAP"]."'>".$datos["nombreAmenaza"]."</option>"; 
                }
    }

    function listaTipoCatPrueba() {
        $sql = "SELECT * FROM CATTIPOSCAP";
        $rs = mysqli_query($this->conn, $sql);
        while ($datos = mysqli_fetch_array($rs)) {
                        echo "";
               echo "<option value='".$datos["idCATTIPOSCAP"]."'>".$datos["nombreTipo"]."</option>"; 
                }
    }

    function listatipoEval() {
        $sql = "SELECT * FROM CATTIPOSCAP";
        $rs = mysqli_query($this->conn, $sql);
        while ($datos = mysqli_fetch_array($rs)) {
            echo "<option value='".$datos["idCATTIPOSCAP"]."'>".$datos["nombreTipo"]."</option>"; 
        }
    }
    
    
    function consultarRecomendacion($idUsr) {

        $banderaUpdate = false;
        //$sql = "SELECT * FROM TASEGCALSCAP WHERE idPrueba =".$idPrueba." and estatus != 2";
        $sql = "SELECT idCasoPruebaSC FROM TAUSRSCSCAP WHERE idUSR =".$idUsr;
        $rs = mysqli_query($this->conn, $sql);
        
        
        while ($datos = mysqli_fetch_array($rs)) {
            $idCasoPrueba = $datos["idCasoPruebaSC"]; 

            $sql1 = "SELECT idPrueba FROM TASEGCALSCAP WHERE  idTASEGCALSCAP=".$idCasoPrueba;
            $res = mysqli_query($this->conn, $sql1);    
            while ($datos1 = mysqli_fetch_array($res)) {
                $idSC = $datos1["idPrueba"];             
                $sql2 = "SELECT COUNT(*) AS total FROM TASEGCALSCAP WHERE idPrueba =".$idSC." ";
                echo $sql2;
                $res = mysqli_query($this->conn, $sql1);    
                while ($datos2 = mysqli_fetch_array($res)) {
                    $total = $datos2["total"];
                    if($total>0){
                        $banderaUpdate = true;
                    }
                }

            }
        }

        

        return $banderaUpdate;
    }

/*
     function consultarRecomendacion($idPrueba) {

        $banderaUpdate = false;
        //$sql = "SELECT * FROM TASEGCALSCAP WHERE idPrueba =".$idPrueba." and estatus != 2";
        $sql = "SELECT * FROM TASEGCALSCAP WHERE idPrueba =".$idPrueba." ";
        echo $sql;
        $res = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($res)>0) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }*/
    

    function altaRecomendacion($idPrueba,$tipoEval,$contador,$estatus){
        $banderaInsert = false;
        $sql = "INSERT into TASEGCALSCAP (idPrueba,idTipo,estatus,contadorRevision) VALUES (".$idPrueba.",".$tipoEval.",".$estatus."
    ,".$contador.")";
        echo $sql;
        if (mysqli_query($this->conn, $sql)) {
            echo $sql;
                //$idSegCal = mysql_insert_id();
                $idSegCal = $this->conn->insert_id;
                echo $idSegCal;
                $_SESSION["idSegCal"] = $idSegCal;
                $banderaInsert = true;
        }
        echo $banderaInsert;
        return $banderaInsert;
    }

    function listarDetecciones() {
        $sql = "SELECT * FROM TADETECCSCAP WHERE idSegCal =".$_SESSION["idSegCal"]."";
        //echo $sql;
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {
            $sql2 = "SELECT * FROM TASEGCALSCAP WHERE idTASEGCALSCAP =".$_SESSION["idSegCal"]."";
            $rs2 = mysqli_query($this->conn, $sql2);
            $datos2 = mysqli_fetch_array($rs2);
            $estatus= $datos2["estatus"];
            //echo "ESTATUS" . $sql2;
            $idSeveridad = $datos["idSeveridadSQ"];
            switch ($idSeveridad) {
                case 1:
                    $idSeveridad = "Informativa";
                    breaK;
                case 2:
                    $idSeveridad = "Menor";
                    breaK;
                case 3:
                    $idSeveridad = "Mayor";
                    breaK;
                case 4:
                    $idSeveridad = "Crítica";
                    breaK;
                case 5:
                    $idSeveridad = "Blocker";
                    breaK;
                default:
                    $status = "--";
                    breaK;
            }
            $idCategoria = $datos["idCategoria"];
            switch ($idCategoria) {
                case 1:
                    $idCategoria = "Vulnerabilidad";
                    breaK;
                case 2:
                    $idCategoria = "Bug";
                    breaK;
                case 3:
                    $idCategoria = "Punto crítico de seguridad";
                    breaK;
                case 4:
                    $idCategoria = "Debilidad de diseño";
                    breaK;
                default:
                    $status = "--";
                    breaK;
            }
            $idTipoAmenaza = $datos["idTipoAmenaza"];
            switch ($idTipoAmenaza) {
                case 1:
                    $idTipoAmenaza = "Autenticación";
                    breaK;
                case 2:
                    $idTipoAmenaza = "Autorización";
                    breaK;
                case 3:
                    $idTipoAmenaza = "Administración de configuración";
                    breaK;
                case 4:
                    $idTipoAmenaza = "Protección de datos y almacenamiento";
                    breaK;
                case 5:
                    $idTipoAmenaza = "Validación de datos";
                    breaK;
                case 6:
                    $idTipoAmenaza = "Manejo de errores y excepciones";
                    breaK;
                case 7:
                    $idTipoAmenaza = "Administración de usuarios y sesiones";
                    breaK;
                case 8:
                    $idTipoAmenaza = "Auditoria y login";
                    breaK;
                default:
                    $status = "--";
                    breaK;
            }
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $datos["descripcion"] . "</td>";
            echo "<td>" . $datos["regla"] . "</td>";
            echo "<td>" . $datos["contramedida"]  . "</td>";
            echo "<td>" . $idSeveridad . "</td>";
            echo "<td>" . $idCategoria. "</td>";
            echo "<td>" . $idTipoAmenaza . "</td>";
            if($estatus != 2){
                echo "<form action='agregarReferencia.php' class='login-form' method='post' >";
                echo "<input type='hidden' name='idTADETECCSCAP' value='" . $datos["idTADETECCSCAP"] . "'>";
                echo "<td><button type='submit' name='agregarDetalleDeteccion' id='agregarDetalleDeteccion' class='edit-btn'>Agregar Referencia</button></td>";
                echo "</form>";
                
                echo "<form action='modificarDeteccion.php' class='login-form' method='post' >";
                echo "<input type='hidden' name='idTADETECCSCAP' value='" . $datos["idTADETECCSCAP"] . "'>";
                echo "<td><button type='submit' name='modificarDetalleDeteccion' id='modificarDetalleDeteccion' class='edit-btn'>Modificar</button></td>";
                echo "</form>";

                echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
                echo "<input type='hidden' name='idTADETECCSCAP' value='" . $datos["idTADETECCSCAP"] . "'>";
                echo "<td><button type='submit' name='borrarDetalleDeteccion' id='borrarDetalleDeteccion' class='edit-btn'>Borrar</button></td>";
                echo "</form>";
            }
            else{
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
            }
            /*
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";
            echo "<td><button type='submit' name='consultarUsuario' id='cerrarActivo' class='edit-btn'>Cerrar activo</button></td>";
            echo "</form>";*/
            
            echo "</tr>";
        }
    }

    function altaDeteccion($idSegCal,$descripcion,$contramedida,$regla,$tipoSeveridad,$tipoCat,$tipoAmenaza){
        $banderaInsert = false;
        $idRegla = 1;
        $sql = "INSERT into TADETECCSCAP (idSegCal,descripcion,contramedida,regla,idSeveridadSQ,idCategoria,idTipoAmenaza,idRegla) VALUES ('".$idSegCal."','".$descripcion."','".$contramedida."','".$regla."','".$tipoSeveridad."','".$tipoCat."','".$tipoAmenaza."','".$idRegla."')";
        if (mysqli_query($this->conn, $sql)) {
                $banderaInsert = true;
        }
        return $banderaInsert;
    }
    
    function altaRef($ubicacion,$LineaCodigo,$codigo,$idTADETECCSCAP){
        $banderaInsert = false;
        $idRegla = 1;
        $sql = "INSERT into TAREFERSCAP (Ubicacion,LineaCodigo,Codigo,idDeteccion) VALUES ('".$ubicacion."','".$LineaCodigo."','".$codigo."','".$idTADETECCSCAP."')";
        if (mysqli_query($this->conn, $sql)) {
                $banderaInsert = true;
        }
        return $banderaInsert;
    }

    function listarRef($idDeteccion) {
        $sql = "SELECT * FROM TAREFERSCAP WHERE idDeteccion =".$idDeteccion."";
        //echo $sql;
        $rs = mysqli_query($this->conn, $sql);

        while ($datos = mysqli_fetch_array($rs)) {

            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $datos["Ubicacion"] . "</td>";
            echo "<td>" . $datos["LineaCodigo"] . "</td>";
            echo "<td>" . $datos["Codigo"]  . "</td>";

            echo "<form action='agregarReferencia.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idTADETECCSCAP' value='" . $datos["idTADETECCSCAP"] . "'>";
            echo "<td><button type='submit' name='agregarDetalleDeteccion' id='agregarDetalleDeteccion' class='edit-btn'>Agregar Referencia</button></td>";
            echo "</form>";
            
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";
            echo "<td><button type='submit' name='consultarUsuario' id='modificarActivo' class='edit-btn'>Modificar activo</button></td>";
            echo "</form>";
            
            echo "<form action='../../controlador/controlador.php' class='login-form' method='post' >";
            echo "<input type='hidden' name='idUsuario' value='" . $datos["idTAUSRSCAP"] . "'>";
            echo "<td><button type='submit' name='consultarUsuario' id='cerrarActivo' class='edit-btn'>Cerrar activo</button></td>";
            echo "</form>";
            
            echo "</tr>";
        }
    }

    function actualizarRecomendacion($idTASEGCALSCAP, $recomendacion){
        $banderaUpdate = false;
        $sql = "UPDATE TASEGCALSCAP SET recomendacion = '" . $recomendacion . "' WHERE idTASEGCALSCAP='" . $idTASEGCALSCAP . "'";
        if (mysqli_query($this->conn, $sql)) {
                $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function obtenerDatosDeteccion($idDeteccion){
        $sql = "SELECT * FROM TADETECCSCAP WHERE idSegCal =".$_SESSION["idSegCal"]." AND idTADETECCSCAP = ".$idDeteccion. "";
        //echo $sql;
        $rs = mysqli_query($this->conn, $sql);
         while ($datos = mysqli_fetch_array($rs)) {
            //$datos['idSeveridadSQ']
            $idSeveridadSQ = $datos["idSeveridadSQ"];
            $selectSeveridad = "";
            if ($idSeveridadSQ == 1){
                $selectSeveridad .= "<option value='1' selected>Informativa</option>";
                }
            else{
                $selectSeveridad .= "<option value='1'>Informativa</option>";
            }
            if ($idSeveridadSQ == 2){
                $selectSeveridad .= "<option value='2' selected>Menor</option>";
                }
            else{
                $selectSeveridad .= "<option value='2'>Menor</option>";
            }
            if ($idSeveridadSQ == 3){
                $selectSeveridad .= "<option value='3' selected>Mayor</option>";
                }
            else{
                $selectSeveridad .= "<option value='3'>Mayor</option>";
            }
            if ($idSeveridadSQ == 4){
                $selectSeveridad .= "<option value='4' selected>Crítica</option>";
                }
            else{
                $selectSeveridad .= "<option value='4'>Crítica</option>";
            }
            if ($idSeveridadSQ == 5){
                $selectSeveridad .= "<option value='5' selected>Blocker</option>";
                }
            else{
                $selectSeveridad .= "<option value='5'>Blocker</option>";
            }
            //categoria
            $idCategoria = $datos["idCategoria"];
            $selectCAT = "";
            if ($idCategoria == 1){
                $selectCAT .= "<option value='1' selected>Vulnerabilidad</option>";
                }
            else{
                $selectCAT .= "<option value='1'>Vulnerabilidad</option>";
            }
            if ($idCategoria == 2){
                $selectCAT .= "<option value='2' selected>Bug</option>";
                }
            else{
                $selectCAT .= "<option value='2'>Bug</option>";
            }
            if ($idCategoria == 3){
                $selectCAT .= "<option value='3' selected>Punto crítico de seguridad</option>";
                }
            else{
                $selectCAT .= "<option value='3'>Punto crítico de seguridad</option>";
            }
            if ($idCategoria == 4){
                $selectCAT .= "<option value='4' selected>Debilidad de diseño</option>";
                }
            else{
                $selectCAT .= "<option value='4'>Debilidad de diseño</option>";
            }
            //tipo de amenza
            $idTipoAmenaza = $datos["idTipoAmenaza"];
            $selectAmenaza = "";
            if ($idTipoAmenaza == 1){
                $selectAmenaza .= "<option value='1' selected>Autenticación</option>";
                }
            else{
                $selectAmenaza .= "<option value='1'>Autenticación</option>";
            }
            if ($idTipoAmenaza == 2){
                $selectAmenaza .= "<option value='2' selected>Autorización</option>";
                }
            else{
                $selectAmenaza .= "<option value='2'>Autorización</option>";
            }
            if ($idTipoAmenaza == 3){
                $selectAmenaza .= "<option value='3' selected>Administración de configuración</option>";
                }
            else{
                $selectAmenaza .= "<option value='3'>Administración de configuración</option>";
            }
            if ($idTipoAmenaza == 4){
                $selectAmenaza .= "<option value='4' selected>Protección de datos y almacenamiento</option>";
                }
            else{
                $selectAmenaza .= "<option value='4'>Protección de datos y almacenamiento</option>";
            }
            if ($idTipoAmenaza == 5){
                $selectAmenaza .= "<option value='5' selected>Validación de datos</option>";
                }
            else{
                $selectAmenaza .= "<option value='5'>Validación de datos</option>";
            }
            if ($idTipoAmenaza == 6){
                $selectAmenaza .= "<option value='6' selected>Manejo de errores y excepciones</option>";
                }
            else{
                $selectAmenaza .= "<option value='6'>Manejo de errores y excepciones</option>";
            }
            if ($idTipoAmenaza == 7){
                $selectAmenaza .= "<option value='7' selected>Administración de usuarios y sesiones</option>";
                }
            else{
                $selectAmenaza .= "<option value='7'>Administración de usuarios y sesiones</option>";
            }
            if ($idTipoAmenaza == 8){
                $selectAmenaza .= "<option value='8' selected>Auditoria y login<</option>";
                }
            else{
                $selectAmenaza .= "<option value='8'>Auditoria y login<</option>";
            }
            echo $datos['descripcion'];
            echo " <div class='row form-group'>
                                <div class='col-lg-6 col-md-6 form-group'>                  
                                    <label for='descripcion'>Descripción</label>
                                    <input type='text' class='form-control' name='descripcion' id='descripcion' value=".$datos['descripcion']."  required>                  
                                </div>
                                <div class='col-lg-6 col-md-6 form-group'>                  
                                    <label for='contramedida'>Contramedida</label>
                                    <input type='text' class='form-control' name='contramedida' id='contramedida' value=".$datos['contramedida']." required>                  
                                </div> 
                                <div class='col-lg-6 col-md-6 form-group'>                  
                                    <label for='regla'>Regla</label>
                                    <input type='text' class='form-control' name='regla' id='regla' value=".$datos['regla']." required>                  
                                </div> 
                                <div class='col-lg-6 col-md-6 form-group'>                  
                                    <label for='tipoSeveridad'>Severidad</label>
                                    <select class='form-control' name='tipoSeveridad' id='tipoSeveridad' required=''>
                                        <option disabled='' selected='' value=''> -- Seleccione una opción  -- </option>
                                        ". $selectSeveridad ." 
                                    </select>                  
                                </div>
                                <div class='col-lg-6 col-md-6 form-group'>                  
                                    <label for='tipoCat'>Categoría</label>
                                    <select class='form-control' name='tipoCat' id='tipoCat' required=''>
                                        <option disabled='' selected='' value=''> -- Seleccione una opción  -- </option>
                                        ". $selectCAT ." 
                                      </select>                 
                                </div>
                                <div class='col-lg-6 col-md-6 form-group'>         
                                    <label for='tipoAmenaza'>Tipo de amenaza</label>
                                    <select class='form-control' name='tipoAmenaza' id='tipoAmenaza' required=''>
                                        <option disabled='' selected='' value=''> -- Seleccione una opción  -- </option>
                                        ". $selectAmenaza ." 
                                    </select> 
                                </div>
                            </div>
                            ";
                echo "<input type='hidden' name='idTADETECCSCAP' value='" . $idDeteccion . "'>";
         }
    }

    function actualizarDeteccion($idTADETECCSCAP,$descripcion,$contramedida,$regla,$tipoSeveridad,$tipoCat,$tipoAmenaza){
        $banderaUpdate = false;
        //echo $idTADETECCSCAP,$descripcion,$contramedida,$regla,$tipoSeveridad,$tipoCat,$tipoAmenaza;
        $sql = "UPDATE TADETECCSCAP 
        SET descripcion = '" . $descripcion .
        "' ,contramedida = '" . $contramedida .
        "' ,regla = '" . $regla .
        "' ,idSeveridadSQ = '" . $tipoSeveridad .
        "' ,idCategoria = '" . $tipoCat .
        "' ,idTipoAmenaza = '" . $tipoAmenaza .
        "' WHERE idTADETECCSCAP = '" . $idTADETECCSCAP . "'";
        echo $sql;
        if (mysqli_query($this->conn, $sql)) {
                $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function borrarDeteccion($idTADETECCSCAP) {
        $banderaUpdate = false;
        $sql = "DELETE FROM TADETECCSCAP WHERE idTADETECCSCAP=" . $idTADETECCSCAP . "";
        if (mysqli_query($this->conn, $sql)) {
            $banderaUpdate = true;
        }
        return $banderaUpdate;
    }

    function actualizaEstatusRecomendacion($idTASEGCALSCAP){
        $banderaUpdate = false;
        $sql = "UPDATE TASEGCALSCAP SET estatus = 2 WHERE idTASEGCALSCAP='" . $idTASEGCALSCAP . "'";
        if (mysqli_query($this->conn, $sql)) {
                $banderaUpdate = true;
        }
        return $banderaUpdate;
    }


}

?>
