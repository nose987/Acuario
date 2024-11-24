<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
include '../functions/mostrar_equipo.php';

$equipo = new Equipo();
$equipo = $equipo->mostrar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/tabla.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Equipos</title>
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
       
        <div class="tabla">
            <div class="controles">
            <a onclick="window.location.href='panel.php'" class="btn" type="button">Regresar</a>
                <h2>Equipos</h2>
              
                <a href="../fpdf/reporte_equipo.php" target="_blank" class="generar-reporte">Generar reporte</a>

            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Tanque</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($equipo)): ?>
                        <?php foreach ($equipo as $equipo): ?>
                            <tr>
                                <td><?php echo $equipo['nombre']; ?></td>
                                <td><?php echo $equipo['estado']; ?></td>
                                <td><?php echo $equipo['fk_tanque']; ?></td>
                                <td><?php echo $equipo['fecha']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No hay registros de equipos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>