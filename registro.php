<?php
include 'connection.php'; // Incluir archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hash para mayor seguridad

    // Preparar y vincular
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        /* Estilos comunes para el formulario */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7; /* Color de fondo */
            margin: 0; /* Eliminar márgenes predeterminados */
        }

        .form {
            background-color: #ffffff; /* Fondo blanco */
            padding: 5rem 7rem; /* Espacio interno mayor */
            max-width: 400px; /* Ajustar el ancho del formulario */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
            text-align: center; /* Centrar texto dentro del formulario */
        }

        .form-title {
            font-size: 1.5rem; /* Tamaño de fuente más grande */
            line-height: 1.75rem;
            font-weight: 600;
            color: #333; /* Color del texto */
            margin-bottom: 1.5rem; /* Espaciado inferior */
        }

        .input-container {
            position: relative;
        }

        .input-container input {
            background-color: #f0f4ff; /* Color de fondo claro para los inputs */
            padding: 1rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 86%; /* Ajuste para que ocupe todo el contenedor */
            border-radius: 5px; /* Bordes redondeados para los inputs */
            border: 1px solid #d1d5db; /* Borde gris claro */
            margin-bottom: 1rem; /* Espaciado inferior */
            transition: border-color 0.3s; /* Transición para el borde */
        }

        .input-container input:focus {
            border-color: #4F46E5; /* Color de borde al enfocarse */
            box-shadow: 0 0 5px rgba(79, 70, 229, 0.5); /* Sombra al enfocarse */
        }

        .submit {
            display: block;
            padding: 0.75rem;
            background-color: #4F46E5;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            border-radius: 5px; /* Bordes redondeados */
            border: none; /* Sin borde */
            cursor: pointer; /* Cambiar cursor al pasar sobre el botón */
            transition: background-color 0.3s; /* Transición para el fondo */
        }

        .submit:hover {
            background-color: #3730a3; /* Color más oscuro al pasar el ratón */
        }

        .signup-link {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
            margin-top: 1rem; /* Espaciado superior */
        }

        .signup-link a {
            text-decoration: underline;
            color: #4F46E5; /* Color del enlace */
        }
    </style>
</head>
<body>
    <form class="form" method="post" action="">
        <p class="form-title">Registro de Usuario</p>
        <div class="input-container">
            <input placeholder="Ingresa tu nombre" type="text" name="nombre" required>
        </div>
        <div class="input-container">
            <input placeholder="Ingresa tu correo" type="email" name="correo" required>
        </div>
        <div class="input-container">
            <input placeholder="Ingresa tu contraseña" type="password" name="contrasena" required>
        </div>
        <button class="submit" type="submit">Registrar</button>
        
        <p class="signup-link">
            ¿Ya tienes cuenta?
            <a href="login.php">Inicia sesión</a>
        </p>
    </form>
</body>
</html>
