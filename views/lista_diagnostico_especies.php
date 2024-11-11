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
        <div class="aside"><?php include("layout/aside.php") ?></div>

        <div class="tabla">
            <form method="get" action="" class="buscador">
                <input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar" class="input" onkeyup="buscarDiagnostico()">
            </form>

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
                    include("../Class/clase_diagnostico_especies.php");
                    $diagnosticos = new Diagnosticos();
                    $datos = $diagnosticos->mostrar();
                    if ($datos->num_rows === 0) {
                        echo "No se encontraron diagnósticos";
                    } else {
                        while ($fila = $datos->fetch_assoc()) {
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
        </div>
    </div>
</body>
<script src="../functions/buscador_diagnostico.js"></script>
</html>