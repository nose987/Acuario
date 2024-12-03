<?php
include_once("../Class/clase_conexion.php");

function buscarUsuarios($busqueda) {
    $conexion = Conexion::conectar();
    
    $sql = "SELECT 
                p.nombre, 
                p.apaterno, 
                p.amaterno, 
                p.correo, 
                p.fecha_nac,
                p.telefono,
                p.genero,
                p.direccion,
                r.roles as rol,
                a.nombre as area
            FROM persona p 
            LEFT JOIN roles r ON p.fk_roles = r.pk_roles 
            LEFT JOIN area a ON p.fk_area = a.pk_area 
            WHERE (
                p.nombre LIKE ? OR 
                p.apaterno LIKE ? OR 
                p.amaterno LIKE ? OR 
                p.correo LIKE ? OR 
                r.roles LIKE ? OR 
                a.nombre LIKE ?) AND p.estatus = 1";
    
    $stmt = $conexion->prepare($sql);
    $param = '%' . $busqueda . '%';
    $stmt->bind_param("ssssss", $param, $param, $param, $param, $param, $param);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['nombre'] . ' ' . $row['apaterno'] . ' ' . $row['amaterno']) . "</td>
                    <td>" . htmlspecialchars($row['correo']) . "</td>
                    <td>" . htmlspecialchars($row['fecha_nac']) . "</td>
                    <td>" . htmlspecialchars($row['telefono']) . "</td>
                    <td>" . htmlspecialchars($row['genero']) . "</td>
                    <td>" . htmlspecialchars($row['direccion']) . "</td>
                    <td>" . htmlspecialchars($row['rol']) . "</td>
                    <td>" . htmlspecialchars($row['area']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>No se encontraron resultados</td></tr>";
    }
}

// Si se recibe una búsqueda, procesar
if (isset($_GET['busqueda'])) {
    buscarUsuarios($_GET['busqueda']);
}
?>