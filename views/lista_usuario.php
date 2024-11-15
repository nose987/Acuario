<?php
include("../functions/mostrar_empleados.php");
$empleado = new mostrarEmpleados();

// Obtener todas las especies de la base de datos
$empleados = $empleado->mostrar();

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
            <h2>REGISTRO DE USUARIOS</h2><br>
            <div>
                <a href="../fpdf/reporte_usuario.php" target="_blank">Generar reporte</a>
            </div>
            <!--LE PUSE ENCABEZADO A LAS TABLAS, EL BUSCADOR PONLO ABAJO DE AQUÍ (ANTES DE LA ETIQUETA "TABLE") Y AGREGA BOTONES DE CANCELAR EN LOS REGISTROS
            <form method="get" action="" class="buscador">
                <input type="text" name="busqueda" id="busqueda" value="" placeholder="Buscar" class="input" onkeyup="buscarEmpleado()">

            </form>-->
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha de nac.</th>
                        <th>Num. telefono</th>
                        <th>Genero</th>
                        <th>Dirección</th>
                        <th>Rol</th>
                        <th>Area</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?= htmlspecialchars($empleado['nombrecompleto']) ?></td>
                            <td><?= htmlspecialchars($empleado['correo']) ?></td>
                            <td><?= htmlspecialchars($empleado['fecha_nac']) ?></td>
                            <td><?= htmlspecialchars($empleado['telefono']) ?></td>
                            <td><?= htmlspecialchars($empleado['genero']) ?></td>
                            <td><?= htmlspecialchars($empleado['direccion']) ?></td>
                            <td><?= htmlspecialchars($empleado['rol']) ?></td>
                            <td><?= htmlspecialchars($empleado['area']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



    

</body>
<script src="../functions/buscador.js"></script>

</html>