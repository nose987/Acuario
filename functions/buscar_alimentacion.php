<?php
include_once("mostrar_alimentacion.php");
$alimentacion = new Alimentacion();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $alimentacion->buscar($busqueda);

if ($datos->num_rows > 0) {
    while ($fila = $datos->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['pk_alimentacion']}</td>
                <td>{$fila['cantidad']}</td>
                <td>{$fila['descripcion']}</td>
                <td>{$fila['hora']}</td>
                <td>{$fila['fecha']}</td>
                <td>{$fila['nombre_area']}</td>
                <td>{$fila['nombre_especie']}</td>
                <td>{$fila['nombre_alimento']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No se encontraron registros</td></tr>";
}
?>