<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include("../functions/mostrar_empleados.php");
$empleado = new mostrarEmpleados();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 3;
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $resultado = $empleado->buscar_empleados($busqueda, $pagina, $porPagina);
} else {
    $resultado = $empleado->obtener_empleados_paginado($pagina, $porPagina);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="tabla">

            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn">Regresar</a>
                <h2>LISTA DE EMPLEADOS</h2><br>
                <div>
                    <a href="../fpdf/reporte_usuario.php" target="_blank" class="generar-reporte">Generar reporte</a>
                </div>

            </div>

            <form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda"
                        value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>"
                        placeholder="Buscar" class="input" onkeyup="buscarUsuario()">
                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha de nac.</th>
                        <th>Num. telefono</th>
                        <th>Genero</th>
                        <th>Dirección</th>
                        <th>Rol</th>
                        <th>Area</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php if (!empty($resultado['datos'])): ?>
                        <?php foreach ($resultado['datos'] as $empleado): ?>
                            <tr>
                                <td><?= htmlspecialchars($empleado['nombrecompleto']) ?></td>
                                <td><?= htmlspecialchars($empleado['correo']) ?></td>
                                <td><?= htmlspecialchars($empleado['fecha_nac']) ?></td>
                                <td><?= htmlspecialchars($empleado['telefono']) ?></td>
                                <td><?= htmlspecialchars($empleado['genero']) ?></td>
                                <td><?= htmlspecialchars($empleado['direccion']) ?></td>
                                <td><?= htmlspecialchars($empleado['rol']) ?></td>
                                <td><?= htmlspecialchars($empleado['area']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">No hay empleados registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php
            $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
            echo generarPaginacionEmpleados($resultado['totalPaginas'], $resultado['paginaActual'], $busqueda);
            ?>
        </div>
    </div>
</body>
<script src="../functions/buscador.js"></script>

</html>