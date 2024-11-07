<?php
include_once("../Class/Clase_salud_especies.php");

if (isset($_GET['busqueda'])) {
    $saludEspecies = new SaludEspecies();
    $datos = $saludEspecies->buscar($_GET['busqueda']);
    
    if ($datos->num_rows === 0) {
        echo "No se encontraron datos";
    } else {
        while ($fila = $datos->fetch_assoc()) {
?>
            <tr>
                <td><?php echo date('Y-m-d H:i', strtotime($fila['fecha_revision'])); ?></td>
                <td><?php echo $fila['especie']; ?></td>
                <td><?php echo $fila['peso'] ? $fila['peso'] . ' kg' : '-'; ?></td>
                <td><?php echo $fila['longitud'] ? $fila['longitud'] . ' cm' : '-'; ?></td>
                <td><?php echo $fila['temperatura'] ? $fila['temperatura'] . ' °C' : '-'; ?></td>
                <td><?php echo $fila['estado_general']; ?></td>
                <td><?php echo $fila['comportamiento'] ?: '-'; ?></td>
                <td><?php echo $fila['sintomas'] ?: '-'; ?></td>
                <td><?php echo $fila['observaciones'] ?: '-'; ?></td>
                <td><?php echo $fila['encargado']; ?></td>
            </tr>
<?php
        }
    }
}
?>