<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include_once '../functions/mostrar_mantenimiento.php';

$mantenimiento = new Mantenimiento();
$mantenimiento = $mantenimiento->mostrar_mante();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Mantenimientos</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">

        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn" type="button">Regresar</a>
                <h2>Mantenimientos</h2>
                <a href="" class="generar-reporte">Generar reporte</a>
            </div>

            <table>
                <thead>

                    <tr>
                        <th>equipo</th>
                        <th>fecha</th>
                        <th>tipo de mantenimiento</th>
                        <th>descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mantenimiento)): ?>
                        <?php foreach ($mantenimiento as $mantenimiento): ?>
                            <tr>
                                <td><?php echo $mantenimiento['nombre']; ?></td>
                                <td><?php echo $mantenimiento['fecha']; ?></td>
                                <td><?php echo $mantenimiento['tipo_mante']; ?></td>
                                <td><?php echo $mantenimiento['descripcion']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No hay registros de equipos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>