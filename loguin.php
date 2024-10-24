<?php 
include 'conexion.php'; 
include 'class/clases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $usuario = new ValidarUsuario();
    $datosUsuario = $usuario->iniciarSesion($correo, $contrasena);

    if ($datosUsuario) {
        
        header("Location: inicio.php");
        exit();
    } else {
        
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/estilos.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form action="login.php" method="POST">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
