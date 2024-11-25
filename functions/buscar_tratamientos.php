<?php
include_once("../Class/clase_tratamiento_especie.php");
$tratamientos = new Tratamientos();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $tratamientos->buscarTratamiento($busqueda);

if ($datos->num_rows > 0) {
    while ($fila = $datos->fetch_assoc()) {
        echo "<tr>
                <td>" . date('d/m/Y H:i', strtotime($fila['fecha_inicio'])) . "</td>
                <td>" . ($fila['fecha_fin'] ? date('d/m/Y H:i', strtotime($fila['fecha_fin'])) : 'No definida') . "</td>
                <td>{$fila['especie']}</td>
                <td>{$fila['estado']}</td>
                <td>{$fila['descripcion']}</td>
                <td>{$fila['instrucciones']}</td>
                <td>{$fila['veterinario']}</td>
                <td>{$fila['observaciones']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8' style='text-align: center;'>No se encontraron tratamientos</td></tr>";
}
?>