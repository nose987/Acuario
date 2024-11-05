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
    <title>programacion de alimentacion</title>
</head>
<body>
    <div class="container">
        <h1>programacion de alimentacion</h1>
        <form action="procesar_alimentacion.php" method="POST">
            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad" required>

            <label for="descripcion">Instrucciones de la alimentacion:</label>
            <input type="text" id="descripcion" name="descripcion" required>

            <label for="hora">Hora</label>
            <input type="time" id="hora" name="hora" required>

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

            <label for="fk_inventario">Alimento:</label>
            <select id="fk_inventario" name="fk_inventario" required>
                <?php echo $opcionesFormulario->obtenerOpcionesInventario(); ?>
            </select>

            <input type="submit" value="Registrar alimentacion">
        </form>
    </div>
    
</body>
</html>
