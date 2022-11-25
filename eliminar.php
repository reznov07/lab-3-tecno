<?php
    include 'includes/funciones/conexion.php';
    $id = $_GET['id'];
    //Insertamos los datos con lo que conseguimos con el método POST
    $sql = "DELETE FROM noticias WHERE id = '$id'";

    $resultado = mysqli_query($conn, $sql);
    if (!$resultado) {
        echo "No se ha podido insertar los valores";
    } else {
        header("Location: administrar.php");
    }
?>