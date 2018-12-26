<?php

class Conexion {

    function conectarse() {
        $enlace = mysqli_connect('localhost', 'cic_scap', 'Ciseg;2018', 'scap');
        if (!$enlace) {
            //die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            $_SESSION["errorBD"] = true;
            header("location:../index");
        }
        mysqli_set_charset($enlace, "utf8");
        return($enlace);
        mysqli_close($enlace);
    }

}

?>
