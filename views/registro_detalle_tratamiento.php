<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <title>Registro de Detalle de Tratamiento</title>
</head>
<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>
        <div class="container">
            <div class="titulo">
                <h1>Registro de Detalle de Tratamiento</h1>
            </div>
            <form action="../Class/clase_detalle_tratamiento.php" method="POST">
                <div class="formulario">
                    <?php
                    include_once("../Class/clase_detalle_tratamiento.php");
                    $detalleTratamiento = new DetalleTratamiento();
                    ?>

                    <!-- Selección del tratamiento -->
                    <label for="fk_tratamiento">Tratamiento: </label>
                    <select class="input" name="fk_tratamiento" required>
                        <option value="">Seleccione un tratamiento</option>
                        <?php
                        $tratamientos = $detalleTratamiento->obtenerTratamientos();
                        while($tratamiento = $tratamientos->fetch_assoc()) {
                            echo "<option value='".$tratamiento['pk_tratamiento']."'>";
                            echo $tratamiento['descripcion'];
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <!-- Selección del medicamento -->
                    <label for="fk_inventario">Medicamento: </label>
                    <select class="input" name="fk_inventario" required>
                        <option value="">Seleccione un medicamento</option>
                        <?php
                        $inventario = $detalleTratamiento->obtenerInventario();
                        while($item = $inventario->fetch_assoc()) {
                            echo "<option value='".$item['pk_inventario']."'>";
                            echo $item['nombre'];
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <!-- Dosis -->
                    <label for="dosis">Dosis: </label>
                    <input type="text" class="input" name="dosis" placeholder="Ej. 5 ml" required>

                    <!-- Frecuencia -->
                    <label for="frecuencia">Frecuencia: </label>
                    <input type="text" class="input" name="frecuencia" placeholder="Ej. Cada 8 horas" required>

                    <!-- Fecha de aplicación -->
                    <label for="fecha_aplicacion">Fecha de aplicación: </label>
                    <input type="datetime-local" class="input" name="fecha_aplicacion" required>

                    <!-- Notas -->
                    <label for="notas">Notas: </label>
                    <textarea class="input" name="notas" rows="5" placeholder="Detalles adicionales..."></textarea>

                    <!-- Selección del responsable -->
                    <label for="fk_persona">Responsable: </label>
                    <select class="input" name="fk_persona" required>
                        <option value="">Seleccione un responsable</option>
                        <?php
                        $personal = $detalleTratamiento->obtenerPersonal();
                        while($persona = $personal->fetch_assoc()) {
                            echo "<option value='".$persona['pk_persona']."'>";
                            echo $persona['nombre_completo'];
                            echo "</option>";
                        }
                        ?>
                    </select>

                    <div class="btn_formulario">
                        <input type="submit" value="Guardar" class="btn">
                        <a class="btn" type="button" onclick="window.location.href='panel_tratamientos.php'">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
