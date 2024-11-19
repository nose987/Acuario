<?php
include '../Class/equipo.php';
include '../Class/clases.php';
$opcionesFormulario = new OpcionesFormulario();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <title>Registro de Equipo</title>
</head>

<body>


    <?php include("layout/header.php") ?>
    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>
        <div class="container">
            <div class="titulo">
                <h1>Registro de Equipo</h1>
            </div>

            <form action="../functions/equipo.php" method="POST">
                <div class="formulario">
                    <label for="nombre">Nombre:</label>
                    <input class="input" type="text" id="nombre" name="nombre" required>

                    <label for="estado">Estado:</label>
                    <input class="input" type="text" id="estado" name="estado" required>

                    <label for="fk_tanque">Tanque:</label>
                    <select class="input" id="fk_tanque" name="fk_tanque" required>
                        <?php echo $opcionesFormulario->obtenerOpcionesTanques(); ?>
                    </select>

                    <input class="btn" type="submit" value="Registrar Equipo">
                </div>

            </form>
        </div>
    </div>




</body>


</html>