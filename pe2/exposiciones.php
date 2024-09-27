<?php
    //Iniciar una sesión
    session_start();
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
        <link rel="stylesheet" type="text/css" href="css/exposiciones.css">
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

            <section id="expo1">
                <article id="texto1">
                    <h2> Exposición IA</h2>
                    <p> Pasate para descubrir esta exposición temporal acerca de la Inteligencia Artifical, dónde tendremos expuesto todo tipo de cosas relacionadas.</p>
                </article>
                <img id="img1" width="400px" height="400px" src="ImagenesObras/exposicion1.jpg" title="Exposición sobre IA"/>
            </section>

            <section id="expo2">
                <article id="texto2">
                    <h2> Exposición Computación Cuántica</h2>
                    <p> Pasate para descubrir esta exposición temporal acerca de la Computación Cuántica, dónde tendremos expuesto todo tipo de cosas relacionadas.</p>
                </article>
                <img id="img2" width="400px" height="400px" src="ImagenesObras/exposicion2.jpg" title="Exposicion sobre Computación Cuántica"/>
            </section>

        </main>

        <footer>
            <ul>
                <li id="contacto"><a class="btn btn-danger" href="contacto.php" >Contacto</a></li>
                <li id="como"><a class="btn btn-danger" href="como_se_hizo.pdf" >Como se hizo</a></li>
            </ul>
        </footer>

    </body>

    <script src="reloj.js"></script>

</html>