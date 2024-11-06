<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php'; // Incluir archivo de conexión

// Manejar la generación de facturas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $venta_id = $_POST['venta_id'];
    $cliente = $_POST['cliente'];
    $fecha = date('Y-m-d H:i:s');

    // Verificar que la venta existe
    $stmt = $conn->prepare("SELECT COUNT(*) FROM ventas WHERE id = ?");
    $stmt->bind_param("i", $venta_id);
    $stmt->execute();
    $stmt->bind_result($venta_exists);
    $stmt->fetch();
    $stmt->close();

    if ($venta_exists > 0) {
        // Insertar la factura en la base de datos
        $stmt = $conn->prepare("INSERT INTO facturas (venta_id, cliente, fecha) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $venta_id, $cliente, $fecha);

        if ($stmt->execute()) {
            echo "Factura generada exitosamente.";
        } else {
            echo "Error al generar la factura: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "El ID de venta no existe.";
    }
}

// Consulta para obtener la lista de facturas
$query = "SELECT f.id, v.id AS venta_id, f.cliente, f.fecha 
          FROM facturas f 
          JOIN ventas v ON f.venta_id = v.id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas - Licorería</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Licorería Dani</a>
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
        </div>
    </nav>
    <div class="container mt-4">
        <h3>Generar Nueva Factura</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="venta_id">ID de Venta:</label>
                <input type="number" class="form-control" id="venta_id" name="venta_id" required>
            </div>
            <div class="form-group">
                <label for="cliente">Nombre del Cliente:</label>
                <input type="text" class="form-control" id="cliente" name="cliente" required>
            </div>
            <button type="submit" class="btn btn-primary">Generar Factura</button>
        </form>

        <h3 class="mt-4">Facturas Registradas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID de Venta</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Listar las facturas registradas en la tabla
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['venta_id']}</td>
                                <td>{$row['cliente']}</td>
                                <td>{$row['fecha']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay facturas registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts de JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
