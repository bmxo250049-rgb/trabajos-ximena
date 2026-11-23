<?php
$servidor = "localhost";
$usuario = "root";
$password = ""; // En XAMPP por defecto va vacío
$bd = "tienda_prueba";

$conn = new mysqli($servidor, $usuario, $password, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Configurar caracteres especiales (tildes y eñes)
$conn->set_charset("utf8");
?>