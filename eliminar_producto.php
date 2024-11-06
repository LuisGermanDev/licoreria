<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php'; // Incluir archivo de conexión

// Verificar si se ha pasado el ID del producto
if (!isset($_GET['id'])) {
    header("Location: productos.php"); // Redirigir si no se especifica un ID
    exit();
}

$id = $_GET['id'];

// Preparar y ejecutar la consulta para eliminar el producto
$stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Producto eliminado exitosamente.";
    header("Location: productos.php"); // Redirigir a la lista de productos
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
