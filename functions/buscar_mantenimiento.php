<?php
include_once("../Class/mantenimiento.php");
$mantenimiento = new Mantenimiento();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $mantenimiento->buscarMantenimiento($busqueda);

if ($datos->num_rows > 0) {
    while ($fila = $datos->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($fila['fk_equipo']) . "</td>
                <td>" . htmlspecialchars($fila['fecha']) . "</td>
                <td>" . htmlspecialchars($fila['tipo_mante']) . "</td>
                <td>" . htmlspecialchars($fila['descripcion']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No se encontraron datos</td></tr>";
}
?>