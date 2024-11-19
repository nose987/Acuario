<?php
include '../functions/mostrar_agua.php';

$agua = new Agua();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 30;

$resultado = $agua->obtener_calidad_agua_paginado($pagina, $porPagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Registro de Calidad del Agua</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" type="button" class="btn">Regresar</a>
                <h2>REGISTRO DE CALIDAD DEL AGUA</h2><br>
                <div>
                    <a href="../fpdf/reporte_agua.php" target="_blank" class="generar-reporte">Generar reporte</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>pH</th>
                        <th>Amoniaco</th>
                        <th>Nitrato</th>
                        <th>Nitritos</th>
                        <th>Tanque</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($resultado['datos'])): ?>
                    <?php foreach ($resultado['datos'] as $calidad): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($calidad['pk_agua']); ?></td>
                            <td><?php echo htmlspecialchars($calidad['ph']); ?></td>
                            <td><?php echo htmlspecialchars($calidad['amoniaco']); ?></td>
                            <td><?php echo htmlspecialchars($calidad['nitrato']); ?></td>
                            <td><?php echo htmlspecialchars($calidad['nitritos']); ?></td>
                            <td><?php echo htmlspecialchars($calidad['fk_tanque']); ?></td>
                            <td><?php echo htmlspecialchars($calidad['fecha']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay registros de calidad de agua.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <?php echo generarPaginacionAgua($resultado['totalPaginas'], $resultado['paginaActual']); ?>
        </div>
    </div>
</body>
</html>