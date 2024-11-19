<?php
include '../functions/mostrar_mantenimiento.php';

$mantenimiento = new Mantenimiento();
$mantenimiento = $mantenimiento->mostrar_mante();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Document</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="aside">
            <?php include("layout/aside.php") ?>
        </div>
        <div class="tabla">
            <h2>Mantenimientos</h2>
            <table border="1">
                <tr>
                    <th>equipo</th>
                    <th>fecha</th>
                    <th>tipo de mantenimiento</th>
                    <th>descripcion</th>
                </tr>
                <?php if (!empty($equipo)): ?>
                    <?php foreach ($equipo as $equipo): ?>
                        <tr>
                            <td><?php echo $equipo['fk_equipo']; ?></td>
                            <td><?php echo $equipo['fecha']; ?></td>
                            <td><?php echo $equipo['tipo_mante']; ?></td>
                            <td><?php echo $equipo['descripcion']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay registros de equipos.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>

</html>