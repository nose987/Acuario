<?php
include 'class/clases.php';

$opcionesFormulario = new OpcionesFormulario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/estilos.css">
    <title>Registro de Usuario</title>
</head>
<body>
    <div class="container">
        <h1>Registro de Usuario</h1>
        <form action="registro.php" method="POST">
            <label for="nombre">Nombre(s):</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apaterno">Apellido Paterno:</label>
            <input type="text" id="apaterno" name="apaterno" required>

            <label for="amaterno">Apellido Materno:</label>
            <input type="text" id="amaterno" name="amaterno" required>

            <label for="fecha_nac">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nac" name="fecha_nac" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="telefono">Número de Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="fk_area">Área:</label>
            <select id="fk_area" name="fk_area" required>
                <?php echo $opcionesFormulario->obtenerOpcionesAreas(); ?>
            </select>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required>

            <label for="fk_roles">Tipo de usuario (Rol):</label> 
            <select id="fk_roles" name="fk_roles" required> 
            <?php echo $opcionesFormulario->obtenerOpcionesRoles(); ?>
            </select>


            <label for="genero">Género:</label>
            <select id="genero" name="genero" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>

            <input type="submit" value="Registrar">
        </form>
    </div>
</body>
</html>
