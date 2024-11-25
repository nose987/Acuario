<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include_once '../functions/mostrar_mantenimiento.php';
$mantenimiento = new Mantenimiento();

// Parámetros de paginación
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$registrosPorPagina = 30;
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;

// Total de registros
$totalRegistros = $mantenimiento->contarTotalMantenimiento($busqueda);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Calcula el índice inicial
$inicio = ($pagina - 1) * $registrosPorPagina;

// Obtener datos
$datosMantenimiento = $mantenimiento->mostrarMantePaginado($inicio, $registrosPorPagina, $busqueda);

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
                <a href="../fpdf/reporte_mantenimiento.php" target="_blank" class="generar-reporte">Generar reporte</a>
            </div>

            <form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" class="input" onkeyup="buscarMantenimiento()">

                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Fecha</th>
                        <th>Tipo de mantenimiento</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php if (!empty($datosMantenimiento) && $datosMantenimiento->num_rows > 0): ?>
                        <?php while ($mantenimiento = $datosMantenimiento->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($mantenimiento['fk_equipo']); ?></td>
                                <td><?php echo htmlspecialchars($mantenimiento['fecha']); ?></td>
                                <td><?php echo htmlspecialchars($mantenimiento['tipo_mante']); ?></td>
                                <td><?php echo htmlspecialchars($mantenimiento['descripcion']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No hay registros de mantenimiento.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php
                $busquedaParam = $busqueda ? '&busqueda=' . urlencode($busqueda) : '';

                // Botón anterior
                if ($pagina > 1) {
                    echo '<a href="?pagina=' . ($pagina - 1) . $busquedaParam . '" class="page-link">&laquo;</a>';
                }

                // Primera página
                echo '<a href="?pagina=1' . $busquedaParam . '" class="page-link ' . ($pagina == 1 ? 'active' : '') . '">1</a>';

                // Páginas intermedias
                $rango = 2;
                for ($i = max(2, $pagina - $rango); $i <= min($totalPaginas - 1, $pagina + $rango); $i++) {
                    echo '<a href="?pagina=' . $i . $busquedaParam . '" class="page-link ' . ($pagina == $i ? 'active' : '') . '">' . $i . '</a>';
                }

                // Última página
                if ($totalPaginas > 1) {
                    echo '<a href="?pagina=' . $totalPaginas . $busquedaParam . '" class="page-link ' . ($pagina == $totalPaginas ? 'active' : '') . '">' . $totalPaginas . '</a>';
                }

                // Botón siguiente
                if ($pagina < $totalPaginas) {
                    echo '<a href="?pagina=' . ($pagina + 1) . $busquedaParam . '" class="page-link">&raquo;</a>';
                }
                ?>
            </div>

        </div>
    </div>
</body>
<script src="../functions/buscador.js"></script>

</html>