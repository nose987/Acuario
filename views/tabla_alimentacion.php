<?php
include '../functions/mostrar_alimentacion.php';

$alimentacion = new Alimentacion();
$programaciones = $alimentacion->obtener_alimentacion();
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
            <h2>REGISTRO DE ALIMENTACION</h2><br>
            <div>
                <a href="../fpdf/reporte_alimentacion.php" target="_blank">Generar reporte</a>
            </div>
            <table>
                <tr>
                    <th>Registro</th>
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
                            <td><?php echo $programacion['nombre_area']; ?></td>
                            <td><?php echo $programacion['nombre_especie']; ?></td>
                            <td><?php echo $programacion['nombre_alimento']; ?></td>
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