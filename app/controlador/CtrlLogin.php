<?php
    if(isset($_POST["login"])){

        if (isset($_POST["usu"]) && isset($_POST["pass"])) {
            require_once("../modelo/Login.php");
            $validar = new Login();
            $validar->validarDatos($_POST["usu"], $_POST["pass"]);
            var_dump('pasa por aca 1');
            die;
        }
    }

