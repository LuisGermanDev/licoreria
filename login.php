<?php 
session_start();
include 'connection.php'; // Incluir archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($hash);
    $stmt->fetch();

    // Verificar contraseña
    if (password_verify($contrasena, $hash)) {
        // Contraseña correcta, redirigir al admin.php
        $_SESSION['correo'] = $correo; // Guardar la sesión
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos.');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* From Uiverse.io by Yaya12085 */ 
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    /* border: 1px solid black; */
}
        .body {
            background-image: url("./img/canasta.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 96vh;
    background-color: #f7f7f7; /* Color de fondo */
    margin: 0; /* Eliminar márgenes predeterminados */
}

.form {
    background-color: #ffffff; /* Fondo blanco */
    padding: 5rem; /* Espacio interno mayor */
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
    width: 100%; /* Ajuste para que ocupe todo el contenedor */
    border-radius: 5px; /* Bordes redondeados para los inputs */
    border: 1px solid #d1d5db; /* Borde gris claro */
    margin-bottom: 1rem; /* Espaciado inferior */
    transition: border-color 0.3s; /* Transición para el borde */
}

.input-container input:focus {
    border-color: #4F46E5; /* Color de borde al enfocarse */
    box-shadow: 0 0 5px rgba(79, 70, 229, 0.5); /* Sombra al enfocarse */
}

.input-container span {
    display: grid;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    padding-left: 1rem;
    padding-right: 1rem;
    place-content: center;
}

.input-container span svg {
    color: #9CA3AF;
    width: 1.5rem; /* Tamaño del icono */
    height: 1.5rem; /* Tamaño del icono */
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
header {
    background-color: #ffffff;
    padding: 10px 0;
    color: black;
}

.navbar {
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
}

.navbar li {
    margin: 0 40px;
}

.navbar a {
    color: #000000;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.navbar a:hover {
    color: #ff6347;
}
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 40px 600px;
}
    </style>
</head>
<body>
<header>
      <nav>
        <ul class="navbar">
          <li><h1>DANI</h1></li>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="index.php">Servicios</a></li>
          <li><a href="index.php">Acerca de</a></li>
          <li><a href="index.php">Contacto</a></li>
          <li><a href="login.php">Iniciar Sesion</a></li>
          <li><a href="registro.php">Registrarse</a></li>
        </ul>
      </nav>
    </header>
    <div class="body">

    <form class="form" method="post" action="">
        <p class="form-title">Iniciar sesión en tu cuenta</p>
        <div class="input-container">
            <input placeholder="Ingresa tu correo" type="email" name="correo" required>
            <span>
                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg>
            </span>
        </div>
        <div class="input-container">
            <input placeholder="Ingresa tu contraseña" type="password" name="contrasena" required>
            <span>
                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg>
            </span>
        </div>
        <button class="submit" type="submit">Iniciar Sesión</button>

        <p class="signup-link">
            ¿No tienes cuenta?
            <a href="registro.php">Regístrate</a>
        </p>
    </form>
    </div>
    <footer>
      <p>&copy; 2024 Tu Licoreria Dani Todos los derechos reservados. Prohibida su reproducción total o parcial sin autorización.</p>
    </footer>
</body>
</html>
