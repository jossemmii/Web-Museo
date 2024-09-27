<?php

    require_once('obra.class.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $autor = $_POST['autor'];

        try {
            Obra::cambiarAutor($id, $autor);

            //Redirigimos
            header("Location: gestionarObras.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al editar el autor: " . $e->getMessage();
        }
    }

?>