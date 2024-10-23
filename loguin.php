<?php
include 'clases.php'; 
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
        <form method="POST" action="no_se_qshow.php">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
