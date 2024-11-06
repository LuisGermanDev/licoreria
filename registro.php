<?php
include 'connection.php'; // Incluir archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hash para mayor seguridad

    // Preparar y vincular
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="post" action="">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Correo:</label><br>
        <input type="email" name="correo" required><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
