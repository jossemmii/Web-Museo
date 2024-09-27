<?php

    require_once('obra.class.php');

    //Si se ha enviado el formulario, se procede a insertar la obra
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Almaceno los datos de la obra en un Array
        $datosObra = array(
            'titulo'      =>$_POST['titulo'],
            'siglo'       =>$_POST['siglo'],
            'autor'  =>$_POST['autor'],
            'tema'  =>$_POST['tema'],
            'imagen'  =>$_POST['imagen'],
            'descripcion'  =>$_POST['descripcion'],
        );

        //Creo el comentario llamando a su constructor
        $obra = new Obra($datosObra);

        //Llamo a la funcion para insertar el usuario
        Obra::insertarObra($obra);

        header("Location: gestionarObras.php");
        exit;


    }

?>