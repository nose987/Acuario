<?php
include '../functions/mostrar_agua.php';

$agua = new Agua();
$calidades = $agua->obtener_calidad_agua();
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
            <h2>REGISTRO DE LA CALIDAD DEL AGUA</h2><br>
            <div>
                <a  href="../fpdf/reporte_agua.php" target="_blank">Generar reporte</a>
            </div>
            <!--LE PUSE ENCABEZADO A LAS TABLAS, EL BUSCADOR PONLO ABAJO DE AQUÍ (ANTES DE LA ETIQUETA "TABLE") Y AGREGA BOTONES DE CANCELAR EN LOS REGISTROS-->
            <table >
                <tr>
                    <th>Registro</th>
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
        </div>
    </div>
</body>

</html>