<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
include 'connection.php';

// Consulta para obtener todos los productos
$query = "SELECT * FROM productos";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licorería - Sistema de Ventas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <!-- Barra de navegación -->
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
    <br>
    <div class="container">
        <div class="row text-center">
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Productos</h5>
                <p class="card-text">
                  Administre sus productos y su inventario.
                </p>
                <a href="productos.php" class="btn btn-primary"
                  >Ver Productos</a
                >
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Ventas</h5>
                <p class="card-text">Registre y controle las ventas diarias.</p>
                <a href="ventas.php" class="btn btn-success">Registrar Venta</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Facturas</h5>
                <p class="card-text">Genere facturas para sus ventas.</p>
                <a href="facturas.php" class="btn btn-warning"
                  >Generar Factura</a
                >
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Reportes</h5>
                <p class="card-text">Genere reporte de los productos.</p>
                <a href="reportes.php" class="btn btn-success"
                  >Generar Factura</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Contenido principal -->
    <div class="container mt-4">
        <h3>Bienvenido al Sistema de Control de Ventas y Facturación</h3>
        <p>Seleccione una opción del menú para empezar a gestionar su licorería.</p>

        <!-- Tabla de productos -->
        <h4>Lista de Productos</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productos-lista">
                <?php
                // Verificar si hay productos y mostrarlos
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>\${$row['precio']}</td>
                            <td>{$row['stock']}</td>
                            <td>
                                <a href='editar_producto.php?id={$row['id']}' class='btn btn-warning'>Editar</a>
                                <a href='eliminar_producto.php?id={$row['id']}' class='btn btn-danger'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay productos disponibles.</td></tr>";
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
