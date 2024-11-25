<?php
// buscar_diagnostico.php
include_once("../Class/clase_diagnostico_especies.php");
$diagnostico = new Diagnosticos();

$busqueda = $_GET['busqueda'] ?? '';

$datos = $diagnostico->buscarDiagnostico($busqueda);


                    if ($resultado['datos']->num_rows === 0) {
                        echo "<tr><td colspan='8' style='text-align: center;'>No se encontraron tratamientos</td></tr>";
                    } else {
                        while ($fila = $resultado['datos']->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_inicio'])); ?></td>
                                <td><?php echo $fila['fecha_fin'] ? date('d/m/Y H:i', strtotime($fila['fecha_fin'])) : 'No definida'; ?></td>
                                <td><?php echo $fila['especie']; ?></td>
                                <td><?php echo $fila['estado']; ?></td>
                                <td><?php echo $fila['descripcion']; ?></td>
                                <td><?php echo $fila['instrucciones'] ?? 'N/A'; ?></td>
                                <td><?php echo $fila['veterinario']; ?></td>
                                <td><?php echo $fila['observaciones'] ?? 'N/A'; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>