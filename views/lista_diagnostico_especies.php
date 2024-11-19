<?php
include("../Class/clase_diagnostico_especies.php");
$diagnosticos = new Diagnosticos();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 30;

if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $resultado = $diagnosticos->buscarPaginado($busqueda, $pagina, $porPagina);
} else {
    $resultado = $diagnosticos->mostrarPaginado($pagina, $porPagina);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Diagnósticos</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <!--<div class="aside"><?php //include("layout/aside.php") 
                                ?></div>-->

        <div class="tabla">


            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn">Regresar</a>
                <h2>REGISTRO DE DIAGNOSTICOS</h2>
                <a href="../fpdf/reporte_diagnostico.php" target="_blank" class="generar-reporte">Generar reporte</a>
            </div>

            <!--<form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" class="input" onkeyup="buscarDiagnostico()">

                </div>
            </form>
            LE PUSE ENCABEZADO A LAS TABLAS, EL BUSCADOR PONLO ABAJO DE AQUÍ (ANTES DE LA ETIQUETA "TABLE") Y AGREGA BOTONES DE CANCELAR EN LOS REGISTROS-->
            <table>
                <thead>
                    <tr>
                        <th>Fecha Diagnóstico</th>
                        <th>Especie</th>
                        <th>Fecha Revisión</th>
                        <th>Estado General</th>
                        <th>Gravedad</th>
                        <th>Descripción</th>
                        <th>Veterinario</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                <?php
                    if ($resultado['datos']->num_rows === 0) {
                        echo "<tr><td colspan='7' style='text-align: center;'>No se encontraron diagnósticos</td></tr>";
                    } else {
                        while ($fila = $resultado['datos']->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_diagnostico'])); ?></td>
                                <td><?php echo $fila['especie']; ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_revision'])); ?></td>
                                <td><?php echo $fila['estado_general']; ?></td>
                                <td><?php echo $fila['gravedad']; ?></td>
                                <td><?php echo $fila['descripcion']; ?></td>
                                <td><?php echo $fila['veterinario']; ?></td>
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
</body>
<script src="../functions/buscador_diagnostico.js"></script>

</html>