<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/formulario.css">
    <title>Registro de Diagnóstico</title>
</head>

<body>
    <?php include("layout/header.php") ?>

    <div class="contenido">
        <!--<aside>
            <?php //include("layout/aside.php") ?>
        </aside>-->
        <div class="container">
            <div class="titulo">
                <h1>Registro de Diagnóstico</h1>
            </div>
            <form action="../Class/clase_diagnostico_especies.php" method="POST">
                <div class="formulario">
                    <?php
                    include_once("../Class/clase_diagnostico_especies.php");
                    $diagnosticos = new Diagnosticos();
                    ?>

                    <label for="">Registro de Salud: </label>
                    <select class="input" name="fk_salud_especie" required>
                        <option value="">Seleccione un registro</option>
                        <?php
                        $registros = $diagnosticos->obtenerRegistrosSalud();
                        while($registro = $registros->fetch_assoc()) {
                            echo "<option value='".$registro['pk_salud_especie']."'>";
                            echo $registro['especie']." - ".date('d/m/Y H:i', strtotime($registro['fecha_revision']));
                            echo " (".$registro['estado_general'].")";
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <label for="">Veterinario: </label>
                    <select class="input" name="fk_persona" required>
                        <option value="">Seleccione un veterinario</option>
                        <?php
                        $veterinarios = $diagnosticos->obtenerVeterinarios();
                        while($veterinario = $veterinarios->fetch_assoc()) {
                            echo "<option value='".$veterinario['pk_persona']."'>";
                            echo $veterinario['nombre_completo'];
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <label for="">Gravedad: </label>
                    <select class="input" name="gravedad" required>
                        <option value="Leve">Leve</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Grave">Grave</option>
                        <option value="Crítico">Crítico</option>
                    </select>

                    <label for="">Descripción del diagnóstico: </label>
                    <textarea class="input" name="descripcion" rows="10" required></textarea>

                    <div class="btn_formulario">
                        <input type="submit" value="Guardar" class="btn">
                        <a class="btn" type="button" onclick="window.location.href='panel.php'">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>