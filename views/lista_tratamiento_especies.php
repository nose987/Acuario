<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include("../Class/clase_tratamiento_especie.php");
$tratamientos = new Tratamientos();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 30;

if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $resultado = $tratamientos->buscarPaginado($busqueda, $pagina, $porPagina);
} else {
    $resultado = $tratamientos->mostrarPaginado($pagina, $porPagina);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Tratamientos</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <!--<div class="aside"><?php //include("layout/aside.php") 
                                ?></div>-->

        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn">Regresar</a>
                <h2>REGISTRO DE LOS TRATAMIENTOS</h2>
                <a href="../fpdf/reporte_tratamientos.php" target="_blank" class="generar-reporte">Generar reporte</a>

            </div>
           <form method="get" action="" class="buscador">
                    <div class="search-content">
                        <img src="../Storage/iconos/search-icon.png" class="search-icon">
                        <input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar" class="input" onkeyup="buscarTratamiento()">
                    
                </div>
            </form>
            
             <!--LE PUSE ENCABEZADO A LAS TABLAS, EL BUSCADOR PONLO ABAJO DE AQUÍ (ANTES DE LA ETIQUETA "TABLE") Y AGREGA BOTONES DE CANCELAR EN LOS REGISTROS-->
            <table>
                <thead>
                    <tr>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Especie</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                        <th>Instrucciones</th>
                        <th>Veterinario</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php
                    if ($resultado['datos']->num_rows === 0) {
                        echo "<tr><td colspan='8' style='text-align: center;'>No se encontraron tratamientos</td></tr>";
                    } else {
                        while ($fila = $resultado['datos']->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_inicio'])); ?></td>
                                <td><?php echo $fila['fecha_fin'] ? date('d/m/Y H:i', strtotime($fila['fecha_fin'])) : 'No definida'; ?></td>
                                <td><?php echo $fila['especie']; ?></td>
                                <td><?php echo $fila['estado']; ?></td>
                                <td><?php echo $fila['descripcion']; ?></td>
                                <td><?php echo $fila['instrucciones'] ?? 'N/A'; ?></td>
                                <td><?php echo $fila['veterinario']; ?></td>
                                <td><?php echo $fila['observaciones'] ?? 'N/A'; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
            echo $tratamientos->generarPaginacionTratamientos($resultado['totalPaginas'], $resultado['paginaActual'], $busqueda);
            ?>
        </div>
    </div>
</body>
<script src="../functions/buscador.js"></script>

</html>