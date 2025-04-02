<?php
//  Formulario de login
session_start();
if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor-principal">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Ingresar">
    </form>
    <p>No tienes cuenta? <a href="register.php">Registrarse</a></p>   

    </div>
    
</body>
</html>
