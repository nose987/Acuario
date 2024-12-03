<?php
require_once "../Class/clase_conexion.php";
class mostrarEmpleados{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function mostrar(){
        $sql = "SELECT p.pk_persona, CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) as nombrecompleto, p.correo, p.fecha_nac, p.telefono, p.genero, p.direccion, r.roles as rol, a.nombre as area FROM roles r INNER JOIN persona p ON r.pk_roles=p.fk_roles INNER JOIN area a on p.fk_area=a.pk_area WHERE estatus=1";

        $result = $this->conexion->query($sql);
        return $result;
    }

    public function obtener_empleados_paginado($pagina = 1, $porPagina = 30) {
        // Calcular el offset
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de registros
        $sqlTotal = "SELECT COUNT(*) as total FROM persona WHERE estatus = 1";
        $resultTotal = $this->conexion->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];

        // Consulta paginada
        $sql = "SELECT p.pk_persona,
            CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) as nombrecompleto, 
            p.correo, 
            p.fecha_nac, 
            p.telefono, 
            p.genero, 
            p.direccion, 
            r.roles as rol, 
            a.nombre as area 
        FROM roles r 
        INNER JOIN persona p ON r.pk_roles=p.fk_roles 
        INNER JOIN area a on p.fk_area=a.pk_area WHERE p.estatus = 1
        LIMIT ? OFFSET ?";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $porPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        return [
            'datos' => $resultado->fetch_all(MYSQLI_ASSOC),
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }
    

    public function buscar_empleados($busqueda, $pagina = 1, $porPagina = 30) {
        $offset = ($pagina - 1) * $porPagina;
        $param = '%' . $busqueda . '%';
        
        // Obtener total de resultados de búsqueda
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM roles r 
                     INNER JOIN persona p ON r.pk_roles=p.fk_roles 
                     INNER JOIN area a on p.fk_area=a.pk_area
                     WHERE ( CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) LIKE ? 
                     OR p.correo LIKE ? 
                     OR p.telefono LIKE ?
                     OR r.roles LIKE ?
                     OR a.nombre LIKE ?) AND estatus = 1";
        
        $stmtTotal = $this->conexion->prepare($sqlTotal);
        $stmtTotal->bind_param("sssss", $param, $param, $param, $param, $param);
        $stmtTotal->execute();
        $total = $stmtTotal->get_result()->fetch_assoc()['total'];

        // Consulta paginada con búsqueda
        $sql = "SELECT p.pk_persona,
            CONCAT (p.nombre, ' ', p.apaterno, ' ', p.amaterno) as nombrecompleto,
            p.correo, 
            p.fecha_nac, 
            p.telefono, 
            p.genero, 
            p.direccion, 
            r.roles as rol, 
            a.nombre as area 
        FROM roles r 
        INNER JOIN persona p ON r.pk_roles=p.fk_roles 
        INNER JOIN area a on p.fk_area=a.pk_area
        WHERE ( CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) LIKE ? 
        OR p.correo LIKE ? 
        OR p.telefono LIKE ?
        OR r.roles LIKE ?
        OR a.nombre LIKE ?
        LIMIT ? OFFSET ?) AND WHERE estatus = 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssssii", $param, $param, $param, $param, $param, $porPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return [
            'datos' => $resultado->fetch_all(MYSQLI_ASSOC),
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }
}

// Función para generar los enlaces de paginación
function generarPaginacionEmpleados($totalPaginas, $paginaActual, $busqueda = '') {
    $html = '<div class="pagination">';
    
    // Botón anterior
    if ($paginaActual > 1) {
        $html .= '<a href="?pagina=' . ($paginaActual - 1) . ($busqueda ? '&busqueda=' . urlencode($busqueda) : '') . '" class="page-link">&laquo;</a>';
    }
    
    // Primera página
    $html .= '<a href="?pagina=1' . ($busqueda ? '&busqueda=' . urlencode($busqueda) : '') . '" class="page-link ' . ($paginaActual == 1 ? 'active' : '') . '">1</a>';
    
    // Páginas intermedias
    $rango = 2;
    for ($i = max(2, $paginaActual - $rango); $i <= min($totalPaginas - 1, $paginaActual + $rango); $i++) {
        $html .= '<a href="?pagina=' . $i . ($busqueda ? '&busqueda=' . urlencode($busqueda) : '') . '" class="page-link ' . ($paginaActual == $i ? 'active' : '') . '">' . $i . '</a>';
    }
    
    // Última página si no es la primera
    if ($totalPaginas > 1) {
        $html .= '<a href="?pagina=' . $totalPaginas . ($busqueda ? '&busqueda=' . urlencode($busqueda) : '') . '" class="page-link ' . ($paginaActual == $totalPaginas ? 'active' : '') . '">' . $totalPaginas . '</a>';
    }
    
    // Botón siguiente
    if ($paginaActual < $totalPaginas) {
        $html .= '<a href="?pagina=' . ($paginaActual + 1) . ($busqueda ? '&busqueda=' . urlencode($busqueda) : '') . '" class="page-link">&raquo;</a>';
    }
    
    $html .= '</div>';
    return $html;
}
?>