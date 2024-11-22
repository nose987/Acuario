<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include '../functions/mostrar_alimentacion.php';

$alimentacion = new Alimentacion();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 30;

$resultado = $alimentacion->obtener_alimentacion_paginado($pagina, $porPagina);
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
        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn">Regresar</a>
                <h2>REGISTRO DE ALIMENTACIÓN</h2><br>
                <div>
                    <a href="../fpdf/reporte_alimentacion.php" target="_blank" class="generar-reporte">Generar reporte</a>
                </div>
            </div>

            <table>
                <thead>
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
                </thead>
                <tbody>
                <?php if (!empty($resultado['datos'])): ?>
                    <?php foreach ($resultado['datos'] as $programacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($programacion['pk_alimentacion']); ?></td>
                            <td><?php echo htmlspecialchars($programacion['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($programacion['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($programacion['hora']); ?></td>
                            <td><?php echo htmlspecialchars($programacion['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($programacion['nombre_area']); ?></td>
                            <td><?php echo htmlspecialchars($programacion['nombre_especie']); ?></td>
                            <td><?php echo htmlspecialchars($programacion['nombre_alimento']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No hay programaciones de alimentación registradas.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <?php echo generarPaginacionAlimentacion($resultado['totalPaginas'], $resultado['paginaActual']); ?>
        </div>
    </div>
</body>
</html>