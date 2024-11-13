<?php
include '../functions/tanque.php';

$tanque = new Tanque();
$tanques = $tanque->obtener_tanques(); // Llama al método y almacena el resultado en $tanques

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <title>Lista de tanques</title>
</head>

<body>

    <?php include("layout/header.php")?>
    <div class="contenido">
        <div class="aside"><?php include("layout/aside.php") ?></div>


        <div class="tabla">
        <h2>REGISTRO DE TANQUES </h2><br>
        <div>
            <a href="../fpdf/reporte_tanques.php" target="_blank">Generar reporte</a>
        </div>
        <!--LE PUSE ENCABEZADO A LAS TABLAS, EL BUSCADOR PONLO ABAJO DE AQUÍ (ANTES DE LA ETIQUETA "TABLE") Y AGREGA BOTONES DE CANCELAR EN LOS REGISTROS-->
        <table>
        <tr>
            <th>Registro</th>
            <th>Capacidad</th>
            <th>Temperatura</th>
            <th>Iluminación</th>
            <th>Filtración</th>
            <th>Área</th>
            <th>Especie</th>
            <th>Fecha</th>
        </tr>
        <?php if (!empty($tanques)): ?>
            <?php foreach ($tanques as $tanque): ?>
                <tr>
                    <td><?php echo $tanque['pk_tanque']; ?></td>
                    <td><?php echo $tanque['capacidad']; ?></td>
                    <td><?php echo $tanque['temperatura']; ?></td>
                    <td><?php echo $tanque['iluminacion']; ?></td>
                    <td><?php echo $tanque['filtracion']; ?></td>
                    <td><?php echo $tanque['fk_area']; ?></td>
                    <td><?php echo $tanque['fk_especie']; ?></td>
                    <td><?php echo $tanque['fecha']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No hay tanques registrados.</td>
            </tr>
        <?php endif; ?>
    </table>
        </div>




    </div>

    
   

</body>

</html>