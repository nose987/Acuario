<?php
include_once("../Class/equipo.php");
$equipo = new Equipo();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $equipo->buscarEquipo($busqueda);

if ($datos->num_rows > 0) {
    while ($fila = $datos->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['nombre']}</td>
                <td>{$fila['estado']}</td>
                <td>{$fila['fk_tanque']}</td>
                <td>{$fila['fecha']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No se encontraron datos</td></tr>";
}
?>