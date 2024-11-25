<?php
include_once("../Class/clase_salud_especies.php");
$saludEspecies = new SaludEspecies();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $saludEspecies->buscarSalud($busqueda);

if ($datos->num_rows > 0) {
    while ($fila = $datos->fetch_assoc()) {
        echo "<tr>
                <td>" . date('Y-m-d H:i', strtotime($fila['fecha_revision'])) . "</td>
                <td>{$fila['especie']}</td>
                <td>" . ($fila['peso'] ? $fila['peso'] . ' kg' : '-') . "</td>
                <td>" . ($fila['longitud'] ? $fila['longitud'] . ' cm' : '-') . "</td>
                <td>" . ($fila['temperatura'] ? $fila['temperatura'] . ' °C' : '-') . "</td>
                <td>{$fila['estado_general']}</td>
                <td>" . ($fila['comportamiento'] ?: '-') . "</td>
                <td>" . ($fila['sintomas'] ?: '-') . "</td>
                <td>" . ($fila['observaciones'] ?: '-') . "</td>
                <td>{$fila['encargado']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='10' style='text-align: center;'>No se encontraron datos</td></tr>";
}
?>