<?php
include_once("mostrar_agua.php");
$agua = new Agua();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $agua->buscar($busqueda);

if ($datos->num_rows > 0) {
    while ($fila = $datos->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['pk_agua']}</td>
                <td>{$fila['ph']}</td>
                <td>{$fila['amoniaco']}</td>
                <td>{$fila['nitrato']}</td>
                <td>{$fila['nitritos']}</td>
                <td>{$fila['fk_tanque']}</td>
                <td>{$fila['fecha']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron registros</td></tr>";
}
?>