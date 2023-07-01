<?php 

    require_once("Conexion.php");
    require_once("Validar.php");

    class Login {

        public function validarDatos($usu, $pass) {

            try {
                // Recuperamos la conexión
                $con = Conexion::getConection();

                // Validación de error
                if ($con == "ERROR ") {
                    header("location:CtrlSalir.php");
                }

                // Consulta
                $sql = "SELECT * FROM usuario u JOIN persona p ON (u.id_persona = p.id_persona) WHERE usuario = :USU order by u.id_usuario";
                $resultado = $con->prepare($sql);
                $resultado->execute(array(":USU"=>$usu));
                $usuario = $resultado->fetch();
                $cantidad_resultado = $resultado->rowCount();

                if($cantidad_resultado > 0){
                    if(password_verify($pass, $usuario['password'])){
                        session_start();
                        $_SESSION["usu"] = $usu;
                        $_SESSION["nombre"] = $usuario['nombre'];
                    }
                    else {
                        session_start();
                        $_SESSION["error"] = "Usuario o contraseña incorrecta";
                    }
                }else{
                    session_start();
                        $_SESSION["error"] = "No existen usuario en el sistema";
                }


            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            finally {
                $con = null;
                $sql = null;
                $resultado = null;
                header("location:../../index.php");
            }
        }
    }
