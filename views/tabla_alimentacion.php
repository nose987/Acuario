<?php
include '../functions/mostrar_alimentacion.php'; // Asegúrate de que este archivo tenga la clase Alimentacion

$alimentacion = new Alimentacion();
$programaciones = $alimentacion->obtener_alimentacion(); // Llama al método y almacena el resultado en $programaciones
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Tabla alimentación</title>
</head>

<body>

    <?php include 'layout/header.php'; ?>
    <div class="contenido">
        <div class="aside">
            <?php include 'layout/aside.php'; ?>

        </div>
        
        <div class="tabla">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                    <th>Área</th>
                    <th>Especie</th>
                    <th>Alimento</th>
                </tr>
                <?php if (!empty($programaciones)): ?>
                    <?php foreach ($programaciones as $programacion): ?>
                        <tr>
                            <td><?php echo $programacion['pk_alimentacion']; ?></td>
                            <td><?php echo $programacion['cantidad']; ?></td>
                            <td><?php echo $programacion['descripcion']; ?></td>
                            <td><?php echo $programacion['hora']; ?></td>
                            <td><?php echo $programacion['fecha']; ?></td>
                            <td><?php echo $programacion['fk_area']; ?></td>
                            <td><?php echo $programacion['fk_especie']; ?></td>
                            <td><?php echo $programacion['fk_inventario']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No hay programaciones de alimentación registradas.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>

