<?php
    //Iniciar una sesión
    session_start();

    require_once('obra.class.php');
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <!-- Codificacion -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Titulo en el navegador -->
        <title> Museo Nacional de la ETSIIT </title>
        <!-- Mis datos como autor -->
        <meta name="autor" content="Jose Miguel Aguado Coca">
        <link rel="stylesheet" type="text/css" href="css/coleccion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="comprobacionFormularios.js"></script>
        <script src="ventanaFlotante.js"></script>
    </head>

    <body>

        <!-- Cabecera del documento index.php -->
        <header>
            <!-- Imagen del museo generada por IA -->
            <img id="logo" src="Imagenes/logotipo.png" alt="Logo de Museo" title="Museo Nacional de la ETSIIT"/>
            <!-- Titulo -->
            <h1> Museo Nacional de la ETSIIT </h1>

            <!-- Gestionar inicio de sesión y administrador -->
            <?php

                //Si la variable de sesión no es vacía quiere decir que el usuario ya ha iniciado sesión
                if(!empty($_SESSION['USER'])){
                    //Obtengo nombre de usuario
                    $nombre_usuario = $_SESSION['USER'];
                    //Obtengo si es admin o no
                    $admin = $_SESSION['ADMIN']['admin'];

                    //Si es administrador, además de un apartado para hacer logout, tendrá un apartado en el que añadir las obras
                    if($admin == 'Y'){
                        echo '<section id="nuevo">
                                    <p id="sesionUsuario"> Usuario: ' . $nombre_usuario . '</p>
                                    <span id="tiempo">00: 00 : 00</span>
                                    <a id="enlaceObras" href="gestionarObras.php">Gestionar obras</a>
                                    <a id="logout" class="btn btn-danger" href="logout.php" >Logout</a>
                              </section>';
                    }
                    else{
                        echo '<section id="nuevo">
                                    <p id="sesionUsuario"> Usuario: ' . $nombre_usuario . '</p>
                                    <span id="tiempo">00: 00 : 00</span>
                                    <a id="logout" class="btn btn-danger" href="logout.php" >Logout</a>
                              </section>';
                    }
                }
                //Si no ha iniciado sesión, se le mostrará el formulario de inicio de sesión
                else{
                    
                    echo '<!-- Formulario para alta de usuarios -->
                    <form id="formulario-inicio" action="realizar_loginusuario.php" method="post" onsubmit="return validarLogin()">
                        <h2>Inicio de Sesión</h2>
                        <label for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario">
                        <br>
                        <label for="pass">Contraseña</label>
                        <input type="password" id="pass" name="pass">
                        <br>
                        <input type="submit" id="enviar" value="Enviar">
                        <!-- Boton Alta -->
                        <a id="altauser" href="altausuarios.php" >Alta Usuario</a>
                    </form>';
                }
            ?>

            <!-- Menu de opciones -->
            <nav>
               <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="coleccion.php">Colección</a></li>
                <li><a href="visita.php">Visita</a></li>
                <li><a href="exposiciones.php">Exposiciones</a></li>
                <li><a href="informacion.php">Información</a></li>
                <li><a href="experiencias.php">Experiencias</a></li>
               </ul> 
            </nav>
        </header>

        <main>
            <!--Menú de navegación lateral-->
            <aside class="aside">
                
                <?php
                
                    //Obtengo los valores de los temas, autores y siglo
                    $temas = Obra::obtenerFiltro('tema');
                    $siglos = Obra::obtenerFiltro('siglo');
                    $autores = Obra::obtenerFiltro('autor');
                
                    //Mostrar Temas
                    echo '<h2>Tema</h2>';
                    echo "<ul>";
                    //Recorro cada array y obtengo los enlaces
                    foreach ($temas as $tema) {
                        $url = "coleccion.php?tema=" . $tema ;
                        echo "<li><a class='enlace' href='$url'>" . $tema . "</a></li>";
                    }
                    echo "<ul>";
                    
                    echo '<h2>Siglo</h2>';
                    echo "<ul>";
                    //Mostrar Siglos
                    foreach ($siglos as $siglo) {
                        $url = "coleccion.php?siglo=" . $siglo ;
                        echo "<li><a class='enlace' href='$url'>" . $siglo . "</a></li>";
                    }
                    echo "<ul>";

                    echo '<h2>Autor</h2>';
                    echo "<ul>";
                    //Mostrar Siglos
                    foreach ($autores as $autor) {
                        $url = "coleccion.php?autor=" . $autor;
                        echo "<li><a class='enlace' href='$url'>" . $autor . "</a></li>";
                    }
                    echo "<ul>";

                    //Con el isset verificamos los parametros que hay en la url
                    if(isset($_GET['tema'])) {
                        $columna = 'tema';
                        $valor = $_GET['tema'];
                    }
                    else if(isset($_GET['siglo'])){
                        $columna = 'siglo';
                        $valor = $_GET['siglo'];
                    }
                    else if(isset($_GET['autor'])){
                        $columna = 'autor';
                        $valor = $_GET['autor'];
                    }
                    else{
                        $columna = null;
                        $valor = null;
                    }
                    
                    //Llamamos a la función para obtener las obras por ese filtro
                    $obras = Obra::obrasFiltradas($columna, $valor);

                    //Hago un recuento del total de obras que hay
                    $totalObras = count($obras);

                    //Voy a gestionar la paginacion
                    $limiteObras = 9;

                    //Obtenemos el numero de página actual, si no hay ningún numero de página, se pone que es la página 1
                    $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                    //Calculo el total de páginas que van a hacer falta, redondeando hacia arriba
                    //Por ejemplo, si tengo 11 obras, 11/9 = 1,2. Por lo tanto, hacen falta 2 páginas
                    $paginasNecesarias = ceil($totalObras / $limiteObras);

                    //Necesito un índice para saber por el índice del array por el que voy a comenzar obteniendo las páginas
                    //Por ejemplo, si estamos en la página 1, (1-1) * 9 = 0, el índice por el que comenzar en el array es el 0
                    $indice = ($paginaActual - 1) * $limiteObras;

                    //Calculo la porción de obras del array que se van a mostrar en la página
                    //Para ello uso array_slice, al que se le pasa el array, el inicio, y la longitud de elementos a extraer
                    $obrasPagina = array_slice($obras, $indice, $limiteObras);
                ?>

                <?php
                    function generarUrlPaginacion($valor, $paginaActual, $columna) {
                        if ($columna === 'tema') {
                            return "?tema=$valor&page=$paginaActual";
                        } elseif ($columna === 'siglo') {
                            return "?siglo=$valor&page=$paginaActual";
                        } elseif ($columna === 'autor') {
                            return "?autor=$valor&page=$paginaActual";
                        } else {
                            return "?page=$paginaActual";
                        }
                    }
                ?>

                <?php if($paginaActual > 1) : ?>
                    <a href="<?php echo generarUrlPaginacion($valor, $paginaActual - 1, $columna); ?>">
                        <img id="izquierda" src="Imagenes/flecha_izquierda.png" title="Página anterior"/>
                    </a>
                <?php endif; ?>

                <?php if($paginaActual < $paginasNecesarias) :?>
                    <a href="<?php echo generarUrlPaginacion($valor, $paginaActual + 1, $columna); ?>">
                        <img id="derecha" src="Imagenes/flecha_derecha.png" title="Siguiente página"/>
                    </a>
                <?php endif; ?>

                
            </aside>

            <!--Section que contendrá las imágenes-->
            <section class="imagenes">
                <?php
                    //Mostramos todas las obras de la página que le corresponde
                    Obra::mostrarObrasFiltradas($obrasPagina);
                ?>
            </section>

        </main>

        <footer>
            <ul>
                <li id="contacto"><a class="btn btn-danger" href="contacto.php" >Contacto</a></li>
                <li id="como"><a class="btn btn-danger" href="como_se_hizo.pdf" >Como se hizo</a></li>
            </ul>
        </footer>

    </body>

    
    
    

</html>