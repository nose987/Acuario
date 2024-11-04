<?php
include 'Tanque.php';

$tanque = new Tanque();
$tanques = $tanque->obtener_tanques(); // Llama al método y almacena el resultado en $tanques

?>

<h2>Tanques Registrados</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Capacidad</th>
        <th>Temperatura</th>
        <th>Iluminación</th>
        <th>Filtración</th>
        <th>Área</th>
        <th>Especie</th>
        <th>Fecha</th>
    </tr>
    <?php if (!empty($tanques)): ?>
        <?php foreach ($tanques as $tanque): ?>
            <tr>
                <td><?php echo $tanque['pk_tanque']; ?></td>
                <td><?php echo $tanque['capacidad']; ?></td>
                <td><?php echo $tanque['temperatura']; ?></td>
                <td><?php echo $tanque['iluminacion']; ?></td>
                <td><?php echo $tanque['filtracion']; ?></td>
                <td><?php echo $tanque['fk_area']; ?></td>
                <td><?php echo $tanque['fk_especie']; ?></td>
                <td><?php echo $tanque['fecha']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No hay tanques registrados.</td>
        </tr>
    <?php endif; ?>
</table>
