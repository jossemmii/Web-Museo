<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once('datosObject.class.php');
    require_once('usuario.class.php');

    //Cada instancia de la clase Comentario se corresponderá con un comentario, una fila

    class Comentario extends DataObject {

        protected $datos = array (
            "usuario"    => null,
            "titulo"     => null,
            "texto"      => null,
            "valoracion" => null 
        );

        //Con esta función se insertará un comentario dentro de la tabla comentario
        public static function insertarComentario(Comentario $datosComentario){

            //Obtengo el nombre de usuario desde su variable de sesion
            if (isset($_SESSION['USER'])){      //Si la variable de sesión existe
                $usuario = $_SESSION['USER'];
            }
            else{
                throw new Exception("El usuario no ha iniciado sesión");
            }

            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "INSERT INTO Comentario (usuario, titulo, texto, valoracion) VALUES(:usuario, :titulo, :texto, :valoracion)";
            
            
            try{
                //Preparar la consulta 
                $st = $conexion->prepare( $consulta_sql);
                //Asignar los valores correspondientes a sus parametros
                $st->bindValue( "usuario", $usuario, PDO::PARAM_STR);
                $st->bindValue( "titulo", $datosComentario->datos['titulo'], PDO::PARAM_STR);
                $st->bindValue( "texto", $datosComentario->datos['texto'], PDO::PARAM_STR);
                $st->bindValue( "valoracion", $datosComentario->datos['valoracion'], PDO::PARAM_STR);

                //Ejecutarla
                $st->execute();

                //Desconectarme
                parent::desconectar($conexion);
            }
            catch ( PDOException $e ) { 
				parent::desconectar( $conexion ); 
				die( "Consulta para insertar comentario fallido: " . $e->getMessage() ); 
			} 
        }

        //Con esta función obtengo un comentario
        public static function obtenerComentario(){
            
            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "SELECT * FROM Comentario";

            try{

                //Preparar la consulta 
                $st = $conexion->prepare( $consulta_sql);
                //Ejecutarla
                $st->execute();

                //Obtener comentarios como un array asociativo
                $array_comentarios = $st->FetchAll(PDO::FETCH_ASSOC);

                //Desconectarme
                parent::desconectar($conexion);

                //Devolver comentarios
                return $array_comentarios;
            }
            catch ( PDOException $e ) { 
				parent::desconectar( $conexion ); 
				die( "Consulta para obtener comentarios fallida: " . $e->getMessage() ); 
			} 
        }

        //Con esta función muestro los comentarios
        public static function mostrarComentarios(){

            //Apartado para mostrar los comentarios
            echo'
            <h2 id="tituloReseñas"> Comentarios de los Usuarios </h2>
            <section id="apartadoComentarios">
                ';

            //Recuperamos antes de nada los comentarios
            $comentarios = Comentario::obtenerComentario();

            //Comprobamos que existan comentarios
            if(!empty($comentarios)){

                //Si el usuario es un administrador, obtendrá los comentarios con posibilidad de borrarlos
                $admin = $_SESSION['ADMIN']['admin'];
                if ($admin == 'Y') {
                    foreach($comentarios as $comentario) {
                        echo '
                        <article class="comentarioIndividual">
                            <h3 id="tituloComentario">' . $comentario['titulo'] . '</h3>
                            <p id="usuarioComentario">Usuario: ' . $comentario['usuario'] . '</p>
                            <p id="textoComentario">' . $comentario['texto'] . '</p>
                            <p id="valoracionComentario">Valoración: ' . $comentario['valoracion'] . '</p>
                            <form method="post" action="eliminar_comentario.php" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este comentario?\');">
                                <input type="hidden" name="idComentario" value="' . $comentario['idComentario'] . '">
                                <button type="submit" class="btn btn-warning">Eliminar</button>
                            </form>
                        </article>'; 
                    }
                }
                else{
                    //Si existe algún comentario, imprimos cada comentarios del array comentarios como un comentario
                    foreach($comentarios as $comentario) {
                        echo '
                        <article class="comentarioIndividual">
                            <h3 id="tituloComentario">' . $comentario['titulo'] . '</h3>
                            <p id="usuarioComentario">Usuario: ' . $comentario['usuario'] . '</p>
                            <p id="textoComentario">' . $comentario['texto'] . '</p>
                            <p id="valoracionComentario">Valoración: ' . $comentario['valoracion'] . '</p>
                        </article>';
                    }
                }

                
            }

        }

        //Con esta función el administrador puede eliminar un comentario
        public static function eliminarComentario($idComentario) {
            
            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "DELETE FROM Comentario WHERE idComentario=:idComentario";

            try {

                //Preparar la consulta 
                $st = $conexion->prepare( $consulta_sql);
                //Asignar el valor a la consulta preparada
                $st -> bindValue(':idComentario', $idComentario, PDO::PARAM_INT);
                //Ejecutarla
                $st->execute();
                //Desconectarme
                parent::desconectar($conexion);

            }
            catch ( PDOException $e ) { 
				parent::desconectar( $conexion ); 
				die( "No se pudo borrar el comentario: " . $e->getMessage() ); 
			} 

        }
    }
?>