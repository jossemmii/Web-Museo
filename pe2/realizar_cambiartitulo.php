<?php

    require_once('obra.class.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];

        try {
            Obra::cambiarTitulo($id, $titulo);

            //Redirigimos
            header("Location: gestionarObras.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al editar el titulo: " . $e->getMessage();
        }
    }

?>