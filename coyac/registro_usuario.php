<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
            <label for="nombres">Nombre(s):</label>
            <input type="text" id="nombres" name="nombres" required>

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

            <label for="num_telefono">Número de Teléfono:</label>
            <input type="text" id="num_telefono" name="num_telefono" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="fk_area">Área:</label>
            <select id="fk_area" name="fk_area" required>
                <?php
                include("../coyac/Class/clases.php");
                $area = new Areas();
                $areas = $area->obtenerAreas();
                foreach ($areas as $area): ?>
                    <option value="<?php echo $area['pk_area']; ?>">
                        <?php echo htmlspecialchars($area['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="rol">Tipo de usuario (Rol):</label>
            <select id="rol" name="rol" required>
                <?php
                $sql = "SELECT pk_rol, nombre FROM rol";
                $result = $conn->query($sql);

                if (!$result) {
                    echo "Error en la consulta de roles: " . $conn->conn->error;
                } else {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['pk_rol'] . "'>" . $row['nombre'] . "</option>";
                    }
                }
                ?>
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