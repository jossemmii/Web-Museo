<?php

    require_once('obra.class.php');

    //Si se ha enviado el formulario, se procede a eliminar la obra
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Obtengo el identificador del comentario enviado al pulsar el botón
        $id = $_POST['id'];

        try {

            //Se borra el comentario llamando a su método
            Obra::eliminarObra($id);

            //Redirigimos
            header("Location: gestionarObras.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al eliminar la obra: " . $e->getMessage();
        }

    }
    else{
        echo 'No ha podido ser eliminada la obra';
    }

?>