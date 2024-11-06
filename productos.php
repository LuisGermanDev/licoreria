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
