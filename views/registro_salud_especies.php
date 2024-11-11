<?php
include_once("../Class/Clase_salud_especies.php");
$saludEspecies = new SaludEspecies();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <title>Registro Salud Especies</title>
</head>

<body>

    <?php include("layout/header.php") ?>


    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>
        <div class="container">
            <div class="titulo">
                <h1>Revisión de especies</h1>
            </div>
            <form action="../Class/Clase_salud_especies.php" method="POST">
                <div class="formulario">

                    <label for="">Especie: </label>
                    <select class="input" name="fk_especie" id="">
                        
                        <?php
                        $especies = $saludEspecies->obtenerEspecies();
                        while ($especie = $especies->fetch_assoc()) {
                            echo "<option value='" . $especie['pk_especie'] . "'>" . $especie['nombre'] . "</option>";
                        }
                        ?>
                    </select>

                    <label for="">Fecha de revision:</label>
                    <input class="input" type="datetime-local" name="fecha_revision">

                    <label for="">Peso(kg):</label>
                    <input class="input" step="0.01" type="number" name="peso">

                    <label for="">Longitud(cm): </label>
                    <input class="input" step="0.01" type="number" name="longitud">

                    <label for="">Temperatura(°C): </label>
                    <input class="input" step="0.1" type="number" name="temperatura">

                    <label for="">Estado de la especie: </label>
                    <select class="input" name="estado_general" id="">
                        <option value="Saludable">Saludable</option>
                        <option value="En tratamiento">En tratamiento</option>
                        <option value="Crítico">Crítico</option>
                        <option value="En observación">En observación</option>
                    </select>

                    <label for="">Comportamiento: </label>
                    <textarea class="input" name="comportamiento" id="" cols="30" rows="10"></textarea>

                    <label for="">Sintomas: </label>
                    <textarea class="input" name="sintomas" id="" cols="30" rows="10"></textarea>

                    <label for="">Observaciones: </label>
                    <textarea class="input" name="observaciones" id="" cols="30" rows="10"></textarea>

                    <label for="">Encargado de revición: </label>
                    <select class="input" name="fk_persona" id="">
                        
                        <?php
                        $personal = $saludEspecies->obtenerPersonal();
                        while ($persona = $personal->fetch_assoc()) {
                            echo "<option value='" . $persona['pk_persona'] . "'>" . $persona['nombre_completo'] . "</option>";
                        }
                        ?>
                    </select>

                    <div class="btn_formulario">
                        <input type="submit" value="Guardar" class="btn" onclick="">
                        <a class="btn" type="button" onclick="window.location.href='panel_salud_especies.php'">cancelar</a>
                    </div>
                </div>
            </form>
        </div>



    </div>



</body>

</html>