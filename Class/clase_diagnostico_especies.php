<?php
include_once("clase_conexion.php");

class Diagnosticos
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    // Obtener registros de salud para el select
    public function obtenerRegistrosSalud()
    {
        $sql = "SELECT se.pk_salud_especie, 
                       e.nombre as especie,
                       se.fecha_revision,
                       se.estado_general 
                FROM salud_especie se 
                INNER JOIN especie e ON se.fk_especie = e.pk_especie 
                 WHERE se.estado_general = 'En tratamiento' OR se.estado_general = 'Crítico' OR 
                se.estado_general = 'En observación' ORDER BY se.fecha_revision DESC";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Obtener personal veterinario
    public function obtenerVeterinarios()
    {
        $sql = "SELECT pk_persona, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombre_completo 
                FROM persona 
                WHERE fk_roles = 1"; // 1 = veterinario
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Insertar diagnóstico
    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fk_salud_especie = $_POST['fk_salud_especie'];
            $fecha_diagnostico = date('Y-m-d H:i:s');
            $descripcion = $_POST['descripcion'];
            $gravedad = $_POST['gravedad'];
            $fk_persona = $_POST['fk_persona'];

            $sql = "INSERT INTO diagnostico (
                    fk_salud_especie,
                    fecha_diagnostico,
                    descripcion,
                    gravedad,
                    fk_persona
                ) VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param(
                "isssi",
                $fk_salud_especie,
                $fecha_diagnostico,
                $descripcion,
                $gravedad,
                $fk_persona
            );

            $stmt->execute();
            header("location:../views/registro_diagnostico_especies.php");
            $stmt->close();
            exit();
        }
    }

    // Mostrar diagnósticos
    public function mostrar()
    {
        $sql = "SELECT d.fecha_diagnostico,
                       e.nombre as especie,
                       se.fecha_revision,
                       d.descripcion,
                       d.gravedad,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario,
                       se.estado_general
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON d.fk_persona = p.pk_persona
                ORDER BY d.fecha_diagnostico DESC";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Buscar diagnósticos
    public function buscar($busqueda) {
        $sql = "SELECT d.fecha_diagnostico,
                       e.nombre as especie,
                       se.fecha_revision,
                       d.descripcion,
                       d.gravedad,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario,
                       se.estado_general
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON d.fk_persona = p.pk_persona
                WHERE e.nombre LIKE ? OR 
                      d.gravedad LIKE ? OR 
                      CONCAT(p.nombre, ' ', p.apaterno) LIKE ? OR
                      se.estado_general LIKE ?";
    
        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("ssss", $param, $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function mostrarPaginado($pagina = 1, $porPagina = 30)
    {
        // Calcular el offset
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener el total de registros
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM diagnostico d
                     INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                     INNER JOIN especie e ON se.fk_especie = e.pk_especie
                     INNER JOIN persona p ON d.fk_persona = p.pk_persona";
        $resultTotal = $this->conexion->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];
        
        // Obtener los registros de la página actual
        $sql = "SELECT d.fecha_diagnostico,
                       e.nombre as especie,
                       se.fecha_revision,
                       d.descripcion,
                       d.gravedad,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario,
                       se.estado_general
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON d.fk_persona = p.pk_persona
                ORDER BY d.fecha_diagnostico DESC
                LIMIT ? OFFSET ?";
                
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $porPagina, $offset);
        $stmt->execute();
        
        return [
            'datos' => $stmt->get_result(),
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }

    public function buscarPaginado($busqueda, $pagina = 1, $porPagina = 30)
    {
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de resultados de búsqueda
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM diagnostico d
                     INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                     INNER JOIN especie e ON se.fk_especie = e.pk_especie
                     INNER JOIN persona p ON d.fk_persona = p.pk_persona
                     WHERE e.nombre LIKE ? OR 
                           d.gravedad LIKE ? OR 
                           CONCAT(p.nombre, ' ', p.apaterno) LIKE ? OR
                           se.estado_general LIKE ?";
        
        $stmtTotal = $this->conexion->prepare($sqlTotal);
        $param = '%' . $busqueda . '%';
        $stmtTotal->bind_param("ssss", $param, $param, $param, $param);
        $stmtTotal->execute();
        $total = $stmtTotal->get_result()->fetch_assoc()['total'];
        
        // Obtener resultados paginados
        $sql = "SELECT d.fecha_diagnostico,
                       e.nombre as especie,
                       se.fecha_revision,
                       d.descripcion,
                       d.gravedad,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario,
                       se.estado_general
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON d.fk_persona = p.pk_persona
                WHERE e.nombre LIKE ? OR 
                      d.gravedad LIKE ? OR 
                      CONCAT(p.nombre, ' ', p.apaterno) LIKE ? OR
                      se.estado_general LIKE ?
                ORDER BY d.fecha_diagnostico DESC
                LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssssii", $param, $param, $param, $param, $porPagina, $offset);
        $stmt->execute();
        
        return [
            'datos' => $stmt->get_result(),
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }

    // Keep other existing methods...
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

$diagnosticos = new Diagnosticos();
$diagnosticos->insertar();