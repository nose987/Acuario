<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include '../Class/clases.php';

$opcionesFormulario = new OpcionesFormulario();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/formulario.css">
    <title>Registro de Calidad del Agua</title>
</head>

<body>


    <?php include("layout/header.php") ?>
    <div class="contenido">
        <!--<aside>
            <?php //include("layout/aside.php") ?>
        </aside>-->
        <div class="container">
            <div class="titulo">
                <h1>Registro de calidad del agua</h1>
            </div>

            <form action="../functions/agua.php" method="POST">
                <div class="formulario">
                    <label for="ph">pH:</label>
                    <input class="input" type="text" id="ph" name="ph" placeholder="Ingrese el nivel de pH" required>

                    <label for="amoniaco">Amoniaco:</label>
                    <input class="input" type="text" id="amoniaco" name="amoniaco" placeholder="Ingrese el nivel de Amoniaco" required>

                    <label for="nitrato">Nitrato:</label>
                    <input class="input" type="text" id="nitrato" name="nitrato" placeholder="Ingrese el nivel de Nitratos" required>

                    <label for="nitritos">Nitritos:</label>
                    <input class="input" type="text" id="nitritos" name="nitritos" placeholder="Ingrese el nivel de Nitritos" required>

                    <label for="fecha">Fecha:</label>
                    <input class="input" type="datetime-local" id="fecha" name="fecha" required>

                    <label for="fk_tanque">Tanque:</label>
                    <select class="input" id="fk_tanque" name="fk_tanque" required>
                        <option value="">Seleccione un tanque</option>
                        <?php echo $opcionesFormulario->obtenerOpcionesTanques(); ?>
                    </select>

                    <div class="btn_formulario">
                        <input class="btn" type="submit" value="Registrar Calidad del Agua">
                        <a class="btn" type="button" onclick="window.location.href='panel.php'">Cancelar</a>
                    </div>

                </div>

            </form>
        </div>
    </div>




</body>

</html>