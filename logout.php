<?php
session_start();
session_destroy(); // Destruir todas las sesiones
header("Location: index.php"); // Redirigir al login
exit();
?>
