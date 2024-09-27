<?php

    require_once('obra.class.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $siglo = $_POST['siglo'];

        try {
            Obra::cambiarSiglo($id, $siglo);

            //Redirigimos
            header("Location: gestionarObras.php");
            exit;
        }
        catch (Exception $e) {
            echo "Error al editar el siglo: " . $e->getMessage();
        }
    }

?>