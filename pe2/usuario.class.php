<?php

    require_once('datosObject.class.php');

    //Cada instancia de la clase Usuario se corresponderá con un usuario, una fila

    class Usuario extends DataObject {

        protected $datos = array (
            "dni" => null,
            "usuario" => null,
            "pass" => null,
            "email" => null,
            "nombre" => null,
            "apellido1" => null,
            "apellido2" => null,
            "direccion" => null
        );

        //Con esta función se insertará un usuario dentro de la tabla Usuario
        public static function insertarUsuario(Usuario $datosUsuario){

            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "INSERT INTO Usuario VALUES(:dni, :usuario, :pass, :email, :nombre, :apellido1, :apellido2, :direccion, :admin)";
            
            
            try{
                //Preparar la consulta 
                $st = $conexion->prepare( $consulta_sql);
                //Asignar los valores correspondientes a sus parametros
                $st->bindValue( "dni", $datosUsuario->datos['dni'], PDO::PARAM_STR);
                $st->bindValue( "usuario", $datosUsuario->datos['usuario'], PDO::PARAM_STR);
                $st->bindValue( "pass", $datosUsuario->datos['pass'], PDO::PARAM_STR);
                $st->bindValue( "email", $datosUsuario->datos['email'], PDO::PARAM_STR);
                $st->bindValue( "nombre", $datosUsuario->datos['nombre'], PDO::PARAM_STR);
                $st->bindValue( "apellido1", $datosUsuario->datos['apellido1'], PDO::PARAM_STR);
                $st->bindValue( "apellido2", $datosUsuario->datos['apellido2'], PDO::PARAM_STR);
                $st->bindValue( "direccion", $datosUsuario->datos['direccion'], PDO::PARAM_STR);
                $st->bindValue( "admin", $datosUsuario->datos['admin'], PDO::PARAM_STR);
                //Ejecutarla
                $st->execute();

                //Desconectarme
                parent::desconectar($conexion);
            }
            catch ( PDOException $e ) { 
				parent::desconectar( $conexion ); 
				die( "Consulta para insertar usuario fallida: " . $e->getMessage() ); 
			} 
        }

        //Con esta función devuelvo true si existe el usuario al iniciar sesión y false si no existe
        public static function existeUsuario ($usuario, $pass){

            //Inicio la conexion
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "SELECT * FROM Usuario WHERE usuario=? AND pass=?";

            try{
                //Preparar la consulta 
                $st = $conexion->prepare($consulta_sql);
                //Asignar los valores correspondientes a sus parametros
                $st->bindValue(1, $usuario, PDO::PARAM_STR);
                $st->bindValue(2, $pass, PDO::PARAM_STR);
                //Ejecuto la consulta
                $st->execute();

                //Si ese resultado contiene una fila, quiere decir que existe un usuario, por lo que habrá que contar el numero de filas
                $filasResultado = $st->rowCount();
                
                //Desconectarme
                parent::desconectar($conexion);

                //if el resultado es 1, quiere decir que el usuario existe SOLO 1 VEZ
                return ($filasResultado == 1);
            }
            catch (PDOException $e){
                //Desconectarme
                parent::desconectar($conexion);
                die( "El usuario no existe." . $e->getMessage() );
                return false;        
            }
        }

        //Con esta función devuelvo el valor de admin para un usuario, para comprobar si es administrado
        public static function esAdmin($usuario){

            //Inicio la conexion
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "SELECT admin FROM Usuario WHERE usuario = ?";
            //Preparo la consulta
            $st = $conexion->prepare( $consulta_sql);
            //Asigno el valor correspondiente
            $st->bindValue(1, $usuario, PDO::PARAM_STR);
            //Ejecuto la consulta
            $st->execute();

            //Obtengo el resultado
            $resultado = $st->fetch(PDO::FETCH_ASSOC);

            //Me desconecto
            parent::desconectar($conexion);

            //Devuelvo el resultado
            return $resultado;

        }
    }
?>
