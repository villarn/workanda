<?php

require_once ("../modelo/Consulta.php");
require_once("../modelo/Validar.php");

$usuario = $_POST["usu"];
$password = $_POST["pass"];
$apellido = $_POST["apellido"];
$nombre =  $_POST["nombre"];

$validar = new Validar();
$consulta = new Consulta();

//Busco si existe la persona y el usuario ingresados para registrar.
$resultado = $validar->validarDatos($usuario, $password, $apellido,$nombre );

    switch ($resultado) {
        case !$resultado['persona'] && !$resultado['usuario']:
            $consulta->agregarPersona($apellido, $nombre);
            $persona = $consulta->buscarPersona($apellido, $nombre);
            $id_persona = $persona['id_persona'];
            $consulta->agregarUsuario($usuario, $password, $id_persona, $nombre);
            break;
        case $resultado['persona'] && !$resultado['usuario']:
            $persona = $consulta->buscarPersona($apellido, $nombre);
            $id_persona = $persona['id_persona'];
            $consulta->agregarUsuario($usuario, $password, $id_persona, $nombre);
            break;
        case $resultado['persona'] && $resultado['usuario']:
        case !$resultado['persona'] && $resultado['usuario']:
            session_start();
            $_SESSION['error'] = 'El usuario ya existe en el sistema';
            header("location:../../index.php");
            break;
    }




