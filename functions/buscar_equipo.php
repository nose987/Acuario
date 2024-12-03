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
                <td class='acciones'>
                    <a href='editar_equipo.php?id={$fila['pk_equipo']}' class='btn-editar'>
                        <i class='fas fa-edit'></i>
                    </a>
                    <a href='#' onclick='confirmarEliminar({$fila['pk_equipo']})' class='btn-eliminar'>
                        <i class='fas fa-trash'></i>
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron datos</td></tr>";
}
?>