<?php
require_once '../Class/conexion.php';

class Tanque
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->conn;
    }
    public function obtener_tanques()
    {
        $sql = "SELECT 
            t.pk_tanque, 
            t.capacidad, 
            t.temperatura, 
            t.iluminacion, 
            t.filtracion, 
            a.nombre as nombre_area, 
            e.nombre as nombre_especie, 
            t.fecha 
        FROM tanque t
        INNER JOIN area a ON a.pk_area = t.fk_area 
        INNER JOIN especie e ON t.fk_especie = e.pk_especie";
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; // Devuelve un array vacío si no hay resultados o si la consulta falla
        }
    }

    public function obtener_tanques_paginado($pagina = 1, $porPagina = 30) {
        // Calcular el offset
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de registros
        $sqlTotal = "SELECT COUNT(*) as total FROM tanque";
        $resultTotal = $this->conn->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];

        // Consulta paginada
        $sql = "SELECT 
            t.pk_tanque, 
            t.capacidad, 
            t.temperatura, 
            t.iluminacion, 
            t.filtracion, 
            a.nombre as nombre_area, 
            e.nombre as nombre_especie, 
            t.fecha 
        FROM tanque t
        INNER JOIN area a ON a.pk_area = t.fk_area 
        INNER JOIN especie e ON t.fk_especie = e.pk_especie
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

    public function buscar_tanques($busqueda, $pagina = 1, $porPagina = 30) {
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de resultados de búsqueda
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM tanque t
                     INNER JOIN area a ON a.pk_area = t.fk_area 
                     INNER JOIN especie e ON t.fk_especie = e.pk_especie
                     WHERE t.pk_tanque LIKE ? 
                     OR t.capacidad LIKE ? 
                     OR t.temperatura LIKE ?
                     OR a.nombre LIKE ?
                     OR e.nombre LIKE ?";
        
        $stmtTotal = $this->conn->prepare($sqlTotal);
        $param = '%' . $busqueda . '%';
        $stmtTotal->bind_param("sssss", $param, $param, $param, $param, $param);
        $stmtTotal->execute();
        $total = $stmtTotal->get_result()->fetch_assoc()['total'];

        // Consulta paginada con búsqueda
        $sql = "SELECT 
            t.pk_tanque, 
            t.capacidad, 
            t.temperatura, 
            t.iluminacion, 
            t.filtracion, 
            a.nombre as nombre_area, 
            e.nombre as nombre_especie, 
            t.fecha 
        FROM tanque t
        INNER JOIN area a ON a.pk_area = t.fk_area 
        INNER JOIN especie e ON t.fk_especie = e.pk_especie
        WHERE t.pk_tanque LIKE ? 
        OR t.capacidad LIKE ? 
        OR t.temperatura LIKE ?
        OR a.nombre LIKE ?
        OR e.nombre LIKE ?
        LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);
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
function generarPaginacionTanques($totalPaginas, $paginaActual, $busqueda = '') {
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
