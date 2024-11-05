<?php
include("../Class/especie.php");
$especie = new Especie();

// Obtener todas las especies de la base de datos
$especies = $especie->mostrar();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Especies</title>
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
</head>

<body>

    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="aside">
            <?php include("layout/aside.php") ?>
        </div>
        <div class="tabla">
            <h2>Lista de Especies</h2>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Hábitat</th>
                        <th>Temperatura (°C)</th>
                        <th>Cuidados</th>
                        <th>Tipo de Especie</th>
                        <th>Alimento</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($especies as $especie): ?>
                        <tr>
                            <td><?= htmlspecialchars($especie['nombre']) ?></td>
                            <td><?= htmlspecialchars($especie['descripcion']) ?></td>
                            <td><?= htmlspecialchars($especie['habitad']) ?></td>
                            <td><?= htmlspecialchars($especie['temperatura']) ?></td>
                            <td><?= htmlspecialchars($especie['cuidados']) ?></td>
                            <td><?= htmlspecialchars($especie['tipo']) ?></td>
                            <td><?= htmlspecialchars($especie['fk_alimento']) ?></td>
                            <td><img src="img/<?= htmlspecialchars($especie['img_especie']) ?>" alt="Imagen de <?= htmlspecialchars($especie['nombre']) ?>" width="100"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



    <!--<a href="formulario_especies.php">Agregar nueva especie</a>
    <a type="button" onclick="window.location.href='panel_de_especies.php'">
        cancelar
    </a>
    -->

</body>

</html>