<?php

    require_once('obra.class.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $descripcion = $_POST['descripcion'];

        try {
            Obra::cambiarDescripcion($id, $descripcion);

            //Redirigimos
            header("Location: gestionarObras.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al editar la descripcion: " . $e->getMessage();
        }
    }

?>