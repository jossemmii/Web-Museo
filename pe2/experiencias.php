
<?php
    //Iniciar una sesión
    session_start();

    require_once('comentario.class.php');
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
        <link rel="stylesheet" type="text/css" href="css/experiencias.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
    
    </head>

    <body>
        
        <!--Imagen de fondo del index-->
        <img id="fondo" src="Imagenes/imagen_fondo.jpg"/>

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

            <!-- Parte de php para gestionar que va a ver cada usuario -->
            <?php

                //Si la variable de sesión no es vacía quiere decir que el usuario ya ha iniciado sesión
                if(!empty($_SESSION['USER'])){
                    //Obtengo nombre de usuario
                    $nombre_usuario = $_SESSION['USER'];
                    //Obtengo si es admin o no
                    $admin = $_SESSION['ADMIN']['admin'];

                    //Si el usuario es administrador, podrá borrar aquellos comentarios que considere no apropiados
                    if($admin == 'Y'){
                        echo '<h2 id="tituloAdmin"> Bienvenido administrador, gestione los comentarios </h2>';
                        //Añadir gestión de comentarios
                        Comentario::mostrarComentarios();
                    }
                    //Si el usuario no es administrador, podrá añadir comentarios
                    else {
                        //Gestionar el añadir comentarios
                        echo '<article>
                                <h2>¡Comente su experiencia en la caja de abajo!</h2>
                              </article>

                              <section id="comentarios">
                                <form id="formularioComentario" action="realizar_comentario.php" method="post" onsubmit="return validarExperiencia()">
                                  <section id="tituloReseña">
                                      <label for="titulo">Título:</label>
                                      <input type="text" class="form-control" id="titulo" name="titulo">
                                  </section>
                                  <section id="textoReseña">
                                      <label for="texto">Texto:</label>
                                      <textarea class="form-control" id="texto" name="texto" rows="5"></textarea>
                                  </section>
                                  <section id="textoValoracion">
                                      <label for="valoracion">Valoración:</label>
                                      <select class="form-control" id="valoracion" name="valoracion">
                                          <option value="">Selecciona una valoración</option>
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                      </select>
                                  </section>
                                  <button type="submit" id="submit" class="btn btn-danger">Enviar comentario</button>
                                </form>
                             </section>';

                        Comentario::mostrarComentarios();
                    }
                }

                //Si el usuario no está iniciada su sesión, se le indicará que se registre en la caja de arriba
                else{
                    
                    echo '<h2 id="tituloNo"> Inicie sesión en la caja de arriba o <a href="altausuarios.php">regístrese</a> para comentar su experiencia
                                y visualizar los comentarios</h2>';

                }
            ?>

        </main>

        <footer>
            <ul>
                <li id="contacto"><a class="btn btn-danger" href="contacto.php" >Contacto</a></li>
                <li id="como"><a class="btn btn-danger" href="como_se_hizo.pdf" >Como se hizo</a></li>
            </ul>
        </footer>

    </body>

    <script src="comprobacionFormularios.js"></script>
    <script src="reloj.js"></script>


</html>