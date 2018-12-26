<?php

class ModeloMenus {

    function MenuAdmin() {
        echo "<ul>";
        echo "<li><a href='gestionusuarios.php'><i class='fa fa-users fa-fw'></i>Gestionar usuarios</a></li>";
        echo "<li><a href='../../common/logout.php'><i class='fa fa-close fa-fw'></i>Salir</a></li>";
        echo "</ul>  ";
    }
    
    function MenuRespEval() {
        echo "<ul>";
            echo "<li><a href='gestionactivos.php'><i class='fa fa-server fa-fw'></i>Activos</a></li>";
            echo "<li><a href='../../common/logout.php'><i class='fa fa-close fa-fw'></i>Salir</a></li>";
        echo "</ul>  ";
    }
    
    function MenuEvaluador() {
        echo "<ul>";
            echo "<li><a href='asignaciones.php'><i class='fa fa-server fa-fw'></i>Asignaciones</a></li>";
            echo "<li><a href='../../common/logout.php'><i class='fa fa-close fa-fw'></i>Salir</a></li>";
        echo "</ul>  ";
    }

    function MenuValidador() {
        echo "<ul>";
            echo "<li><a href='consultarAsignaciones.php'><i class='fa fa-server fa-fw'></i>Activos Asignados</a></li>";
            echo "<li><a href='../../common/logout.php'><i class='fa fa-close fa-fw'></i>Salir</a></li>";
        echo "</ul>  ";
    }

}

?>
