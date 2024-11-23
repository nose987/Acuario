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
    <title>Registro de Tratamiento</title>
</head>
<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <!--<aside>
            <?php //include("layout/aside.php") ?>
        </aside>-->
        <div class="container">
            <div class="titulo">
                <h1>Registro de Tratamiento</h1>
            </div>
            <form action="../Class/clase_tratamiento_especie.php" method="POST">
                <div class="formulario">
                    <?php
                    include_once("../Class/clase_tratamiento_especie.php");
                    $tratamientos = new Tratamientos();
                    ?>

                    <label for="">Diagnóstico: </label>
                    <select class="input" name="fk_diagnostico" required>
                        <option value="">Seleccione un diagnóstico</option>
                        <?php
                        $diagnosticos = $tratamientos->obtenerDiagnosticos();
                        while($diagnostico = $diagnosticos->fetch_assoc()) {
                            echo "<option value='".$diagnostico['pk_diagnostico']."'>";
                            echo $diagnostico['especie']." - ".date('d/m/Y H:i', strtotime($diagnostico['fecha_diagnostico']));
                            echo " (Gravedad: ".$diagnostico['gravedad'].")";
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <label for="">Veterinario Responsable: </label>
                    <select class="input" name="fk_persona" required>
                        <option value="">Seleccione un veterinario</option>
                        <?php
                        $veterinarios = $tratamientos->obtenerVeterinarios();
                        while($veterinario = $veterinarios->fetch_assoc()) {
                            echo "<option value='".$veterinario['pk_persona']."'>";
                            echo $veterinario['nombre_completo'];
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <label for="">Fecha de inicio: </label>
                    <input type="datetime-local" class="input" name="fecha_inicio" required>

                    <label for="">Fecha estimada de finalización: </label>
                    <input type="datetime-local" class="input" name="fecha_fin">

                    <label for="">Estado del tratamiento: </label>
                    <select class="input" name="estado" required>
                        <option value="En curso">En curso</option>
                        <option value="Programado">Programado</option>
                        <option value="Completado">Completado</option>
                        <option value="Suspendido">Suspendido</option>
                    </select>

                    <label for="">Descripción del tratamiento: </label>
                    <textarea class="input" name="descripcion" rows="5" required></textarea>

                    <label for="">Instrucciones: </label>
                    <textarea class="input" name="instrucciones" rows="5"></textarea>

                    <label for="">Observaciones: </label>
                    <textarea class="input" name="observaciones" rows="5"></textarea>

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