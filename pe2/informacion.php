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
        <link rel="stylesheet" type="text/css" href="css/informacion.css">
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

            <!-- Como llegar al museo-->
            <section id="ubicacion">
                <h2 class="titulo">¿Dónde nos encontramos?</h2>
                <iframe  src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d50850.14311646201!2d-3.6657503725853298!3d37.19704786667426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m5!1s0xd71fc55025f928b%3A0x4dbbca09efdcad08!2sgoogle%20maps%20etsiit!3m2!1d37.197055!2d-3.6245507!4m0!5e0!3m2!1ses!2ses!4v1713974500664!5m2!1ses!2ses" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>

            <h2 class="titulo">¿Cuando abrimos?</h2>
            
            <!-- Apertura del museo-->
            <section id="apertura">
  
                <!-- Calendario de abril -->
                <section class="mes">

                    <table>
                        <tr>
                          <th colspan="5">Abril</th>
                        </tr>
                        <tr>
                          <th>Lunes</th>
                          <th>Martes</th>
                          <th>Miércoles</th>
                          <th>Jueves</th>
                          <th>Viernes</th>
                        </tr>
                        <tr>
                          <td><p class="abro">1</p></td>
                          <td><p class="abro">2</p></td>
                          <td><p class="abro">3</p></td>
                          <td><p class="abro">4</p></td>
                          <td><p class="abro">5</p></td>
                        </tr>
                        <tr>
                          <td><p class="mañana">8</p></td>
                          <td><p class="mañana">9</p></td>
                          <td><p class="mañana">10</p></td>
                          <td><p class="mañana">11</p></td>
                          <td><p class="mañana">12</p></td>
                        </tr>
                        <tr>
                          <td><p class="abro">15</p></td>
                          <td><p class="abro">16</p></td>
                          <td><p class="abro">17</p></td>
                          <td><p class="abro">18</p></td>
                          <td><p class="abro">19</p></td>
                        </tr>
                        <tr>
                          <td><p class="mañana">22</p></td>
                          <td><p class="mañana">23</p></td>
                          <td><p class="mañana">24</p></td>
                          <td><p class="mañana">25</p></td>
                          <td><p class="mañana">26</p></td>
                        </tr>
                        <tr>
                          <td><p class="abro">29</p></td>
                          <td><p class="abro">30</p></td>
                          <td colspan="3"></td>
                        </tr>
                    </table>
                                    
                </section>
                
              <!-- Calendario de mayo -->
                <section class="mes">

                    <table>
                        <tr>
                          <th colspan="5">Mayo</th>
                        </tr>
                        <tr>
                          <th>Lunes</th>
                          <th>Martes</th>
                          <th>Miércoles</th>
                          <th>Jueves</th>
                          <th>Viernes</th>
                        </tr>
                        <tr>
                          <td colspan="2"></td>
                          <td><p class="abro">1</p></td>
                          <td><p class="abro">2</p></td>
                          <td><p class="abro">3</p></td>
                        </tr>
                        <tr>
                          <td><p class="mañana">6</p></td>
                          <td><p class="mañana">7</p></td>
                          <td><p class="mañana">8</p></td>
                          <td><p class="mañana">9</p></td>
                          <td><p class="mañana">10</p></td>
                        </tr>
                        <tr>
                          <td><p class="abro">13</p></td>
                          <td><p class="abro">14</p></td>
                          <td><p class="abro">15</p></td>
                          <td><p class="abro">16</p></td>
                          <td><p class="abro">17</p></td>
                        </tr>
                        <tr>
                          <td><p class="mañana">20</p></td>
                          <td><p class="mañana">21</p></td>
                          <td><p class="mañana">22</p></td>
                          <td><p class="mañana">23</p></td>
                          <td><p class="mañana">24</p></td>
                        </tr>
                        <tr>
                          <td><p class="abro">27</p></td>
                          <td><p class="abro">28</p></td>
                          <td><p class="abro">29</p></td>
                          <td><p class="abro">30</p></td>
                          <td><p class="abro">31</p></td>
                        </tr>
                    </table>          
                </section>

                <!-- Calendario de junio -->
                <section class="mes">
                  <table>
                      <tr>
                        <th colspan="5">Junio</th>
                      </tr>
                      <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                      </tr>
                      <tr>
                        <td><p class="cierro">3</p></td>
                        <td><p class="cierro">4</p></td>
                        <td><p class="cierro">5</p></td>
                        <td><p class="cierro">6</p></td>
                        <td><p class="cierro">7</p></td>
                      </tr>
                      <tr>
                        <td><p class="cierro">10</p></td>
                        <td><p class="cierro">11</p></td>
                        <td><p class="cierro">12</p></td>
                        <td><p class="cierro">13</p></td>
                        <td><p class="cierro">14</p></td>
                      </tr>
                      <tr>
                        <td><p class="cierro">17</p></td>
                        <td><p class="cierro">18</p></td>
                        <td><p class="cierro">19</p></td>
                        <td><p class="cierro">20</p></td>
                        <td><p class="cierro">21</p></td>
                      </tr>
                      <tr>
                        <td><p class="cierro">24</p></td>
                        <td><p class="cierro">25</p></td>
                        <td><p class="cierro">26</p></td>
                        <td><p class="cierro">27</p></td>
                        <td><p class="cierro">28</p></td>
                      </tr>
                  </table>        
              </section>
            </section>

            <!-- Precio de las entradas-->
            <section id="precio">
                <h2 class="titulo">¿Cual es el precio de las entradas?</h2>
                <article>
                  <p> ¡ Las entradas son completamente gratuitas para todo el mundo !</p>
                </article>
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