<?php
// Procesa el login
session_start();
include('db.php');

// Verifica si el usuario ya está logueado
if (isset($_SESSION['email'])) {
    // Si ya está logueado, redirige al dashboard
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Credenciales incorrectas'); window.location='login.php';</script>";
        }
    } else {
        // echo "<script>alert('Usuario no encontrado'); window.location='login.php';</script>";
        echo "<div class='contenedor-principal'><div class='mensaje'>Usuario no encontrado</div></div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor-principal">
    <h2>Formulario de Ingreso</h2>
    <form action="login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    </div>

</body>
</html>
