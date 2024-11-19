<?php
include '../Class/clases.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $usuario = new ValidarUsuario();
    $resultado = $usuario->validarLogin($correo, $contrasena);

    if ($resultado) {
        session_start();
        $_SESSION['usuario'] = $resultado; // almacenar información del usuario
        header("Location: panel_inventario.php"); // Cambia esta línea a la página a la que deseas redirigir
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/estilosh.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Inicio de Sesión</title>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <img src="../Storage/logo.jpg" alt="Logotipo" class="logo" >
            <h1>Iniciar Sesión</h1>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>

<style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f0f2f5;
}

.container {
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

h1 {
    color: #333333;
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    color: #555555;
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-align: left;
}

input[type="email"],
input[type="password"] {
    padding: 0.8rem;
    margin-bottom: 1rem;
    border: 1px solid #cccccc;
    border-radius: 4px;
    font-size: 1rem;
}

input[type="submit"] {
    background-color: #007bff;
    color: #ffffff;
    padding: 0.8rem;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
