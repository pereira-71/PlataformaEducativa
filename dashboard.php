<?php
// Página protegida para el usuario
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

echo "Bienvenido, " . $_SESSION['email'] . "<br>";
echo "Rol: " . $_SESSION['role'] . "<br>";
?>

<a href="logout.php">Cerrar sesión</a>
