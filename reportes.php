<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php'; // Incluir archivo de conexión

// Consultas para generar reportes
// Total de ventas
$total_ventas_query = "SELECT SUM(total) AS total_ventas FROM ventas";
$total_ventas_result = $conn->query($total_ventas_query);
$total_ventas = $total_ventas_result->fetch_assoc()['total_ventas'];

// Ventas por producto
$ventas_por_producto_query = "
    SELECT p.nombre, SUM(v.cantidad) AS total_cantidad, SUM(v.total) AS total_ventas
    FROM ventas v
    JOIN productos p ON v.producto_id = p.id
    GROUP BY p.nombre
";

$ventas_por_producto_result = $conn->query($ventas_por_producto_query);

// Consultar las facturas generadas
$facturas_query = "SELECT COUNT(*) AS total_facturas FROM facturas";
$facturas_result = $conn->query($facturas_query);
$total_facturas = $facturas_result->fetch_assoc()['total_facturas'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Licorería</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container"><a class="navbar-brand" href="#">Licorería Dani</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="admin.php">Panel de Control</a></li>
                <li class="nav-item"><a class="nav-link" href="productos.php">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="ventas.php">Ventas</a></li>
                <li class="nav-item"><a class="nav-link" href="facturas.php">Facturas</a></li>
                <li class="nav-item"><a class="nav-link" href="reportes.php">Reportes</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>
            </ul>
        </div></div>
    </nav>
    <div class="container mt-4">
        <h3>Reportes de Ventas y Facturas</h3>

        <div class="mb-4">
            <h5>Total de Ventas: <strong>$<?php echo number_format($total_ventas, 2); ?></strong></h5>
            <h5>Total de Facturas Generadas: <strong><?php echo $total_facturas; ?></strong></h5>
        </div>

        <h4>Ventas por Producto</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Total Vendido (Cantidad)</th>
                    <th>Total Ventas ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Listar ventas por producto
                if ($ventas_por_producto_result->num_rows > 0) {
                    while ($row = $ventas_por_producto_result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nombre']}</td>
                                <td>{$row['total_cantidad']}</td>
                                <td>$" . number_format($row['total_ventas'], 2) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay ventas registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
      <p>&copy; 2024 Tu Licoreria Dani Todos los derechos reservados. Prohibida su reproducción total o parcial sin autorización.</p>
    </footer>
    <!-- Scripts de JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
