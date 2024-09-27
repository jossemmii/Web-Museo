<?php

    require_once('comentario.class.php');

    //Si se ha enviado el formulario, se procede a eliminar el comentario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Obtengo el identificador del comentario enviado al pulsar el botón
        $idComentario = $_POST['idComentario'];

        try {

            //Se borra el comentario llamando a su método
            Comentario::eliminarComentario($idComentario);

            //Redirigimos
            header("Location: experiencias.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al eliminar el comentario: " . $e->getMessage();
        }

    }
    else{
        echo 'No ha podido ser eliminado el comentario';
    }

?>