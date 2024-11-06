<?php
include 'mostrar_agua.php'; 

$agua = new Agua();
$calidades = $agua->obtener_calidad_agua(); 
?>

<h2>Calidad de Agua</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>pH</th>
        <th>Amoniaco</th>
        <th>Nitrato</th>
        <th>Nitritos</th>
        <th>Tanque</th>
        <th>Fecha</th>
    </tr>
    <?php if (!empty($calidades)): ?>
        <?php foreach ($calidades as $calidad): ?>
            <tr>
                <td><?php echo $calidad['pk_agua']; ?></td>
                <td><?php echo $calidad['ph']; ?></td>
                <td><?php echo $calidad['amoniaco']; ?></td>
                <td><?php echo $calidad['nitrato']; ?></td>
                <td><?php echo $calidad['nitritos']; ?></td>
                <td><?php echo $calidad['fk_tanque']; ?></td>
                <td><?php echo $calidad['fecha']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No hay registros de calidad de agua.</td>
        </tr>
    <?php endif; ?>
</table>
