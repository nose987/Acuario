<?php 
include 'conexion.php';
$conn = new Conexion();


$sql = "SELECT pk_rol, nombre_rol FROM rol";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/estilos.css">
    <title>Registro de Usuarios</title>
</head>
<body>
    <div class="container">
        <h1>Registro de Usuario</h1>
        <form action="registro.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="rol">Tipo de usuario (Rol):</label>
            <select id="rol" name="rol" required>
                <?php
                if ($result->num_rows > 0) {
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['pk_rol'] . "'>" . $row['nombre_rol'] . "</option>";
                    }
                } else {
                    echo "<option>No hay roles disponibles</option>";
                }
                ?>
            </select>

            <input type="submit" value="Registrar">
        </form>
    </div>
</body>
</html>

