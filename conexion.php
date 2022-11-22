<?php
$servidor="localhost:3306";
$basedatos = "noticias";
$usuario = "root";
$contrasena = "";

//Establecimiento de las conexiones de base de datos
&conn = new mysqli($servidor, $usuario, $contrasena, $basedatos);
if ($conn->connect_error){
    //Arroja error si es que llegase a fallar la conexion hacia la base de datos
    die("fallo conexion". $conn->connect_error);
}

?>
