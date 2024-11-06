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

// Verificar si hay ventas asociadas al producto
$stmt = $conn->prepare("SELECT COUNT(*) FROM ventas WHERE producto_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($ventas_count);
$stmt->fetch();
$stmt->close();

if ($ventas_count > 0) {
    // Si hay ventas asociadas, mostrar un mensaje
    echo "<script>alert('No se puede eliminar el producto porque está asociado a una venta.');</script>";
    echo "<script>window.location.href = 'productos.php';</script>";
    exit();
}

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
