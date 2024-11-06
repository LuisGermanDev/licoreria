<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

// Aquí va el contenido de la página admin.php
echo "Bienvenido al panel de administración, " . $_SESSION['correo'];
?>
<a href="logout.php">Cerrar sesión</a>
