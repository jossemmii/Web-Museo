<?php

    //Iniciamos una sesión
    session_start();

    require_once('usuario.class.php');

    //Al iniciar sesión el usuario, llamamos a la función que comprueba que el usuario exista en la base de datos.
    //Si este usuario existe, obtengo su atributo admin y lo guardo en una variable de Sesión.
    //Si admin = 'Y' quiere decir que el usuario es administrador

    //Si se ha enviado el formulario, se procede
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Antes de nada obtengo el usuario y la contraseña
        $usuario = $_POST['usuario'];
        $pass    = $_POST['pass'];

        $existeUsuario = Usuario::existeUsuario($usuario, $pass);

        if ($existeUsuario){

            $_SESSION['USER']  = $usuario;
            $admin = Usuario::esAdmin($usuario);
            $_SESSION['ADMIN'] = $admin;

            header("Location: index.php");
            exit;
        }
        else{
            echo '<script>alert("Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo."); window.location.href = "index.php";</script>';
            exit;
        }
    }
?>