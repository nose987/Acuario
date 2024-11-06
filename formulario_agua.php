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
    <title>Registro de Calidad del Agua</title>
</head>
<body>
    <div class="container">
        <h1>Registro de Calidad del Agua</h1>
        <form action="agua.php" method="POST">
            <label for="ph">pH:</label>
            <input type="text" id="ph" name="ph" required>

            <label for="amoniaco">Amoniaco:</label>
            <input type="text" id="amoniaco" name="amoniaco" required>

            <label for="nitrato">Nitrato:</label>
            <input type="text" id="nitrato" name="nitrato" required>

            <label for="nitritos">Nitritos:</label>
            <input type="text" id="nitritos" name="nitritos" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="fk_tanque">Tanque:</label>
            <select id="fk_tanque" name="fk_tanque" required>
                <?php echo $opcionesFormulario->obtenerOpcionesTanques(); ?>
            </select>

            <input type="submit" value="Registrar Calidad del Agua">
        </form>
    </div>
</body>
</html>
