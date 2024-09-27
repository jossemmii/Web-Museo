<?php

    require_once('obra.class.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $imagen = $_POST['imagen'];

        try {
            Obra::cambiarImagen($id, $imagen);

            //Redirigimos
            header("Location: gestionarObras.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al editar la imagen " . $e->getMessage();
        }
    }

?>