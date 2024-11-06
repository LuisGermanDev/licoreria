<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integración PHP y JS</title>
    <script>
        var mensajeDesdePHP = "<?php echo 'Hola desde PHP!'; ?>";
        console.log(mensajeDesdePHP);
    </script>
</head>
<body>
    <h1>Hola, Mundo!</h1>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licorería - Sistema de Ventas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Licorería Dani</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Panel de Control</a></li>
                <li class="nav-item"><a class="nav-link" href="productos.html">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="ventas.html">Ventas</a></li>
                <li class="nav-item"><a class="nav-link" href="facturas.html">Facturas</a></li>
                <li class="nav-item"><a class="nav-link" href="reportes.html">Reportes</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3">
                <!-- Menú lateral -->
                <div class="list-group">
                    <a href="index.html" class="list-group-item list-group-item-action active">Panel de Control</a>
                    <a href="productos.html" class="list-group-item list-group-item-action">Productos</a>
                    <a href="ventas.html" class="list-group-item list-group-item-action">Ventas</a>
                    <a href="facturas.html" class="list-group-item list-group-item-action">Facturas</a>
                    <a href="reportes.html" class="list-group-item list-group-item-action">Reportes</a>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Contenido dinámico -->
                <h3>Bienvenido al Sistema de Control de Ventas y Facturación</h3>
                <p>Seleccione una opción del menú para empezar a gestionar su licorería.</p>
                
                <!-- Aquí irán los widgets o secciones de contenido específicos de cada página -->
                <div class="row text-center">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Productos</h5>
                                <p class="card-text">Administre sus productos y su inventario.</p>
                                <a href="productos.html" class="btn btn-primary">Ver Productos</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ventas</h5>
                                <p class="card-text">Registre y controle las ventas diarias.</p>
                                <a href="ventas.html" class="btn btn-success">Registrar Venta</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Facturas</h5>
                                <p class="card-text">Genere facturas para sus ventas.</p>
                                <a href="facturas.html" class="btn btn-warning">Generar Factura</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Licorería</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Gestión de Productos</h3>
        <div class="mb-3">
            <button class="btn btn-primary" onclick="agregarProducto()">Agregar Producto</button>
        </div>
        
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
                <!-- Productos listados dinámicamente -->
            </tbody>
        </table>
    </div>

    <script>
        function agregarProducto() {
            // Lógica para abrir un modal o redirigir a un formulario para agregar productos
            alert("Funcionalidad para agregar producto");
        }
    </script>
</body>
</html>