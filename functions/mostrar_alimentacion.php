<?php
include_once '../Class/clase_conexion.php';

class Alimentacion {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function obtener_alimentacion() {
        $sql = "SELECT a.pk_alimentacion, a.cantidad, a.descripcion, a.hora, a.fecha,
                       ar.nombre as nombre_area,
                       e.nombre as nombre_especie,
                       i.nombre as nombre_alimento
                FROM alimentacion a
                LEFT JOIN area ar ON a.fk_area = ar.pk_area
                LEFT JOIN especie e ON a.fk_especie = e.pk_especie
                LEFT JOIN inventario i ON a.fk_inventario = i.pk_inventario
                ORDER BY a.fecha DESC, a.hora DESC";
        
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; 
        }
    }

    public function buscar($busqueda) {
        $sql = "SELECT a.pk_alimentacion, a.cantidad, a.descripcion, a.hora, a.fecha,
                ar.nombre as nombre_area, e.nombre as nombre_especie, i.nombre as nombre_alimento
                FROM alimentacion a
                INNER JOIN area ar ON a.fk_area = ar.pk_area
                INNER JOIN especie e ON a.fk_especie = e.pk_especie
                INNER JOIN inventario i ON a.fk_inventario = i.pk_inventario
                WHERE a.fecha LIKE ? 
                OR a.hora LIKE ?
                OR ar.nombre LIKE ?
                OR e.nombre LIKE ?
                OR i.nombre LIKE ?";
                
        $stmt = $this->conn->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("sssss", $param, $param, $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function obtener_alimentacion_paginado($pagina = 1, $porPagina = 30) {
        // Calcular el offset
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de registros
        $sqlTotal = "SELECT COUNT(*) as total FROM alimentacion";
        $resultTotal = $this->conn->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];

        // Consulta paginada
        $sql = "SELECT a.pk_alimentacion, a.cantidad, a.descripcion, a.hora, a.fecha,
                       ar.nombre as nombre_area,
                       e.nombre as nombre_especie,
                       i.nombre as nombre_alimento
                FROM alimentacion a
                LEFT JOIN area ar ON a.fk_area = ar.pk_area
                LEFT JOIN especie e ON a.fk_especie = e.pk_especie
                LEFT JOIN inventario i ON a.fk_inventario = i.pk_inventario
                ORDER BY a.fecha DESC, a.hora DESC
                LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);
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
}

// Función para generar los enlaces de paginación
function generarPaginacionAlimentacion($totalPaginas, $paginaActual) {
    $html = '<div class="pagination">';
    
    // Botón anterior
    if ($paginaActual > 1) {
        $html .= '<a href="?pagina=' . ($paginaActual - 1) . '" class="page-link">&laquo;</a>';
    }
    
    // Primera página
    $html .= '<a href="?pagina=1" class="page-link ' . ($paginaActual == 1 ? 'active' : '') . '">1</a>';
    
    // Páginas intermedias
    $rango = 2;
    for ($i = max(2, $paginaActual - $rango); $i <= min($totalPaginas - 1, $paginaActual + $rango); $i++) {
        $html .= '<a href="?pagina=' . $i . '" class="page-link ' . ($paginaActual == $i ? 'active' : '') . '">' . $i . '</a>';
    }
    
    // Última página si no es la primera
    if ($totalPaginas > 1) {
        $html .= '<a href="?pagina=' . $totalPaginas . '" class="page-link ' . ($paginaActual == $totalPaginas ? 'active' : '') . '">' . $totalPaginas . '</a>';
    }
    
    // Botón siguiente
    if ($paginaActual < $totalPaginas) {
        $html .= '<a href="?pagina=' . ($paginaActual + 1) . '" class="page-link">&raquo;</a>';
    }
    
    $html .= '</div>';
    return $html;
}
?>