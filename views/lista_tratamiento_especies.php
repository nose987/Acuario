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
        <div class="aside"><?php include("layout/aside.php") ?></div>

        <div class="tabla">
            <form method="get" action="" class="buscador">
                <input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar" class="input" onkeyup="buscarTratamiento()">
            </form>

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
                    include("../Class/clase_tratamiento_especie.php");
                    $tratamientos = new Tratamientos();
                    $datos = $tratamientos->mostrar();
                    if ($datos->num_rows === 0) {
                        echo "No se encontraron tratamientos";
                    } else {
                        while ($fila = $datos->fetch_assoc()) {
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
        </div>
    </div>
</body>
<script src="../functions/buscador_tratamiento.js"></script>
</html>