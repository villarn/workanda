<?php 

    require_once("Conexion.php");

    class Validar {

        public function validarDatos($usu, $pass, $apellido, $nombre) {

            try {
                // Recuperamos la conexión
                $con = Conexion::getConection();

                // Validación de error
                if ($con == "ERROR") {
                    header("location:CtrlSalir.php");
                }

                // Consulta
                $sqlUsuario = "SELECT * FROM usuario WHERE usuario = :USU";
                $resultadoUsuario = $con->prepare($sqlUsuario);
                $resultadoUsuario->execute(array(":USU"=>$usu));
                $data['usuario'] = $resultadoUsuario->fetch();

                $sqlPersona = "SELECT * FROM persona WHERE apellido = :apellido AND nombre = :nombre";
                $resultadoPersona = $con->prepare($sqlPersona);
                $resultadoPersona->execute(array(":apellido"=>$apellido, 'nombre'=>$nombre));
                $data['persona'] = $resultadoPersona->fetch();

                return $data;

            } catch (Exception $e) {


            } finally {
                $con = null;
                $sqlUsuario = null;
                $resultadoUsuario = null;
            }
        }

    }