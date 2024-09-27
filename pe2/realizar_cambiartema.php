<?php

    require_once('obra.class.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $tema = $_POST['tema'];

        try {
            Obra::cambiarTema($id, $tema);

            //Redirigimos
            header("Location: gestionarObras.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al editar el tema: " . $e->getMessage();
        }
    }

?>