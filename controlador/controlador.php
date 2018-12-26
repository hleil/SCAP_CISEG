<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/SCAP/modelo/modelo.php";
require $_SERVER['DOCUMENT_ROOT'] . "/SCAP/modelo/mail.php";
$objModelo = new Modelo();
$objMail = new Mail();

if (isset($_POST["iniciarSesion"])) {

    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $contrasena = hash('sha256', $contrasena);
    list ($idUsuario, $nombre, $primerLogin, $rol, $estatus) = $objModelo->login($correo, $contrasena);
    if ($primerLogin == 1 && $estatus == 1) {

        $_SESSION["idUsuario"] = $idUsuario;
        header("location:../primerlogin.php");
    } else {
        echo $rol;
        switch ($rol) {
            case -1:
                $_SESSION["error"] = true;
                header("location:../index.php");
                break;

            case 1:
                $_SESSION["idUsuario"] = $idUsuario;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $rol;
                $objModelo->obtenUltimoLogin($idUsuario);
                if ($objModelo->registraLogin($idUsuario)) {
                    header("location:../secure/administrador/index.php");
                }
                else{
                    $_SESSION["errorLogin"] = true;
                    header("location:../index.php");
                }
                break;

            case 2:
                $_SESSION["idUsuario"] = $idUsuario;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $rol;
                $objModelo->obtenUltimoLogin($idUsuario);
                if ($objModelo->registraLogin($idUsuario)) {
                    header("location:../secure/responsable/index.php");
                }
                else{
                    $_SESSION["errorLogin"] = true;
                    header("location:../index.php");
                }
                break;

            case 3:
            $_SESSION["idUsuario"] = $idUsuario;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $rol;
                $objModelo->obtenUltimoLogin($idUsuario);
                if ($objModelo->registraLogin($idUsuario)) {
                    header("location:../secure/evaluador/index.php");
                }
                else{
                    $_SESSION["errorLogin"] = true;
                    header("location:../index.php");
                }
                break;

            case 4:
                $_SESSION["idUsuario"] = $idUsuario;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $rol;
                $objModelo->obtenUltimoLogin($idUsuario);
                if ($objModelo->registraLogin($idUsuario)) {
                    header("location:../secure/validador/index.php");
                }
                else{
                    $_SESSION["errorLogin"] = true;
                    header("location:../index.php");
                }
                break;
        }
    }
}
if (isset($_POST["altaUsuario"])) {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $tipoUsuario = $_POST["tipoUsuario"];
    
    if ($objModelo->altaUsuario($nombre, $correo, $tipoUsuario)) {
        $_SESSION["altaUsuario"] = true;
        /*if(! $objMail->sendCorreoAlta($nombre,$correo)){
            $_SESSION["errorEmail"] = true;
        }*/
        
    } else {
        $_SESSION["errorUsuario"] = true;
    }
    header("location:../secure/administrador/gestionusuarios.php");

}


if (isset($_POST["recuperarContrasena"])) {

    $correo = $_POST["correo"];
    $contrasena = "SCAP;".rand();

    if($objModelo->recuperarContrasena($correo,$contrasena)){
        //$objMail->sendCorreoRecuperarContrasena($correo,$contrasena);
    }
    $_SESSION["recuperarContrasena"] = true;
    
    header("location:../index.php");


}

if (isset($_POST["bajaUsuario"])) {
    $idUsuario = $_POST["idUsuario"];
    if ($objModelo->bajaUsuario($idUsuario)) {
        $_SESSION["bajaUsuario"] = true;
    } else {
        $_SESSION["errorEliminarUsuario"] = true;        
    }
    header("location:../secure/administrador/gestionusuarios.php");
    
}

if (isset($_POST["modificarUsuario"])) {
    $idUsuario = $_POST["idUsuario"];
    list($nombre,$correo,$estatus,$rol) = $objModelo->consultarUsuario($idUsuario);
    $_SESSION["idUsuarioMod"] = $idUsuario;
    $_SESSION["nombreMod"] = $nombre;
    $_SESSION["correoMod"] = $correo;
    $_SESSION["estatusMod"] = $estatus;
    $_SESSION["rolMod"] = $rol;
    header("location:../secure/administrador/datosUsuario.php");   
    
}

if (isset($_POST["modificarDatosUsuario"])) {
    $idUsuario = $_POST["idUsuarioMod"];
    $estatus = $_POST["estatusMod"];
    
    
    if ($objModelo->modificarDatosUsuario($idUsuario,$estatus)) {
        $_SESSION["actualizarUsuario"] = true;
    } else {
        $_SESSION["errorActualizarUsuario"] = true;        
    }
    header("location:../secure/administrador/gestionusuarios.php");
    
}

if (isset($_POST["consultarUsuario"])) {
    $idUsuario = $_POST["idUsuario"];
    list($nombre,$correo,$estatus,$rol) = $objModelo->consultarUsuario($idUsuario);
    $_SESSION["idUsuarioCon"] = $idUsuario;
    $_SESSION["nombreCon"] = $nombre;
    $_SESSION["correoCon"] = $correo;
    $_SESSION["estatusCon"] = $estatus;
    $_SESSION["rolCon"] = $rol;
    header("location:../secure/administrador/datosUsuarioConsulta.php");   
    
}

if (isset($_POST["primerLogin"])) {
    $usuario = $_SESSION["usuario"];
    $contrasena = $_POST["contrasena"];
    $contrasena2 = $_POST["contrasena2"];
    $flag = false;

    if ($contrasena == $contrasena2) {
        
        if(preg_match("/[A-Z]+/", $contrasena) == TRUE){
            if (preg_match("/[a-z]+/", $contrasena) == TRUE) {
                if (preg_match("/[0-9]+/", $contrasena) == TRUE) {
                    if (preg_match("/[\.\,\;]+/", $contrasena) == TRUE) {
                        $flag = true;
                    }
                }
            }
        }
        
        if($flag){
            $contrasena = hash('sha256', $contrasena);
            if ($objModelo->primerLogin($usuario, $contrasena)) {
                $_SESSION["primerLogin"] = true;
                unset($_SESSION["usuario"]);
                header("location:../index.php");
            }
        }
        else{
            $_SESSION["errorPoliticaContrasena"] = true;
            header("location:../primerlogin.php");
        }


        
    } else {
        $_SESSION["errorContrasena"] = true;
        header("location:../primerlogin.php");
    }
}

if (isset($_POST["agregarActivo"])) {
    $_SESSION["nombreActivo"] = $_POST["nombreActivo"];
    $_SESSION["propietario"] = $_POST["propietario"];
    $_SESSION["version"] = $_POST["version"];
    $_SESSION["comentarios"] = $_POST["comentarios"];
    $_SESSION["finicio"] = $_POST["fInicio"];
    $_SESSION["ffin"] = $_POST["fFin"];
    
    if( ($_POST["fFin"] < $_POST["fInicio"]) ){
        $_SESSION["errorFechaMayor"]=true; 
        header("location:../secure/responsable/altaActivo.php");    
    }
    else if ($_POST["fFin"] == $_POST["fInicio"]) {
        $_SESSION["errorFechasIguales"]=true; 
        header("location:../secure/responsable/altaActivo.php");  
    }
    else{
        header("location:../secure/responsable/altaPrueba.php");   
    }
    
    
    
}

if (isset($_POST["agregarPrueba"])) {
    
    $tipoPrueba= $_POST["tipoPrueba"];
    $tipoMetodologia= $_POST["tipoMetodologia"];
    $evaluador1= $_POST["evaluador1"];
    $evaluador2= $_POST["evaluador2"];
    $validador= $_POST["validador"];
    $finicioPrueba= $_POST["finicioPrueba"];
    $ffinPrueba= $_POST["ffinPrueba"];
    
    $_SESSION["evaluador1"] = $evaluador1;
    $_SESSION["evaluador2"] = $evaluador2;
    $_SESSION["validador"] = $validador;

    if((($tipoPrueba == 1)&&($tipoMetodologia==2)) || (($tipoPrueba == 2)&&($tipoMetodologia==1)) ){
        if ($objModelo->agregarActivo($_SESSION["nombreActivo"],$_SESSION["finicio"],$_SESSION["ffin"],$_SESSION["propietario"],$_SESSION["comentarios"],$_SESSION["version"],$_SESSION["idUsuario"])) {
            $idActivo = $objModelo->obtenerIdActivo();
            if ($objModelo->agregarPrueba($finicioPrueba,$ffinPrueba,$tipoMetodologia,$tipoPrueba,$idActivo)){
                $idPrueba = $objModelo->obtenerIdPrueba();

                if ($tipoPrueba == 2) {
                    
                    if($objModelo->agregaPruebaSegCtrl($idPrueba, $evaluador1)){
                        $_SESSION["agregarActivo"] = true;
                    }else{
                         $_SESSION["errorAgregarEvaluador"] = true;
                    }

                    if($objModelo->agregaPruebaSegCtrl($idPrueba, $evaluador2)){
                        $_SESSION["agregarActivo"] = true;
                    }else{
                         $_SESSION["errorAgregarEvaluador"] = true;
                    }
                }

                if($objModelo->agregarEvaluador($validador,$idPrueba, 3)){
                    $_SESSION["agregarActivo"] = true;

                }
                else{
                    $_SESSION["errorAgregarValidador"] = true;
                }
                
            }
            else{
                $_SESSION["errorAgregarPrueba"] = true;
            }
        
        } else{
            $_SESSION["errorAgregarActivo"] = true;
        }
        
        if(isset( $_SESSION["agregarActivo"] )){
            $_SESSION["idPrueba"] = $idPrueba;
            if($tipoPrueba==1){
                header("location:../secure/responsable/altaRevConfiguraciones.php");
            }
            elseif($tipoPrueba==2){
                header("location:../secure/responsable/gestionactivos.php");
            }
        }
        else{
            header("location:../secure/responsable/gestionactivos.php");
        }  
    
    }else{
            $_SESSION["errorPruebaMetodologia"] = true;
            header("location:../secure/responsable/altaPrueba.php");

    }  
    
}

if (isset($_POST["consultarActivo"])) {
    list($nombre,$fInicio,$fFin,$propietarioActivo,$comentarios,$version,$responsable) = $objModelo->consultarActivo($_POST["idActivo"]);
    $_SESSION["idActivo"] = $_POST["idActivo"];
    $_SESSION["nombre"] = $nombre;
    $_SESSION["fInicio"] = $fInicio;
    $_SESSION["fFin"] = $fFin;
    $_SESSION["propietarioActivo"] = $propietarioActivo;
    $_SESSION["comentarios"] = $comentarios;
    $_SESSION["version"] = $version;
    $_SESSION["responsable"] = $responsable;

    if(isset($_POST["cerrar"])){
        header("location:../secure/responsable/finalizaActivo.php");    
    }elseif(isset($_POST["modificar"])){
        header("location:../secure/responsable/modificaActivo.php");    
    }else{
        header("location:../secure/responsable/consultarActivo.php");    
    }
}


if (isset($_POST["agregarRevConf"])) {

    
    $idPrueba = $_SESSION["idPrueba"] ;
    $fabricante = $_POST["fabricante"];
    $producto = $_POST["producto"];
    $version = $_POST["version"];
    $edicion = $_POST["edicion"];
    $ediSoftware = $_POST["ediSoftware"];
    $comentarios = $_POST["comentarios"];
    $tipoRevision = $_POST["tipoRevision"];

    $_SESSION["evaluador1"] = $_POST["eval1"];
    $_SESSION["evaluador2"] = $_POST["eval2"];
    
    if($objModelo->agregarRevConfiguraciones($fabricante, $producto, $version, $edicion, $ediSoftware, $comentarios,$idPrueba,$tipoRevision)){
        $idRevConf = $objModelo->obtenerIdRevConf();
        $_SESSION["idRevConf"] = $idRevConf;
        header("location:../secure/responsable/altaCasoPrueba.php");
    }else{
        $_SESSION["ErroAltaRevConf"]=true;
        header("location:../secure/responsable/altaRevConfiguraciones.php");
    }
    
}

if (isset($_POST["saveModRevConf"])) {

    
    $idRevConf = $_POST["idRevConf"] ;
    $fabricante = $_POST["fabricante"];
    $producto = $_POST["producto"];
    $version = $_POST["version"];
    $edicion = $_POST["edicion"];
    $ediSoftware = $_POST["ediSoftware"];
    $comentarios = $_POST["comentarios"];
    $tipoRevision = $_POST["tipoRevision"];
    
    if($objModelo->modificaRevConfiguraciones($fabricante, $producto, $version, $edicion, $ediSoftware, $comentarios,$idRevConf,$tipoRevision)){        
        header("location:../secure/responsable/vistaModificacionRevConf.php");
    }else{
        $_SESSION["ErroAltaRevConf"]=true;
        header("location:../secure/responsable/modificaRevisionPrueba.php");
    }
    
}


if (isset($_POST["agregarCasoPrueba"])) {
    $eval1 = $_POST["eval1"];
    $eval2 = $_POST["eval2"];       

    $idRevConf = $_SESSION["idRevConf"];
    $grupo = $_POST["grupo"];
    $titulo = $_POST["titulo"];
    $opcion = $_POST["opcionValue"];
    $descripcion = $_POST["descripcion"];
    
    
    
    if($objModelo->agregarCasoPrueba($grupo, $titulo, $version, $edicion, $descripcion,$idRevConf,$eval1)){        
        if($objModelo->agregarCasoPrueba($grupo, $titulo, $version, $edicion, $descripcion,$idRevConf,$eval2)){
            switch ($opcion) {
                case "1":
                    header("location:../secure/responsable/finalizaRegistroPruebas.php");
                    break;
                case "0":
                    header("location:../secure/responsable/altaCasoPrueba.php");
                    $_SESSION["altaCasoPrueba"] = true;
                    break;
                case "2":
                    header("location:../secure/responsable/altaRevConfiguraciones.php");
                    break;
            }  
        }else{
            header("location:../secure/responsable/altaCasoPrueba.php");
        }        
    }else{
        header("location:../secure/responsable/altaCasoPrueba.php");
    }
    
}


if (isset($_POST["consultarPruebas"])) {
    
    $idActivo = $_POST["idActivo"] ;
    $_SESSION["idActivo"] = $idActivo;
    
    header("location:../secure/responsable/consultaCasosPrueba.php");
    
}

if (isset($_POST["regresarMenu"])) {
    
    $idActivo = $_POST["idActivo"] ;
    $_SESSION["idActivo"] = $idActivo;
    
    header("location:../secure/responsable/consultarActivos.php");
    
}

if (isset($_POST["modificarPruebas"])) {
    
    $idRevConf = $_SESSION["idRevConf"] ;
    $grupo = $_POST["grupo"];
    $titulo = $_POST["titulo"];
    $opcion = $_POST["opcionValue"];
    $descripcion = $_POST["descripcion"];
    
    if($objModelo->agregarCasoPrueba($grupo, $titulo, $version, $edicion, $descripcion,$idRevConf)){
        switch ($opcion) {
            case "1":
                header("location:../secure/responsable/finalizaRegistroPruebas.php");
                break;
            case "0":
                header("location:../secure/responsable/altaCasoPrueba.php");
                break;
            case "2":
                header("location:../secure/responsable/altaRevConfiguraciones.php");
                break;
        }   
        
    }else{
        header("location:../secure/responsable/altaCasoPrueba.php");
    }
}

if (isset($_POST["agregarResultado"])) {
    
    $_SESSION["idCasoPrueba"] = $_POST["idCasoPrueba"];
    
    list($grupo,$titulo,$descripcion) = $objModelo->consultarCasoPrueba($_POST["idCasoPrueba"]);
    $_SESSION["grupo"] = $grupo;
    $_SESSION["titulo"] = $titulo;
    $_SESSION["descripcion"] = $descripcion;
    header("location:../secure/evaluador/evaluar.php");   
    
}

if (isset($_POST["registrarResultado"])) {
    
    $idCasoPrueba = $_SESSION["idCasoPrueba"];

    
    if(($idCasoPrueba % 2) == 0 ){
        $idCasoPruebaCom=$idCasoPrueba - 1;
    
    }
    else{
        $idCasoPruebaCom=$idCasoPrueba + 1;
    }
        
    $entrada = $_POST["entrada"];
    $resultado = $_POST["resultado"];
    $infComp = $_POST["infComp"];
    $evidencias = $_POST["evidencias"];
    $recomendacion = $_POST["recomendacion"];
    $resultadoEval = $_POST["resultadoEval"];
    
    $estatusCom = $objModelo->validaEstatusCasoPruebaComp($idCasoPruebaCom);
    

    if($estatusCom == 1){

        if($objModelo->registrarResultado($idCasoPrueba,$entrada,$resultado,$infComp,$evidencias,$recomendacion,$resultadoEval,"2" )){
            $_SESSION["agregarResultado"] = true;

        }
        else{
            $_SESSION["errorAgregarResultado"] = true;
        }
        
    }
    else if($estatusCom == 2){

        if($objModelo->registrarResultado($idCasoPrueba,$entrada,$resultado,$infComp,$evidencias,$recomendacion,$resultadoEval,"5" )){
            if($objModelo->actualizaEstatusCom($idCasoPruebaCom,"5")){
                $_SESSION["agregarResultado"] = true;
            }
            

        }
        else{
            $_SESSION["errorAgregarResultado"] = true;
        }
        
    }
    
    
    
    header("location:../secure/evaluador/asignaciones.php");   
}

if (isset($_POST["modificarResultado"])) {
    
    $idCasoPrueba = $_SESSION["idCasoPrueba"];

    
    if(($idCasoPrueba % 2) == 0 ){
        $idCasoPruebaCom=$idCasoPrueba - 1;
    
    }
    else{
        $idCasoPruebaCom=$idCasoPrueba + 1;
    }
        
    $entrada = $_POST["entrada"];
    $resultado = $_POST["resultado"];
    $infComp = $_POST["infComp"];
    $evidencias = $_POST["evidencias"];
    $recomendacion = $_POST["recomendacion"];
    $resultadoEval = $_POST["resultadoEval"];
    $comentario = "Comentario ".$_SESSION["contadorRevision"]."\n";
    $comentario .= $_SESSION["comentariosValidador"]."\n";
    $contador = $_SESSION["contadorRevision"]+1;
    
    
    $estatusCom = $objModelo->validaEstatusCasoPruebaComp($idCasoPruebaCom);
    

    if($estatusCom == 4){

        if($objModelo->modificarResultado($idCasoPrueba,$entrada,$resultado,$infComp,$evidencias,$recomendacion,$resultadoEval,"2",$comentario,$contador )){
            $_SESSION["modificarResultado"] = true;

        }
        else{
            $_SESSION["errorModificarResultado"] = true;
        }
        
    }
    else if($estatusCom == 2){

        if($objModelo->modificarResultado($idCasoPrueba,$entrada,$resultado,$infComp,$evidencias,$recomendacion,$resultadoEval,"5",$comentario,$contador )){
            if($objModelo->actualizaEstatusCom($idCasoPruebaCom,"5")){
                $_SESSION["modificarResultado"] = true;
            }
            

        }
        else{
            $_SESSION["errorModificarResultado"] = true;
        }
        
    }
    
    
    
    header("location:../secure/evaluador/asignaciones.php");   
}

if (isset($_POST["editarResultado"])) {
    
    $_SESSION["idCasoPrueba"] = $_POST["idCasoPrueba"];
    
    list($grupo,$titulo,$descripcion,$entrada,$resultado,$informacionComplementaria,$evidencias,$recomendacion,$resultadoPrueba,$comentariosValidador,$contadorRevision) = $objModelo->consultarCasoPrueba($_POST["idCasoPrueba"]);
    $_SESSION["grupo"] = $grupo;
    $_SESSION["titulo"] = $titulo;
    $_SESSION["descripcion"] = $descripcion;
    $_SESSION["entrada"] = $entrada;
    $_SESSION["resultado"] = $resultado;
    $_SESSION["informacionComplementaria"] = $informacionComplementaria;
    $_SESSION["evidencias"] = $evidencias;
    $_SESSION["recomendacion"] = $recomendacion;
    $_SESSION["resultadoPrueba"] = $resultadoPrueba;
    $_SESSION["comentariosValidador"] = $comentariosValidador;
    $_SESSION["contadorRevision"] = $contadorRevision;
    
    
    header("location:../secure/evaluador/editarEvaluacion.php");   
    
}

if (isset($_POST["modificarRevPrueba"])) {
    
    $idRevConf = $_POST["idRevConf"];
    $_SESSION["idRevConf"] = $idRevConf;
    
    list($fabricante,$producto,$version,$edicion,$ediSoft,$comentarios,$tipoRevision) = $objModelo->consultarRevisionConfiguraciones($idRevConf);

    $_SESSION["fabricante"]=$fabricante;
    $_SESSION["producto"]=$producto;
    $_SESSION["version"]=$version;
    $_SESSION["edicion"]=$edicion;
    $_SESSION["ediSoft"]=$ediSoft;
    $_SESSION["comentarios"]=$comentarios;
    $_SESSION["tipoRevision"]=$tipoRevision;
    #$_SESSION["idRevConf"]=$_POST["idRevConf"];
    #$_SESSION["grupo"] = $grupo;
    #$_SESSION["titulo"] = $titulo;
    #$_SESSION["descripcion"] = $descripcion;
    header("location:../secure/responsable/modificaRevisionPrueba.php");   
    
}

if (isset($_POST["modificaCasoPrueba"])) {
    
    $_SESSION["idCasoPrueba"] = $_POST["idCasoPrueba"];
    $_SESSION["idRevConf"] = $_POST["idRevConf"];
    
    
    list($grupo,$titulo,$descripcion) = $objModelo->consultarCasoPrueba($_POST["idCasoPrueba"]);
    $_SESSION["grupo"] = $grupo;
    $_SESSION["titulo"] = $titulo;
    $_SESSION["descripcion"] = $descripcion;
    header("location:../secure/responsable/modificaCasoPrueba.php");   
    
}

if (isset($_POST["saveModCasoPrueba"])) {

    
    $grupo = $_POST["grupo"] ;
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $idCasoPrueba = $_POST["idCasoPrueba"];
 
    
    if($objModelo->modificaCasoPrueba($grupo, $titulo, $descripcion, $idCasoPrueba)){        
        header("location:../secure/responsable/vistaModificacionCasoPrueba.php");
    }else{
        $_SESSION["ErroAltaRevConf"]=true;
        header("location:../secure/responsable/modificaCasoPrueba.php");
    }
}

if (isset($_POST["cierraActivo"])) {
    $idActivo = $_POST["idActivo"] ;
    $fIni = $_POST["fInicio"] ;
    $fFin = $_POST["fFin"] ;
    $_SESSION["estatus"] = "Terminado";
    if($objModelo->cerrarActivo($idActivo)){   
        header("location:../secure/responsable/verInformacionActivo.php");
    }else{
        $_SESSION["ErrorCierreActivo"]=true;
        header("location:../secure/responsable/finalizaActivo.php");
    } 
    
}

if (isset($_POST["modificarActivo"])) {
    $idActivo = $_SESSION["idActivo"] ;
    $fIni = $_POST["fInicio"] ;
    $fFin = $_POST["fFin"] ;
    $_SESSION["fInicio"]=$fIni;
    $_SESSION["fFin"] = $fFin;

    if($objModelo->actualizaActivo($fIni, $fFin, $idActivo)){        
        header("location:../secure/responsable/verInformacionActivo.php");
    }else{
        $_SESSION["ErrorModificarActivo"]=true;
        header("location:../secure/responsable/modificaActivo.php");
    } 
    
}


/*Seguridad y calidad*/
if (isset($_POST["initEval"])) {
    $idPrueba = $_POST["idPrueba"];
    $_SESSION["idPrueba"] = $idPrueba;
    #if($objModelo->consultarRecomendacion($idPrueba)){
        //$_SESSION["agregarResultado"] = true;
        header("location:../secure/evaluador/consultarCasoPRUEBA.php"); 
    
    /*}
    else{
        //$_SESSION["errorAgregarResultado"] = true;
        header("location:../secure/evaluador/altaRecomendacion.php"); 
    }*/
    //header("location:../secure/responsable/asignaciones.php");    
}

if (isset($_POST["registrarEval"])) {
    $_SESSION["tipoEval"] = $_POST["tipoEval"];
    #$_SESSION["idPrueba"] = $_POST["idPrueba"];
    $idPrueba = $_SESSION["idPrueba"];
    $estatus = 1;
    $contador = 0;
    if($objModelo->altaRecomendacion($idPrueba,$_SESSION["tipoEval"],$contador,$estatus)){
        //$_SESSION["agregarResultado"] = true;
        header("location:../secure/evaluador/consultarCasoPRUEBA.php"); 
    }
    else{
        //$_SESSION["errorAgregarResultado"] = true;
        header("location:../secure/evaluador/altaRecomendacion.php"); 
    }    
}

if (isset($_POST["registrarDeteccion"])) {
    $descripcion = $_POST["descripcion"];
    $contramedida = $_POST["contramedida"];
    $regla = $_POST["regla"];
    $tipoSeveridad = $_POST["tipoSeveridad"];
    $tipoCat = $_POST["tipoCat"];
    $tipoAmenaza = $_POST["tipoAmenaza"];
    $idSegCal = $_SESSION["idSegCal"];
    //$idSegCal = "1";
    //echo($idSegCal,$descripcion,$contramedida,$regla,$tipoSeveridad,$tipoCat,$tipoAmenaza);
    if($objModelo->altaDeteccion($idSegCal,$descripcion,$contramedida,$regla,$tipoSeveridad,$tipoCat,$tipoAmenaza)){
        //$_SESSION["agregarResultado"] = true;
        header("location:../secure/evaluador/consultarCasoPRUEBA.php"); 
    }
    else{
        //$_SESSION["errorAgregarResultado"] = true;
        header("location:../secure/evaluador/agregarDeteccion.php"); 
    }
}

if (isset($_POST["registrarRef"])) {
    $ubicacion = $_POST["ubicacion"];
    $LineaCodigo = $_POST["LineaCodigo"];
    $codigo = $_POST["codigo"];
    $idTADETECCSCAP = $_POST["idTADETECCSCAP"];
    //$idSegCal = "1";
    //echo($idSegCal,$descripcion,$contramedida,$regla,$tipoSeveridad,$tipoCat,$tipoAmenaza);
    if($objModelo->altaRef($ubicacion,$LineaCodigo,$codigo,$idTADETECCSCAP)){
        //$_SESSION["agregarResultado"] = true;
        header("location:../secure/evaluador/consultarCasoPRUEBA.php"); 
    }
    else{
        //$_SESSION["errorAgregarResultado"] = true;
        header("location:../secure/evaluador/agregarReferencia.php"); 
    }
}

if (isset($_POST["registrarRecomendacion"])) {
    $idTASEGCALSCAP = $_POST["idTASEGCALSCAP"];
    $recomendacion = $_POST["recomendacion"];
    if($objModelo->actualizarRecomendacion($idTASEGCALSCAP, $recomendacion)){
        //$_SESSION["agregarResultado"] = true;
        header("location:../secure/evaluador/consultarCasoPRUEBA.php"); 
    }
    else{
        //$_SESSION["errorAgregarResultado"] = true;
        header("location:../secure/evaluador/consultarSeguridadCalidad.php"); 
        //echo "S: ".$recomendacion." - ".$idTASEGCALSCAP;
    }    
}

if (isset($_POST["actualizarDeteccion"])) {
    $descripcion = $_POST["descripcion"];
    $contramedida = $_POST["contramedida"];
    $regla = $_POST["regla"];
    $tipoSeveridad = $_POST["tipoSeveridad"];
    $tipoCat = $_POST["tipoCat"];
    $tipoAmenaza = $_POST["tipoAmenaza"];
    $idTADETECCSCAP = $_POST["idTADETECCSCAP"];

    if ($objModelo->actualizarDeteccion($idTADETECCSCAP,$descripcion,$contramedida,$regla,$tipoSeveridad,$tipoCat,$tipoAmenaza)) {
        //$_SESSION["agregarResultado"] = true;
        header("location:../secure/evaluador/consultarCasoPRUEBA.php"); 
    }
    else{
        //$_SESSION["errorAgregarResultado"] = true;
        //header("location:../secure/evaluador/modificarDeteccion.php"); 
    }
}

if (isset($_POST["borrarDetalleDeteccion"])) {
    $idTADETECCSCAP = $_POST["idTADETECCSCAP"];
    if ($objModelo->borrarDeteccion($idTADETECCSCAP)) {
        //$_SESSION["bajaUsuario"] = true;
    } else {
        //$_SESSION["errorEliminarUsuario"] = true;        
    }
    header("location:../secure/evaluador/consultarCasoPRUEBA.php");
    
}

if (isset($_POST["enviarValidacion"])) {
    $idTASEGCALSCAP = $_POST["idTASEGCALSCAP"];
    if($objModelo->actualizaEstatusRecomendacion($idTASEGCALSCAP)){
        //$_SESSION["agregarResultado"] = true;
        header("location:../secure/evaluador/asignaciones.php"); 
    }
    else{
        //$_SESSION["errorAgregarResultado"] = true;
        header("location:../secure/evaluador/consultarCasoPRUEBA.php"); 
    }    
}

//VALIDADOR

if(isset($_POST["consultarPruebasVal"])){
    # list($nombre,$fInicio,$fFin,$propietarioActivo,$comentarios,$version,$responsable) = $objModelo->consultarActivo($_POST["idActivo"]);
    $_SESSION["idActivo"] = $_POST["idActivo"];
    $_SESSION["idTipoPrueba"] = $_POST["idTipoPrueba"];
    $_SESSION["idPrueba"] = $_POST["idPrueba"];
    $_SESSION["idUsuario"] = $_POST["idUsuario"];
    header("location:../secure/validador/consultarPruebas.php");
}

if (isset($_POST["consultarCasosPrueba"])) {
    #list($nombre,$fInicio,$fFin,$propietarioActivo,$comentarios,$version,$responsable) = $objModelo->consultarActivo($_POST["idActivo"]);

    $_SESSION["idActivo"] = $_POST["idActivo"];
    $_SESSION["idTipoPrueba"] = $_POST["idTipoPrueba"];
    $_SESSION["idPrueba"] = $_POST["idPrueba"];
    $_SESSION["idUsuario"] = $_POST["idUsuario"];

    /*
    echo 'idActivo '.$_SESSION["idActivo"].'<br/>';
    echo 'idTipoPrueba '.$_SESSION["idTipoPrueba"].'<br/>';
    echo 'idPrueba '.$_SESSION["idPrueba"].'<br/>';
    echo 'idUsuario '.$_SESSION["idUsuario"].'<br/>';
    */
    header("location:../secure/validador/consultarCasosDePrueba.php");   
    
}

if (isset($_POST["consultarResultados"])) {
    #list($nombre,$fInicio,$fFin,$propietarioActivo,$comentarios,$version,$responsable) = $objModelo->consultarActivo($_POST["idActivo"]);

    $_SESSION["idActivo"] = $_POST["idActivo"];
    $_SESSION["idTipoPrueba"] = $_POST["idTipoPrueba"];
    $_SESSION["idPrueba"] = $_POST["idPrueba"];
    $_SESSION["idUsuario"] = $_POST["idUsuario"];
    /*
    echo 'idActivo '.$_SESSION["idActivo"].'<br/>';
    echo 'idTipoPrueba '.$_SESSION["idTipoPrueba"].'<br/>';
    echo 'idPrueba '.$_SESSION["idPrueba"].'<br/>';
    echo 'idUsuario '.$_SESSION["idUsuario"].'<br/>';
    echo 'idRevConf '.$_POST["idRefConf"].'<br/>';
    */
    $_SESSION["idRefConf"] = $_POST["idRefConf"];
    header("location:../secure/validador/revisarResultados.php");   
    
}
if (isset($_POST["verResultadoDetalle"])) {         
    $_SESSION["idCasoPrueba"] = $_POST["idEval"];
    $_SESSION["idTipoPrueba"] = $_SESSION["tipoPrueba"];
    header("location:../secure/validador/consultaResDetalle.php");        
}

if (isset($_POST["rechazarCasoPrueba"])) {         
    #$objModelo->rechazarResultados($_SESSION["CasosPrueba"], $_SESSION["tipoPrueba"]);
    /*echo 'Casos Prueba<br/>';
    foreach($_SESSION["CasosPrueba"] as $v){
            echo $v;
        }
     echo 'Tipo Prueba '.$_SESSION["tipoPrueba"];
     
     echo $_POST["id1"];
     echo $_POST["id2"];
     echo $_POST["idTipoPrueba"];
     */
     #$objModelo->rechazarResultados($_POST["id1"], $_POST["idTipoPrueba"], $_POST["comentario"]);

    if ($objModelo->rechazarResultados($_POST["id1"], $_POST["idTipoPrueba"], $_POST["comentario"])) {
        if ($objModelo->rechazarResultados($_POST["id2"], $_POST["idTipoPrueba"], $_POST["comentario"])) {
            header("location:../secure/validador/revisarResultados.php");
        }
    } else {
        $_SESSION["errorRechazarResultados"] = true;
        header("location:../secure/validador/revisarResultados.php");        
    }   
    
}

if (isset($_POST["validarCasoPrueba"])) {         
    #$objModelo->rechazarResultados($_SESSION["CasosPrueba"], $_SESSION["tipoPrueba"]);
    /*
     echo $_POST["id1"];
     echo $_POST["id2"];
     echo $_POST["idTipoPrueba"];*/
     #$objModelo->validarResultados($_POST["id1"], $_POST["idTipoPrueba"]);
     
    if ($objModelo->validarResultados($_POST["id1"], $_POST["idTipoPrueba"])) {        
        if ($objModelo->validarResultados($_POST["id2"], $_POST["idTipoPrueba"])) {
            header("location:../secure/validador/revisarResultados.php");
        }
    } else {
        $_SESSION["errorRechazarResultados"] = true;
        header("location:../secure/validador/revisarResultados.php");        
    }
}

//VALIDADOR
?>
