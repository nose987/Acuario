<?php
include_once("clase_conexion.php");

class Inventario
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function categoria()
    {
        $sql = "SELECT pk_categoria, nombre FROM categoria";
        $result = $this->conexion->query($sql);
        return $result;
    }


    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $stock = $_POST['stock'];
            $descripcion = $_POST['descripcion'];
            $fecha = date('Y-m-d H:i:s');

            $sql = "INSERT INTO inventario (codigo, nombre, stock, descripcion, fecha, fk_categoria, estatus ) VALUES (?, ?, ?, ?, ?, ?, 1)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssisdi", $codigo, $nombre, $stock, $descripcion, $fecha, $categoria);
            $stmt->execute();
            header("location:../views/inventario.php");
            $stmt->close();
            exit();
        }
    }

    public function mostrar()
    {
        $sql = "SELECT i.codigo, i.nombre, c.nombre as categoria, i.stock, i.descripcion FROM inventario i INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria ";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function buscar($busqueda) {
        $sql = "SELECT i.codigo, i.nombre, c.nombre AS categoria, i.stock, i.descripcion 
                FROM inventario i 
                INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria 
                WHERE i.codigo LIKE ? OR i.nombre LIKE ? OR c.nombre LIKE ?";
    
        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("sss", $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function mostrarPaginado($pagina = 1, $porPagina = 30) {
        // Calcular el offset
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener el total de registros
        $sqlTotal = "SELECT COUNT(*) as total FROM inventario i 
                     INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria";
        $resultTotal = $this->conexion->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];
        
        // Obtener los registros de la página actual
        $sql = "SELECT i.codigo, i.nombre, c.nombre as categoria, i.stock, i.descripcion 
                FROM inventario i 
                INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $porPagina, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return [
            'datos' => $result,
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }

    public function buscarPaginado($busqueda, $pagina = 1, $porPagina = 30) {
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de resultados de búsqueda
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM inventario i 
                     INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria 
                     WHERE i.codigo LIKE ? OR i.nombre LIKE ? OR c.nombre LIKE ?";
        
        $stmtTotal = $this->conexion->prepare($sqlTotal);
        $param = '%' . $busqueda . '%';
        $stmtTotal->bind_param("sss", $param, $param, $param);
        $stmtTotal->execute();
        $total = $stmtTotal->get_result()->fetch_assoc()['total'];
        
        // Obtener resultados paginados
        $sql = "SELECT i.codigo, i.nombre, c.nombre AS categoria, i.stock, i.descripcion 
                FROM inventario i 
                INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria 
                WHERE i.codigo LIKE ? OR i.nombre LIKE ? OR c.nombre LIKE ?
                LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssii", $param, $param, $param, $porPagina, $offset);
        $stmt->execute();
        
        return [
            'datos' => $stmt->get_result(),
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }
}

// Función para generar los enlaces de paginación
function generarPaginacion($totalPaginas, $paginaActual, $busqueda = '') {
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

$inventario = new Inventario();
$inventario->insertar();
