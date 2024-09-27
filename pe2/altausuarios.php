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
        <link rel="stylesheet" type="text/css" href="css/altausuario.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="comprobacionFormularios.js"></script>
    
    </head>

    <body>
                <!--Imagen de fondo del index-->
                <img id="fondo" src="Imagenes/imagen_fondo.jpg"/>
        
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

            <section id="registro">
                <form action="realizar_altausuarios.php" method="POST" onsubmit="return validarRegistro()">
                    <label for="dni">DNI:</label>
                    <input type="text" class="campo" name="dni" id="dni">
                    
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="campo" name="usuario" id="usuario">
                    
                    <label for="pass">Contraseña:</label>
                    <input type="password" class="campo" name="pass" id="pass">
                    
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="campo" name="email" id="email">
                    
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="campo" name="nombre" id="nombre">
                    
                    <label for="apellido1">Primer Apellido:</label>
                    <input type="text" class="campo" name="apellido1" id="apellido1">

                    <label for="apellido2">Segundo Apellido:</label>
                    <input type="text" class="campo" name="apellido2" id="apellido2">
                    
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="campo" name="direccion" id="direccion">
                    
                    <button type="submit" id="send">Registrarse</button>
                </form>
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