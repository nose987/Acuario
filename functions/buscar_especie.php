<?php
require_once '../Class/clase_conexion.php';

if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];


    $conexion = Conexion::conectar();

    // Preparar la consulta SQL con búsqueda en nombre, habitat y tipo de especie
    $sql = "SELECT e.*, te.tipo, i.nombre as alimento 
        FROM especie e 
        INNER JOIN tipo_especie te ON e.fk_tipo_especie = te.pk_tipo_especie 
        LEFT JOIN inventario i ON e.fk_alimento = i.pk_inventario
        WHERE e.nombre LIKE ? 
        OR e.habitad LIKE ? 
        OR te.tipo LIKE ?";

    $stmt = $conexion->prepare($sql);
    $busquedaParam = "%" . $busqueda . "%";
    $stmt->bind_param("sss", $busquedaParam, $busquedaParam, $busquedaParam);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($especie = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($especie['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($especie['descripcion']) . "</td>";
            echo "<td>" . htmlspecialchars($especie['habitad']) . "</td>";
            echo "<td>" . htmlspecialchars($especie['temperatura']) . "</td>";
            echo "<td>" . htmlspecialchars($especie['cuidados']) . "</td>";
            echo "<td>" . htmlspecialchars($especie['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($especie['alimento']) . "</td>"; ?>
            <td><img src="../Storage/<?= htmlspecialchars($especie['img_especie']) ?>" alt="Imagen de <?= htmlspecialchars($especie['nombre']) ?>" width="100"></td>
<?php echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No se encontraron resultados.</td></tr>";
    }

    $stmt->close();
    $conexion->close();
}
?>