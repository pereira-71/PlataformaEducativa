<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'plataforma_educativa';
$username = 'root';
$password = ''; // Contraseña de la base de datos

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
