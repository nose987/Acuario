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
        <div class="aside"><?php include("layout/aside.php") ?></div>
        
        <div class="tabla">
        <h2>REGISTRO DE SALUD DE LAS ESPECIES</h2>
            <form method="get" action="" class="buscador">
                <input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar" class="input" onkeyup="buscarSalud()">
            </form>
            
            <div>
                <a href="../fpdf/reporte_salud_especies.php" target="_blank">Generar reporte</a>
            </div>
            <!--LE PUSE ENCABEZADO A LAS TABLAS, EL BUSCADOR PONLO ABAJO DE AQUÍ (ANTES DE LA ETIQUETA "TABLE") Y AGREGA BOTONES DE CANCELAR EN LOS REGISTROS-->
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
                    include("../Class/Clase_salud_especies.php");
                    $saludEspecies = new SaludEspecies();
                    $datos = $saludEspecies->mostrar();
                    if ($datos->num_rows === 0) {
                        echo "No se encontraron datos";
                    } else {
                        while ($fila = $datos->fetch_assoc()) {
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
        </div>
    </div>
</body>
<script src="../functions/buscador_salud.js"></script>
</html>