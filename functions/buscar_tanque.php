<?php
require_once '../Class/conexion.php';  // Usamos require_once en lugar de include
require_once '../functions/tanque.php';

if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    
    $conexion = new Conexion();
    $conn = $conexion->conn;
    
    // Preparar la consulta SQL con búsqueda en área y especie
    $sql = "SELECT t.pk_tanque, t.capacidad, t.temperatura, t.iluminacion, 
                   t.filtracion, a.nombre as nombre_area, e.nombre as nombre_especie, 
                   t.fecha 
            FROM tanque t 
            JOIN area a ON t.fk_area = a.pk_area 
            JOIN especie e ON t.fk_especie = e.pk_especie 
            WHERE a.nombre LIKE ? OR e.nombre LIKE ?";
            
    $stmt = $conn->prepare($sql);
    $busquedaParam = "%" . $busqueda . "%";
    $stmt->bind_param("ss", $busquedaParam, $busquedaParam);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        while ($tanque = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $tanque['pk_tanque'] . "</td>";
            echo "<td>" . $tanque['capacidad'] . "</td>";
            echo "<td>" . $tanque['temperatura'] . "</td>";
            echo "<td>" . $tanque['iluminacion'] . "</td>";
            echo "<td>" . $tanque['filtracion'] . "</td>";
            echo "<td>" . $tanque['nombre_area'] . "</td>";
            echo "<td>" . $tanque['nombre_especie'] . "</td>";
            echo "<td>" . $tanque['fecha'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No se encontraron resultados.</td></tr>";
    }
    
    $stmt->close();
    $conn->close();
}
?>