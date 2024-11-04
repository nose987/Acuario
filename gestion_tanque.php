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

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="fk_area">Área:</label>
            <select id="fk_area" name="fk_area" required>
                <?php echo $opcionesFormulario->obtenerOpcionesAreas(); ?>
            </select>

            <label for="fk_especie">Especie:</label>
            <select id="fk_especie" name="fk_especie" required>
                <?php echo $opcionesFormulario->obtenerOpcionesEspecies(); ?>
            </select>

            <input type="submit" value="Registrar Tanque">
        </form>
    </div>
</body>
</html>
