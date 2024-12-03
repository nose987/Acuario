<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
require_once '../functions/mostrar_equipo.php';

$equipo = new Equipo();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$limite = 30;
$offset = ($pagina - 1) * $limite;
$equipos = $equipo->mostrar($offset, $limite);
$totalEquipos = $equipo->contarTotal();
$totalPaginas = ceil($totalEquipos / $limite);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Equipos</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">

        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn" type="button">Regresar</a>
                <h2>Equipos</h2>

                <a href="../fpdf/reporte_equipo.php" target="_blank" class="generar-reporte">Generar reporte</a>

            </div>

            <form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" class="input" onkeyup="buscarEquipo()">

                </div>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Tanque</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php if (!empty($equipos)): ?>
                        <?php foreach ($equipos as $equipo): ?>
                            <tr>
                                <td><?php echo $equipo['nombre']; ?></td>
                                <td><?php echo $equipo['estado']; ?></td>
                                <td><?php echo $equipo['fk_tanque']; ?></td>
                                <td><?php echo $equipo['fecha']; ?></td>
                                <td class="acciones">
                                    <a href="editar_equipo.php?id=<?php echo $equipo['pk_equipo']; ?>" class="btn-editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="confirmarEliminar(<?php echo $equipo['pk_equipo']; ?>)" class="btn-eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No hay registros de equipos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a href="?pagina=<?php echo $i; ?>"
                        class="page-link <?php echo $i == $pagina ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>
<script>
    function confirmarEliminar(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este equipo?')) {
            window.location.href = '../functions/eliminar_equipo.php?id=' + id;
        }
    }
    </script>
<script src="../functions/buscador.js"></script>

</html>