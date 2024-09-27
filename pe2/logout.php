<?php

//Inicio sesión
session_start();

//Elimino las variables de sesión
session_unset();

//Destruyo la sesion
session_destroy();

//Redirigo al index
header("Location: index.php");

?>