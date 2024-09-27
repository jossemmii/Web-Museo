<?php

    require_once('usuario.class.php');

    //Si se ha enviado el formulario, se procede a insertar el usuario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Almaceno los datos del usuario en un Array
        $datosUsuario = array(
            'dni'        =>$_POST['dni'],
            'usuario'    =>$_POST['usuario'],
            'pass'       =>$_POST['pass'],
            'email'      =>$_POST['email'],
            'nombre'     =>$_POST['nombre'],
            'apellido1'  =>$_POST['apellido1'],
            'apellido2'  =>$_POST['apellido2'],
            'direccion'  =>$_POST['direccion']
        );

        //Creo el usuario llamando a su constructor
        $usuario = new Usuario($datosUsuario);

        //Llamo a la funcion para insertar el usuario
        Usuario::insertarUsuario($usuario);

        header("Location: index.php");
        exit;


    }

?>
