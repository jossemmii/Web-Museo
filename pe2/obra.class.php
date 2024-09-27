<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once('datosObject.class.php');

    //Cada instancia de la clase Obra se corresponderá con una obra, una fila

    class Obra extends DataObject {

        protected $datos = array (
            "titulo"       => null,
            "siglo"        => null,
            "autor"        => null,
            "tema"         => null,
            "imagen"       => null,
            "descripcion"  => null 
        );

        //Con esta función se insertará una obra dentro de la tabla obra
        public static function insertarObra(Obra $datosObra){

            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "INSERT INTO Obra (titulo, siglo, autor, tema, imagen, descripcion) VALUES(:titulo, :siglo, :autor, :tema, :imagen, :descripcion)";

            try{
                //Preparar la consulta 
                $st = $conexion->prepare($consulta_sql);
                //Asignar los valores correspondientes a sus parametros
                $st->bindValue( "titulo", $datosObra->datos['titulo'], PDO::PARAM_STR);
                $st->bindValue( "siglo", $datosObra->datos['siglo'], PDO::PARAM_STR);
                $st->bindValue( "autor", $datosObra->datos['autor'], PDO::PARAM_STR);
                $st->bindValue( "tema", $datosObra->datos['tema'], PDO::PARAM_STR);
                $st->bindValue( "imagen", $datosObra->datos['imagen'], PDO::PARAM_STR);
                $st->bindValue( "descripcion", $datosObra->datos['descripcion'], PDO::PARAM_STR);

                //Ejecutarla
                $st->execute();

                //Desconectarme
                parent::desconectar($conexion);
            }
            catch ( PDOException $e ) { 
				parent::desconectar( $conexion ); 
				die( "Consulta para insertar obra fallido: " . $e->getMessage() ); 
			} 
        }

        //Función con la que obtengo todas las obras disponibles
        public static function obtenerObra(){
            
            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "SELECT * FROM Obra";

            try{

                //Preparar la consulta 
                $st = $conexion->prepare( $consulta_sql);
                //Ejecutarla
                $st->execute();

                //Obtener obras como un array asociativo
                $array_obras = $st->FetchAll(PDO::FETCH_ASSOC);

                //Desconectarme
                parent::desconectar($conexion);

                //Devolver obras
                return $array_obras;
            }
            catch ( PDOException $e ) { 
				parent::desconectar( $conexion ); 
				die( "Consulta para obtener obras fallida: " . $e->getMessage() ); 
			} 
        }

        //Mostrar obra, con esta función se muestra la obra, sin la descripción, ya que eso se muestra al hacer click
        public static function mostrarObras(){
            echo '<section class="imagenes">';

            //Recuperamos antes de nada las obras
            $obras = Obra::obtenerObra();

            //Comprobamos que existan obras
            if(!empty($obras)){
                foreach($obras as $obra) {
                    echo '
                    <section>
                        <img src="' . $obra['imagen'] . '" class="img" title="Visualizar obra"> 
                        <article class="art1">
                            <p class="titulo">'. $obra['titulo'] .'</p>
                            <p>Tema: '. $obra['tema'] . '</p>
                            <p>Autor: '. $obra['autor'] . '</p>
                            <p>Fecha: ' . $obra['siglo'] .'</p>
                            <form id="borrar" method="post" action="eliminar_obra.php" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar esta obra?\');">
                                <input type="hidden" name="id" value="' . $obra['id'] . '">
                                <button type="submit" class="btn btn-warning">Eliminar</button>
                            </form>
                            <form id="editar" method="post" action="edicionObra.php">
                                <input type="hidden" name="id" value="' . $obra['id'] . '">
                                <button  type="submit" class="btn btn-warning">Editar</button>
                            </form>
                        </article>
                    </section>'; 
                }
            }
        }

        //Mostrar obras segun el filtro
        public static function mostrarObrasFiltradas($obrasFiltradas){
            if(!empty($obrasFiltradas)){
                foreach($obrasFiltradas as $obraFiltrada) {
                    echo '
                    <section>
                        <a href="obra.php?id=' . $obraFiltrada['id'] . '">
                            <img src="' . $obraFiltrada['imagen'] . '" class="img" data-titulo="' . $obraFiltrada['titulo'] . '" data-tema="' .$obraFiltrada['tema'] .'" title="Visualizar obra">
                            <article class="art1">
                                <p class="titulo">' . $obraFiltrada['titulo'] . '</p>
                                <p>Tema: ' . $obraFiltrada['tema'] . '</p>
                                <p>Autor: ' . $obraFiltrada['autor'] . '</p>
                                <p>Fecha: ' . $obraFiltrada['siglo'] . '</p>
                            </article>
                        </a>
                    </section>';
                }
            }
        }

        //Con esta función el administrador puede eliminar una obra
        public static function eliminarObra($id) {
            
            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "DELETE FROM Obra WHERE id=:id";

            try {

                //Preparar la consulta 
                $st = $conexion->prepare( $consulta_sql);
                //Asignar el valor a la consulta preparada
                $st -> bindValue(':id', $id, PDO::PARAM_INT);
                //Ejecutarla
                $st->execute();
                //Desconectarme
                parent::desconectar($conexion);

            }
            catch ( PDOException $e ) { 
				parent::desconectar( $conexion ); 
				die( "No se pudo borrar la obra: " . $e->getMessage() ); 
			} 

        }
    

        //Con esta función obtengo los valores únicos de la columna especificada, por ejemplo, si le paso tema, me mostrará todos los temas (SIN ESTAR REPETIDOS)
        public static function obtenerFiltro($columnaFiltro){

            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "SELECT DISTINCT $columnaFiltro FROM Obra ORDER BY $columnaFiltro";

            try {

                //Preparar la consulta 
                $st = $conexion->prepare( $consulta_sql);
                //Ejecutarla
                $st->execute();
                //Obtener los valores únicos como un array
                $filtros = $st->fetchAll(PDO::FETCH_COLUMN);
                //Desconectarme
                parent::desconectar($conexion);
                //Devolver los filtros
                return $filtros;
            }
            catch ( PDOException $e ) { 
                parent::desconectar( $conexion ); 
                die( "No se pudo obtener el filtro: " . $e->getMessage() ); 
            } 


        }

        public static function obrasFiltradas($columnaFiltro, $valorFiltro){

            //Inicio la conexión
            $conexion = parent::conectar();
        
            // Consulta a realizar
            if($columnaFiltro !== null && $valorFiltro !== null){
                $consulta_sql = "SELECT * FROM Obra WHERE $columnaFiltro = :valorFiltro";
            }
            else{
                $consulta_sql = "SELECT * FROM Obra";
            }
        
            try {
        
                //Preparar la consulta 
                $st = $conexion->prepare($consulta_sql);
                
                //Asignar el valor del parámetro si se proporciona un filtro
                if($columnaFiltro !== null && $valorFiltro !== null){
                    $st->bindValue(':valorFiltro', $valorFiltro, PDO::PARAM_STR);
                }
                
                //Ejecutarla
                $st->execute();
                
                //Obtener las obras filtradas
                $obrasFiltradas = array();
                while ($obra = $st->fetch(PDO::FETCH_ASSOC)) {
                    $obrasFiltradas[] = $obra;
                }
                
                //Desconectar
                parent::desconectar($conexion);
                
                //Devolver las obras filtradas
                return $obrasFiltradas;
            }
            catch (PDOException $e) { 
                parent::desconectar($conexion); 
                die("No se pudo obtener las obras de ese filtro: " . $e->getMessage()); 
            }
        }

        //Funcion para recuperar los datos de una obra segun su identificador
        public static function obtenerObraId($id){

            //Inicio la conexión
            $conexion = parent::conectar();
            //Consulta a realizar
            $consulta_sql = "SELECT * FROM Obra WHERE id = :id";

            try {
        
                //Preparar la consulta 
                $st = $conexion->prepare($consulta_sql);
                //Asignar el valor del parámetro
                $st->bindValue(':id', $id, PDO::PARAM_STR);
                //Ejecutarla
                $st->execute();
                //Obtener la obra
                $obra = $st->fetch(PDO::FETCH_ASSOC);
                //Desconectar
                parent::desconectar($conexion);
                //Devolver las obras filtradas
                return $obra;
            }
            catch (PDOException $e) { 
                parent::desconectar($conexion); 
                die("No se pudo obtener las obras de ese filtro: " . $e->getMessage()); 
            }
            

        }

        public static function cambiarTitulo($id, $titulo){
            $conexion = parent::conectar();
        
            $consulta_sql = "UPDATE Obra SET titulo = :titulo WHERE id = :id";
        
            try {
                $st = $conexion->prepare($consulta_sql);
                $st->bindValue(':titulo', $titulo, PDO::PARAM_STR);
                $st->bindValue(':id', $id, PDO::PARAM_INT);
                $st->execute();
                parent::desconectar($conexion);
                return "Título actualizado exitosamente.";
            } catch (PDOException $e) {
                parent::desconectar($conexion);
                return "Error cambiando el título: " . $e->getMessage();
            }
        }
        
        public static function cambiarSiglo($id, $siglo){
            $conexion = parent::conectar();
        
            $consulta_sql = "UPDATE Obra SET siglo = :siglo WHERE id = :id";
        
            try {
                $st = $conexion->prepare($consulta_sql);
                $st->bindValue(':siglo', $siglo, PDO::PARAM_STR);
                $st->bindValue(':id', $id, PDO::PARAM_INT);
                $st->execute();
                parent::desconectar($conexion);
                return "Siglo actualizado exitosamente.";
            } catch (PDOException $e) {
                parent::desconectar($conexion);
                return "Error cambiando el siglo: " . $e->getMessage();
            }

        }

        public static function cambiarAutor($id, $autor){
            $conexion = parent::conectar();
        
            $consulta_sql = "UPDATE Obra SET autor = :autor WHERE id = :id";
        
            try {
                $st = $conexion->prepare($consulta_sql);
                $st->bindValue(':autor', $autor, PDO::PARAM_STR);
                $st->bindValue(':id', $id, PDO::PARAM_INT);
                $st->execute();
                parent::desconectar($conexion);
                return "Autor actualizado exitosamente.";
            } catch (PDOException $e) {
                parent::desconectar($conexion);
                return "Error cambiando el autor: " . $e->getMessage();
            }
        }

        public static function cambiarTema($id, $tema){
            $conexion = parent::conectar();
        
            $consulta_sql = "UPDATE Obra SET tema = :tema WHERE id = :id";
        
            try {
                $st = $conexion->prepare($consulta_sql);
                $st->bindValue(':tema', $tema, PDO::PARAM_STR);
                $st->bindValue(':id', $id, PDO::PARAM_INT);
                $st->execute();
                parent::desconectar($conexion);
                return "Tema actualizado exitosamente.";
            } catch (PDOException $e) {
                parent::desconectar($conexion);
                return "Error cambiando el tema: " . $e->getMessage();
            }
        }

        public static function cambiarImagen($id, $imagen){
            $conexion = parent::conectar();
        
            $consulta_sql = "UPDATE Obra SET imagen = :imagen WHERE id = :id";
        
            try {
                $st = $conexion->prepare($consulta_sql);
                $st->bindValue(':imagen', $imagen, PDO::PARAM_STR);
                $st->bindValue(':id', $id, PDO::PARAM_INT);
                $st->execute();
                parent::desconectar($conexion);
                return "Imagen actualizada exitosamente.";
            } catch (PDOException $e) {
                parent::desconectar($conexion);
                return "Error cambiando la imagen: " . $e->getMessage();
            }

        }

        public static function cambiarDescripcion($id, $descripcion){
            $conexion = parent::conectar();
        
            $consulta_sql = "UPDATE Obra SET descripcion = :descripcion WHERE id = :id";
        
            try {
                $st = $conexion->prepare($consulta_sql);
                $st->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
                $st->bindValue(':id', $id, PDO::PARAM_INT);
                $st->execute();
                parent::desconectar($conexion);
                return "Descripcion actualizada exitosamente.";
            } catch (PDOException $e) {
                parent::desconectar($conexion);
                return "Error cambiando la descripcion: " . $e->getMessage();
            }

        }



    }
?>