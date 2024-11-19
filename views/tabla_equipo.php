<?php
include '../functions/mostrar_equipo.php';

$equipo = new Equipo();
$equipo = $equipo->mostrar();
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
            <h2>Equipos</h2>
            <table border="1">
                <tr>
                    <th>nombre</th>
                    <th>estado</th>
                    <th>tanque</th>
                    <th>fecha</th>
                </tr>
                <?php if (!empty($equipo)): ?>
                    <?php foreach ($equipo as $equipo): ?>
                        <tr>
                            <td><?php echo $equipo['nombre']; ?></td>
                            <td><?php echo $equipo['estado']; ?></td>
                            <td><?php echo $equipo['fk_tanque']; ?></td>
                            <td><?php echo $equipo['fecha']; ?></td>
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