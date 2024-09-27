<?php

    require_once('usuario.class.php');
    require_once('comentario.class.php');

    //Si se ha enviado el formulario, se procede a insertar el comentario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Almaceno los datos del comentario en un Array
        $datosComentario = array(
            'titulo'      =>$_POST['titulo'],
            'texto'       =>$_POST['texto'],
            'valoracion'  =>$_POST['valoracion']
        );

        //Creo el comentario llamando a su constructor
        $comentario = new Comentario($datosComentario);

        //Llamo a la funcion para insertar el usuario
        Comentario::insertarComentario($comentario);

        header("Location: experiencias.php");
        exit;


    }

?>