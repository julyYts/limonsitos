<?php
$servidor = "localhost";
$usuario = "root";
$password = "yolo42069"; 
$base_datos = "acopio_limon";

$conn = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión con la base de datos: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>