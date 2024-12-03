<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include '../functions/tanque.php';

$tanque = new Tanque();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 30;
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $resultado = $tanque->buscar_tanques($busqueda, $pagina, $porPagina);
} else {
    $resultado = $tanque->obtener_tanques_paginado($pagina, $porPagina);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Lista de tanques</title>
</head>
<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn">Regresar</a>
                <h2>REGISTRO DE TANQUES </h2><br>
                <div>
                    <a href="../fpdf/reporte_tanques.php" target="_blank" class="generar-reporte">Generar reporte</a>
                </div>
            </div>

            <form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda" 
                           value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>" 
                           placeholder="Buscar" class="input" onkeyup="buscarTanque()">
                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Capacidad</th>
                        <th>Temperatura</th>
                        <th>Iluminación</th>
                        <th>Filtración</th>
                        <th>Área</th>
                        <th>Especie</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php if (!empty($resultado['datos'])): ?>
                        <?php foreach ($resultado['datos'] as $tanque): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tanque['pk_tanque']); ?></td>
                                <td><?php echo htmlspecialchars($tanque['capacidad']); ?></td>
                                <td><?php echo htmlspecialchars($tanque['temperatura']); ?></td>
                                <td><?php echo htmlspecialchars($tanque['iluminacion']); ?></td>
                                <td><?php echo htmlspecialchars($tanque['filtracion']); ?></td>
                                <td><?php echo htmlspecialchars($tanque['nombre_area']); ?></td>
                                <td><?php echo htmlspecialchars($tanque['nombre_especie']); ?></td>
                                <td><?php echo htmlspecialchars($tanque['fecha']); ?></td>
                                <td class="acciones">
                                    <a href="editar_tanque.php?id=<?php echo $tanque['pk_tanque']; ?>" class="btn-editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="confirmarEliminar(<?php echo $tanque['pk_tanque']; ?>)" class="btn-eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">No hay tanques registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php 
            $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
            echo generarPaginacionTanques($resultado['totalPaginas'], $resultado['paginaActual'], $busqueda);
            ?>
        </div>
    </div>
</body>
<script>
    function confirmarEliminar(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este tanque?')) {
            window.location.href = '../functions/eliminar_tanque.php?id=' + id;
        }
    }
    </script>
<script src="../functions/buscador.js"></script>
</html>