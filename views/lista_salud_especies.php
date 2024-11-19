<?php
include("../Class/Clase_salud_especies.php");
$saludEspecies = new SaludEspecies();
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 3;

if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $resultado = $saludEspecies->buscarPaginado($busqueda, $pagina, $porPagina);
} else {
    $resultado = $saludEspecies->mostrarPaginado($pagina, $porPagina);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="stylesheet" href="../Styles/layouts/modal.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Registros de Salud</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <!--<div class="aside"><?php //include("layout/aside.php") 
                                ?></div>-->

        <div class="tabla">
            <div class="controles">
                <a onclick="window.location.href='panel.php'" class="btn">Regresar</a>
                <h2>REGISTRO DE SALUD DE LAS ESPECIES</h2>
                <a href="../fpdf/reporte_salud_especies.php" target="_blank" class="generar-reporte">Generar reporte</a>

            </div>

           <!--<form method="get" action="" class="buscador">
                <div class="search-content">
                    <img src="../Storage/iconos/search-icon.png" class="search-icon">
                    <input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar" class="input" onkeyup="buscarSalud()">

                </div>
            </form>


            LE PUSE ENCABEZADO A LAS TABLAS, EL BUSCADOR PONLO ABAJO DE AQUÍ (ANTES DE LA ETIQUETA "TABLE") Y AGREGA BOTONES DE CANCELAR EN LOS REGISTROS-->
            <table>
                <thead>
                    <tr>
                        <th>Fecha Revisión</th>
                        <th>Especie</th>
                        <th>Peso</th>
                        <th>Longitud</th>
                        <th>Temperatura</th>
                        <th>Estado</th>
                        <th>Comportamiento</th>
                        <th>Síntomas</th>
                        <th>Observaciones</th>
                        <th>Encargado</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php
                    if ($resultado['datos']->num_rows === 0) {
                        echo "<tr><td colspan='10' style='text-align: center;'>No se encontraron datos</td></tr>";
                    } else {
                        while ($fila = $resultado['datos']->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo date('Y-m-d H:i', strtotime($fila['fecha_revision'])); ?></td>
                                <td><?php echo $fila['especie']; ?></td>
                                <td><?php echo $fila['peso'] ? $fila['peso'] . ' kg' : '-'; ?></td>
                                <td><?php echo $fila['longitud'] ? $fila['longitud'] . ' cm' : '-'; ?></td>
                                <td><?php echo $fila['temperatura'] ? $fila['temperatura'] . ' °C' : '-'; ?></td>
                                <td><?php echo $fila['estado_general']; ?></td>
                                <td><?php echo $fila['comportamiento'] ?: '-'; ?></td>
                                <td><?php echo $fila['sintomas'] ?: '-'; ?></td>
                                <td><?php echo $fila['observaciones'] ?: '-'; ?></td>
                                <td><?php echo $fila['encargado']; ?></td>
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
<script src="../functions/buscador_salud.js"></script>

</html>