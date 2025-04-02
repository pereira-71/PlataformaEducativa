<?php
// Formulario de registro y procesado
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Encriptar la contraseña antes de guardarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO users (first_name, last_name, email, password, role) 
            VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        // echo "Registro exitoso. Puedes <a href='login.php'>iniciar sesión</a> ahora.";
        echo "<div class='mensaje'>Registro exitoso. <a href='login.php'>Iniciar sesión</a></div>";
    } else {
        echo "Error al registrar: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor-principal">

    <h2>Formulario de Registro</h2>
    <form action="register.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="first_name" required><br>
        <label>Apellido:</label>
        <input type="text" name="last_name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br>
        <label>Confirmar Contraseña:</label>
        <input type="password" name="confirm_password" required><br>
        <label>Rol:</label>
        <select name="role">
            <option value="student">Estudiante</option>
            <option value="teacher">Profesor</option>
        </select><br>
        <input type="submit" value="Registrar">
    </form>

    </div>
    
</body>
</html>
