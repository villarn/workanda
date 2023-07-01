<?php


if(isset($_REQUEST['eliminarId'])){

    require_once ('../modelo/Consulta.php');
    $eliminar = new Consulta();
    $eliminar->eliminarUsuario($_REQUEST['eliminarId']);
}

