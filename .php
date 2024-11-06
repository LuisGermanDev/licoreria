<?php
$host = 'localhost';
$dbname = 'licoreria';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $precio, $stock]);
    echo "Producto agregado correctamente";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($productos);
    <?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productos = $_POST['productos']; // Array con id y cantidad
    $total = 0;

    // Registrar la venta
    $stmt = $pdo->prepare("INSERT INTO ventas (total) VALUES (?)");
    $stmt->execute([$total]);
    $venta_id = $pdo->lastInsertId();

    // Registrar detalles de la venta
    foreach ($productos as $producto) {
        $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
        $stmt->execute([$producto['id']]);
        $productoData = $stmt->fetch(PDO::FETCH_ASSOC);

        $subtotal = $productoData['precio'] * $producto['cantidad'];
        $total += $subtotal;

        $stmt = $pdo->prepare("INSERT INTO detalles_venta (venta_id, producto_id, cantidad, subtotal) VALUES (?, ?, ?, ?)");
        $stmt->execute([$venta_id, $producto['id'], $producto['cantidad'], $subtotal]);
    }

    // Actualizar el total de la venta
    $stmt = $pdo->prepare("UPDATE ventas SET total = ? WHERE id = ?");
    $stmt->execute([$total, $venta_id]);

    echo "Venta registrada correctamente";
}
?>

<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $venta_id = $_POST['venta_id'];

    $stmt = $pdo->prepare("INSERT INTO facturas (venta_id) VALUES (?)");
    $stmt->execute([$venta_id]);

    ?php

$host = 'localhost';
$usuario = 'root';(dixonatanacio)
$contraseña = '';(5847888)
$base_de_datos = 'control_ventas';

// Conectar a MySQL
$conn = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
Crear un producto:

function agregarProducto($nombre, $descripcion, $precio, $cantidad) {
    global $conn;
    $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $cantidad);
    $stmt->execute();
    $stmt->close();
}



function obtenerProductos() {
    global $conn;
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function actualizarProducto($id, $nombre, $descripcion, $precio, $cantidad) {
    global $conn;
    $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $cantidad, $id);
    $stmt->execute();
    $stmt->close();
}
function eliminarProducto($id) {
    global $conn;
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
unction realizarVenta($id_usuario, $productos) {
    global $conn;
    $total = 0;
    // Insertar venta
    $sql = "INSERT INTO ventas (id_usuario, total) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $id_usuario, $total);
    $stmt->execute();
    $venta_id = $stmt->insert_id;
    
    // Insertar detalles de venta
    foreach ($productos as $producto) {
        $id_producto = $producto['id'];
        $cantidad = $producto['cantidad'];
        $precio = $producto['precio'];
        $total += $precio * $cantidad;
        
        $sql_detalle = "INSERT INTO detalles_venta (id_venta, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)";
        $stmt_detalle = $conn->prepare($sql_detalle);
        $stmt_detalle->bind_param("iiii", $venta_id, $id_producto, $cantidad, $precio);
        $stmt_detalle->execute();
    }
    
    // Actualizar total de la venta
    $sql_actualizar = "UPDATE ventas SET total = ? WHERE id = ?";
    $stmt_actualizar = $conn->prepare($sql_actualizar);
    $stmt_actualizar->bind_param("di", $total, $venta_id);
    $stmt_actualizar->execute();
    
    $stmt->close();
    $stmt_detalle->close();
    $stmt_actualizar->close();
}
function generarFactura($id_venta) {
    global $conn;
    $numero_factura = "F" . str_pad($id_venta, 5, "0", STR_PAD_LEFT);  // Ejemplo de número de factura
    
    $sql = "INSERT INTO facturas (id_venta, numero_factura) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id_venta, $numero_factura);
    $stmt->execute();
    $stmt->close();
    
    return $numero_factura;
}

