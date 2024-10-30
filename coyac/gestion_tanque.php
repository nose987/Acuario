<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/estilos.css">
    <title>Registro de Tanques</title>
</head>
<body>
    <div class="container">
        <h1>Registro de Tanques</h1>
        <form action="procesar_tanque.php" method="POST">
            <label for="capacidad">Capacidad:</label>
            <input type="text" id="capacidad" name="capacidad" required>

            <label for="temperatura">Temperatura:</label>
            <input type="text" id="temperatura" name="temperatura" required>

            <label for="iluminacion">Iluminación:</label>
            <input type="text" id="iluminacion" name="iluminacion" required>

            <label for="filtracion">Filtración:</label>
            <input type="text" id="filtracion" name="filtracion" required>

            <label for="area">Área:</label>
            <select id="area" name="pk_area" required>
                <?php
                include 'conexion.php';
                $conn = new Conexion();
                $resultado_areas = $conn->query("SELECT pk_area, nombre FROM areas");
                if ($resultado_areas) {
                    while ($area = $resultado_areas->fetch_assoc()) {
                        echo "<option value='{$area['pk_area']}'>{$area['nombre']}</option>";
                    }
                } else {
                    echo "<option disabled>No se encontraron áreas</option>";
                }
                ?>
            </select>

            <label for="especie">Especie:</label>
            <select id="especie" name="pk_especie" required>
                <?php
                $resultado_especies = $conn->query("SELECT pk_especie, nombre FROM especies");
                if ($resultado_especies) {
                    while ($especie = $resultado_especies->fetch_assoc()) {
                        echo "<option value='{$especie['pk_especie']}'>{$especie['nombre']}</option>";
                    }
                } else {
                    echo "<option disabled>No se encontraron especies</option>";
                }
                ?>
            </select>

            <input type="submit" value="Registrar Tanque">
        </form>
    </div>
</body>
</html>
