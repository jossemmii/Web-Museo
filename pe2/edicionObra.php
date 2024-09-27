<?php
    //Iniciar una sesión
    session_start();

    require_once('obra.class.php');

    $admin = $_SESSION['ADMIN']['admin'];
    if ($admin != 'Y'){
        echo 'NO TIENES ACCESO SI NO ERES ADMINISTRADOR.';
        echo 'VUELVE AL INICIO';
        echo '<a href="index.php"> Inicio </a>';
        exit();
    }
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
        <link rel="stylesheet" type="text/css" href="css/aniadirObras.css">
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

            <h2 id="tit1" > Edita la obra </h2>

            <?php

                $id = $_POST['id'];
            
            
            
                echo'<section id="aniadir">
                    
                    <form action="realizar_cambiartitulo.php" method="post" onsubmit="return validarCambiarTitulo()">
                        <input type="hidden" name="id" value="' . $id . '">
                        <label for="titulo">Editar Título:</label>
                        <input type="text" id="titulo" name="titulo">
                        <button type="submit">Enviar</button>
                    </form>


                    <form action="realizar_cambiarsiglo.php" method="post" onsubmit="return validarCambiarSiglo()">
                        <input type="hidden" name="id" value="' . $id . '">
                        <label for="siglo">Editar Siglo:</label>
                        <input type="text" id="siglo" name="siglo">
                        <button type="submit">Enviar</button>
                    </form>

                    <form action="realizar_cambiarautor.php" method="post" onsubmit="return validarCambiarAutor()">
                        <input type="hidden" name="id" value="' . $id . '">
                        <label for="autor">Editar Autor:</label>
                        <input type="text" id="autor" name="autor">
                        <button type="submit">Enviar</button>
                    </form>

                    <form action="realizar_cambiartema.php" method="post" onsubmit="return validarCambiarTema()">
                        <input type="hidden" name="id" value="' . $id . '">
                        <label for="tema">Editar Tema:</label>
                        <input type="text" id="tema" name="tema">
                        <button type="submit">Enviar</button>
                    </form>

                    <form action="realizar_cambiarimagen.php" method="post" onsubmit="return validarCambiarImagen()">
                        <input type="hidden" name="id" value="' . $id . '">
                        <label for="imagen" id="campo" >Editar Imagen:</label>
                        <select id="imagen" name="imagen">
                            <option value="ImagenesObras/2010_1.jpg">MacBook Air</option>
                            <option value="ImagenesObras/logitech1.jpg">Cascos Logitech</option>
                            <option value="ImagenesObras/logitech2.jpg">Volante Logitech</option>
                            <option value="ImagenesObras/microsoft1.jpg">XBox</option>
                            <option value="ImagenesObras/microsoft2.webp">Microsoft Hololens</option>
                            <option value="ImagenesObras/microsoft3.jpg">Surface Pro 9</option>
                            <option value="ImagenesObras/nvidia1.jpg">RTX 4060</option>
                            <option value="ImagenesObras/nvidia2.jpg">Nvidia Grace</option>
                            <option value="ImagenesObras/nvidia3.jpg">GeForce 256</option>
                            <option value="ImagenesObras/ordenador1.jpeg">Apple II</option>
                            <option value="ImagenesObras/ordenador2.jpeg">Altair 8800</option>
                            <option value="ImagenesObras/ordenador3.jpeg">Atari 800</option>
                            <option value="ImagenesObras/ordenador4.jpeg">HP 100 LX</option>
                            <option value="ImagenesObras/raton1.jpg">Raton Logitech</option>
                            <option value="ImagenesObras/raton2.png">Raton Microsoft</option>
                            <option value="ImagenesObras/raton3.jpg">Raton Mars Gaming</option>
                            <option value="ImagenesObras/raton4.jpg">Raton HP</option>
                            <option value="ImagenesObras/teclado1.jpg">Teclado IBM</option>
                            <option value="ImagenesObras/teclado2.jpg">Teclado GeForce</option>
                            <option value="ImagenesObras/teclado3.png">Teclado Logitech</option>
                            <option value="ImagenesObras/teclado4.jpg">Teclado Clevy</option>
                        </select>
                        <button type="submit">Enviar</button>
                    </form>

                    <form action="realizar_cambiardescripcion.php" method="post" onsubmit="return validarCambiarDescripcion()">
                        <input type="hidden" name="id" value="' . $id . '">
                        <label for="descripcion">Editar Descripción:</label>
                        <textarea id="descripcion" name="descripcion" rows="5"></textarea>
                        <button type="submit">Enviar</button>
                    </form>

                </section>'

            ?>

            <h2 id="tit2"> Obra que quieres editar </h2>

            <?php
                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];

                        $obra = Obra::obtenerObraId($id);

                        echo '
                        <section>
                                <img src="' . $obra['imagen'] . '" class="img">
                                <article class="art1">
                                    <p class="titulo">' . $obra['titulo'] . '</p>
                                    <p>Tema: ' . $obra['tema'] . '</p>
                                    <p>Autor: ' . $obra['autor'] . '</p>
                                    <p>Fecha: ' . $obra['siglo'] . '</p>
                                    <p>Descripcion: ' . $obra['descripcion'] . '</p>
                                </article>
                        </section>';
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
    <script src="reloj.js"></script>
    <script src="comprobacionFormularios.js"></script>

</html>