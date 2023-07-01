<link rel="stylesheet" type="text/css" href="../../public/css/estilos.css">

<?php
    session_start();

    if (isset($_SESSION["usu"])) {
        require_once ("app/modelo/Consulta.php");
        $consultar = new Consulta();
        $data = $consultar->consultarUsuarios();
        include_once("app/vista/principal.php");
    }
    else {
        if (isset($_SESSION["error"])) {
            echo'<div class="alert">'.$_SESSION["error"].'</div>';
            unset($_SESSION["error"]);
        }

        include_once("app/vista/login.php");
    }
