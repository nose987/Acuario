<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include("../Class/especie.php");
$especie = new Especie();

// Obtener la página actual
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 30;

// Manejar búsqueda y paginación
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $resultado = $especie->buscar_especies($busqueda, $pagina, $porPagina);
} else {
    $resultado = $especie->obtener_especies_paginado($pagina, $porPagina);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Especies</title>
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
</head>
<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn">Regresar</a>
                <h2>REGISTRO DE ESPECIES</h2><br>
                <div>
                    <a href="../fpdf/reporte_especies.php" target="_blank" class="generar-reporte">Generar reporte</a>
                </div>
            </div>

            <form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda" 
                           value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>" 
                           placeholder="Buscar" class="input" onkeyup="buscarEspecie()">
                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Hábitat</th>
                        <th>Temperatura (°C)</th>
                        <th>Cuidados</th>
                        <th>Tipo de Especie</th>
                        <th>Alimento</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php if ($resultado['datos'] && $resultado['datos']->num_rows > 0): ?>
                        <?php while ($especie = $resultado['datos']->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($especie['nombre']) ?></td>
                                <td><?= htmlspecialchars($especie['descripcion']) ?></td>
                                <td><?= htmlspecialchars($especie['habitad']) ?></td>
                                <td><?= htmlspecialchars($especie['temperatura']) ?></td>
                                <td><?= htmlspecialchars($especie['cuidados']) ?></td>
                                <td><?= htmlspecialchars($especie['tipo']) ?></td>
                                <td><?= htmlspecialchars($especie['fk_alimento']) ?></td>
                                <td><img src="img/<?= htmlspecialchars($especie['img_especie']) ?>" alt="Imagen de <?= htmlspecialchars($especie['nombre']) ?>" width="100"></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">No hay especies registradas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php 
            $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
            echo generarPaginacionEspecies($resultado['totalPaginas'], $resultado['paginaActual'], $busqueda);
            ?>
        </div>
    </div>
</body>
<script src="../functions/buscador.js"></script>
</html>