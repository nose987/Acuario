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
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Registro de Tanques</title>
</head>

<body>

    <?php include("layout/header.php") ?>

    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>
        <div class="container">
            <div class="titulo">
                <h1>Registro de Tanques</h1>
            </div>
            <form action="../functions/procesar_tanque.php" method="POST">
                <div class="formulario">

                    <label for="capacidad">Capacidad:</label>
                    <input type="text" class="input" id="capacidad" name="capacidad" required>
    
                    <label for="temperatura">Temperatura:</label>
                    <input type="text" class="input" id="temperatura" name="temperatura" required>
    
                    <label for="iluminacion">Iluminación:</label>
                    <input type="text" class="input" id="iluminacion" name="iluminacion" required>
    
                    <label for="filtracion">Filtración:</label>
                    <input type="text" class="input" id="filtracion" name="filtracion" required>
    
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

                    <div class="btn_formulario">

                        <input type="submit" value="Registrar Tanque" class="btn">
                        <a  class="btn" type="button" onclick="window.location.href='panel_tanques.php'">
                            cancelar
                        </a>

                    </div>
                </div>
            </form>
        </div>

    </div>





</body>

</html>