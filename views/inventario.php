<?php
include("../Class/clase_inventario.php");
$inventario = new Inventario();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 30;

if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $resultado = $inventario->buscarPaginado($busqueda, $pagina, $porPagina);
} else {
    $resultado = $inventario->mostrarPaginado($pagina, $porPagina);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/layouts/modal.css">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Inventario</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <!--<div class="aside"><?php //include("layout/aside.php") 
                                ?></div>-->
        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn" type="button">Regresar</a>
                <h2>REGISTRO DE INVENTARIO</h2>
                <a href="../fpdf/reporte_inventario.php" target="_blank" class="generar-reporte">
                    Generar reporte
                </a>
            </div>

            <form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Buscar en inventario..." class="input" onkeyup="buscarInventario()">

                </div>
            </form>


            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php
                    
                    $inventario = new Inventario();
                    $datos = $inventario->mostrar();
                    if ($resultado['datos']->num_rows === 0) {
                        echo "<tr><td colspan='6' style='text-align: center;'>No se encontraron datos</td></tr>";
                    } else {
                        while ($fila = $resultado['datos']->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $fila['codigo']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['categoria']; ?></td>
                                <td><?php echo $fila['stock']; ?></td>
                                <td><?php echo $fila['descripcion']; ?></td>
                                <td>
                                    <button type="button" class="boton" onclick="abrirModal('<?php echo $fila['codigo']; ?>', '<?php echo $fila['nombre']; ?>', '<?php echo $fila['stock']; ?>')">
                                        Añadir
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
        $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
        echo generarPaginacion($resultado['totalPaginas'], $resultado['paginaActual'], $busqueda);
        ?>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="contenido_modal">
            <span class="cerrar" onclick="cerrarModal()">&times;</span>
            <div class="titulo">
                <h2>Ingresa nuevo stock</h2>
            </div>
            <div class="form_modal">
                <form method="post">
                    <label for="">Codigo producto: </label>
                    <input type="text" id="codigo" name="codigo" class="input2" readonly><br><br>
                    <label for="">Nombre del producto: </label>
                    <input type="text" id="nombre" name="nombre" class="input2" readonly><br><br>
                    <label for="">Stock actual: </label>
                    <input type="text" id="stock" name="stock" class="input2" readonly><br><br>
                    <label for="">Nuevo stock: </label>
                    <input type="number" id="nuevo_stock" name="nuevo_stock" class="input2" required><br>
                    <input type="submit" value="Agregar" class="boton" style="margin-top: 15px;">
                </form>
            </div>
        </div>


    </div>
</body>
<script src="../functions/modal.js"></script>
<script src="../functions/buscador.js"></script>
<script src="../functions/aside.js"></script>

</html>