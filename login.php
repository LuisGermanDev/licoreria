<?php
session_start();
include 'connection.php'; // Incluir archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($hash);
    $stmt->fetch();

    // Verificar contraseña
    if (password_verify($contrasena, $hash)) {
        // Contraseña correcta, redirigir al admin.php
        $_SESSION['correo'] = $correo; // Guardar la sesión
        header("Location: admin.php");
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="">
        <label>Correo:</label><br>
        <input type="email" name="correo" required><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
