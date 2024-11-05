<?php
include 'mostrar_alimentacion.php'; // Asegúrate de que este archivo tenga la clase Alimentacion

$alimentacion = new Alimentacion();
$programaciones = $alimentacion->obtener_alimentacion(); // Llama al método y almacena el resultado en $programaciones
?>

<h2>Programaciones de Alimentación</h2>
<table border="1">
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
