<?php
include '../Class/clases.php';

$opcionesFormulario = new OpcionesFormulario();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <title>programacion de alimentacion</title>
</head>

<body>


    <?php include("layout/header.php") ?>
    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>
        <div class="container">
            <div class="titulo">
                <h1>programacion de alimentacion</h1>

            </div>
            <form action="../functions/procesar_alimentacion.php" method="POST">
                <div class="formulario">
                    <label for="cantidad">Cantidad:</label>
                    <input type="text" class="input" id="cantidad" name="cantidad" required>

                    <label for="descripcion">Instrucciones de la alimentacion:</label>
                    <input type="text" class="input" id="descripcion" name="descripcion" required>

                    <label for="hora">Hora</label>
                    <input type="time" class="input" id="hora" name="hora" required>

                    <label for="fecha">Fecha:</label>
                    <input type="date" class="input" id="fecha" name="fecha" required>

                    <label for="fk_area">Área:</label>
                    <select class="input" id="fk_area" name="fk_area" required>
                        <?php echo $opcionesFormulario->obtenerOpcionesAreas(); ?>
                    </select>

                    <label for="fk_especie">Especie:</label>
                    <select class="input" id="fk_especie" name="fk_especie" required>
                        <?php echo $opcionesFormulario->obtenerOpcionesEspecies(); ?>
                    </select>

                    <label for="fk_inventario">Alimento:</label>
                    <select class="input" id="fk_inventario" name="fk_inventario" required>
                        <?php echo $opcionesFormulario->obtenerOpcionesInventario(); ?>
                    </select>

                    <div class="btn_formulario">
                        <input class="btn" type="submit" value="Registrar alimentacion">
                        <a  class="btn" type="button" onclick="window.location.href='panel_alimentacion.php'">
                            cancelar
                        </a>

                    </div>
                </div>

            </form>
        </div>
    </div>




</body>

</html>