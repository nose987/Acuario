<?php
include_once("../Class/clase_inventario.php");
$inventario = new Inventario();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $inventario->buscar($busqueda);

if ($datos->num_rows > 0) {
    while ($fila = $datos->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['codigo']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['categoria']}</td>
                <td>{$fila['stock']}</td>
                <td>{$fila['descripcion']}</td>
                <td><button type='button' class='boton' onclick=\"abrirModal('{$fila['codigo']}', '{$fila['nombre']}', '{$fila['stock']}')\">Añadir</button></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No se encontraron datos</td></tr>";
}
?>
