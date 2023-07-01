<?php

require_once("Conexion.php");

class Consulta{

    public function contarUsuario(){

        try {
            $con = Conexion::getConection();
            $sql = "SELECT * FROM usuario";
            $resultado = $con->prepare($sql);
            $resultado->execute();
            return $resultado->rowCount();
        }catch (\Exception $ex){
            throw new Exception($ex->getMessage());
        }

    }


    public function consultarUsuarios(){

        try {

            $con = Conexion::getConection();

            // Validación de error
            if ($con == "ERROR") {
                header("location:CtrlSalir.php");
            }

            // Consulta
            $sql = "SELECT * FROM usuario u JOIN persona p ON (u.id_persona = p.id_persona) order by u.id_usuario";
            $resultado = $con->prepare($sql);
            $resultado->execute();
            return $resultado->fetchAll();

        }catch (\Exception $ex){

        }

    }

    public function eliminarUsuario($id)
    {
        try {

            $con = Conexion::getConection();

            // Validación de error
            if ($con == "ERROR") {
                header("location:CtrlSalir.php");
            }

            // Consulta
            $sql = "DELETE FROM usuario WHERE id_usuario = :id";
            $resultado = $con->prepare($sql);
            $resultado->execute(array(":id" => $id));
            $this->contarUsuario();
            if($this->contarUsuario() === 0){
                session_start();
                $_SESSION['error'] = 'Se eliminaron todos los usuarios';
                header("location:CtrlSalir.php");
            }

        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

        public function agregarPersona($apellido, $nombre){

            $con = Conexion::getConection();
            if ($con == "ERROR") {
                header("location:CtrlSalir.php");
            }
            $sql = "INSERT INTO persona (apellido, nombre) VALUES (:apellido, :nombre)";
            $resultado = $con->prepare($sql);
            $resultado->execute(array(":apellido" => trim($apellido), ":nombre" => trim($nombre)));
            //return $resultado->rowCount();

        }
        public function buscarPersona($apellido, $nombre){

            $con = Conexion::getConection();
            if ($con == "ERROR") {
                header("location:CtrlSalir.php");
            }
            $sql = "SELECT * FROM persona WHERE apellido = :apellido AND nombre = :nombre";
            $resultado = $con->prepare($sql);
            $resultado->execute(array(":apellido" => $apellido, ":nombre" => $nombre));
            return $resultado->fetch();

        }

    public function agregarUsuario($usu, $pass, $id_persona, $nombre){

        try{
            // Recuperamos la conexión
            $con = Conexion::getConection();

            // Validación de error
            if ($con == "ERROR") {
                header("location:CtrlSalir.php");
            }

                $pass_cifrada = password_hash($pass, PASSWORD_DEFAULT, array("cost" => 10));

                // Consulta
                $sql = "INSERT INTO usuario (usuario, password, id_persona) VALUES (:usuario, :password, :id_persona)";
                $resultado = $con->prepare($sql);
                $insertar = $resultado->execute(array(":usuario" => $usu, ":password" => $pass_cifrada, 'id_persona' => $id_persona));

                if ($insertar) {
                    if(!$_REQUEST['sesion']){
                        session_start();
                        $_SESSION["usu"] = $usu;
                        $_SESSION["nombre"] = $nombre;
                    }
                }

        }catch (\Exception $ex){
            echo $ex->getMessage();
        }
        finally {
            $con = null;
            $sql = null;
            $resultado = null;
            header("location:../../index.php");
        }
    }

    public function editarUsuario($id_usuario, $id_persona, $usuario, $apellido, $nombre){

        try {

            $con = Conexion::getConection();

            // Validación de error
            if ($con == "ERROR") {
                header("location:CtrlSalir.php");
            }

            $sqlUsuario = "UPDATE usuario u JOIN persona p ON (u.id_persona = p.id_persona) 
                            SET u.usuario = :usuario, p.apellido = :apellido, p.nombre = :nombre 
                                WHERE u.id_usuario = :id_usuario AND p.id_persona = :id_persona";
            $resultado = $con->prepare($sqlUsuario);
            $resultado->execute(array(":usuario" => $usuario, ":apellido" => $apellido, 'nombre' => $nombre,
                                            'id_persona' => $id_persona, 'id_usuario'=>$id_usuario));

        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }finally {
            $con = null;
            $sql = null;
            $resultado = null;
            header("location:../../index.php");
        }

    }
}