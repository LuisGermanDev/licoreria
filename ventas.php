<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php'; // Incluir archivo de conexión

// Manejar la venta
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $total = 0;

    // Obtener el precio del producto
    $stmt = $conn->prepare("SELECT precio FROM productos WHERE id = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $stmt->bind_result($precio);
    $stmt->fetch();
    $stmt->close();

    if ($precio) {
        $total = $precio * $cantidad;

        // Insertar la venta en la base de datos
        $stmt = $conn->prepare("INSERT INTO ventas (producto_id, cantidad, total) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $producto_id, $cantidad, $total);

        if ($stmt->execute()) {
            echo "Venta registrada exitosamente.";
        } else {
            echo "Error al registrar la venta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Producto no encontrado.";
    }
}

// Consulta para obtener la lista de ventas
$query = "SELECT v.id, p.nombre, v.cantidad, v.total, v.fecha FROM ventas v JOIN productos p ON v.producto_id = p.id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas - Licorería</title>
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
        <h3>Registrar Nueva Venta</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="producto_id">Producto:</label>
                <select class="form-control" id="producto_id" name="producto_id" required>
                    <option value="">Seleccione un producto</option>
                    <?php
                    // Obtener la lista de productos para el dropdown
                    $productos_query = "SELECT id, nombre FROM productos";
                    $productos_result = $conn->query($productos_query);
                    while ($producto = $productos_result->fetch_assoc()) {
                        echo "<option value='{$producto['id']}'>{$producto['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
        </form>

        <h3 class="mt-4">Ventas Registradas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Listar las ventas registradas en la tabla
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['cantidad']}</td>
                                <td>{$row['total']}</td>
                                <td>{$row['fecha']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay ventas registradas.</td></tr>";
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
