<?php
require_once ("../modelo/Consulta.php");
require_once("../modelo/Validar.php");

$id_usuario = $_POST["id_usuario"];
$id_persona = $_POST["id_persona"];
$usuario = $_POST["usu"];
$apellido = $_POST["apellido"];
$nombre =  $_POST["nombre"];

$consulta = new Consulta();

$consulta->editarUsuario($id_usuario, $id_persona, $usuario, $apellido, $nombre);