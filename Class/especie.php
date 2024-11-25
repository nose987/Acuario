<?php 
class Especie 
{
    private $conexion;
    
    function __construct() 
    {
        require_once("clase_conexion.php");
        $this->conexion = Conexion::conectar();
    }

    function insertar($nombre,$descripcion,$habitad,$temperatura,$cuidados,$img_especie,$fk_tipo_especie,$fk_alimento)
    {
        $consulta="INSERT INTO especie (pk_especie,nombre,descripcion,habitad,temperatura,cuidados,img_especie,fk_tipo_especie,fk_alimento) VALUES (NULL, '{$nombre}','{$descripcion}','{$habitad}','{$temperatura}','{$cuidados}','{$img_especie}','{$fk_tipo_especie}','{$fk_alimento}')";
        $respuesta=$this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }

    function mostrar()
    {
        $consulta="SELECT *, i.nombre as alimento FROM inventario i INNER JOIN especie e ON i.pk_inventario=e.fk_alimento
         inner join tipo_especie te on e.fk_tipo_especie=te.pk_tipo_especie";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }

    function mostrarAlimentacion(){
        $consulta = "SELECT pk_inventario, nombre FROM inventario WHERE fk_categoria = 1";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
    }

    function actualizar($nombre,$descripcion,$alimentacion,$habitad,$temperatura,$cuidados,$img_especie,$fk_tipo_especie)
    {
        $consulta="UPDATE especie SET nombre='{$nombre}',descripcion='{$descripcion}',habitad='{$habitad}',temperatura='{$temperatura}',cuidados='{$cuidados}',img_especie='{$img_especie}',fk_tipo_especie='{$fk_tipo_especie}',fk_alimento='{$fk_alimento}'";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }

    function buscarporid($pk_especie)
    {
        $consulta="SELECT * FROM especie WHERE pk_especie='{$pk_especie}'";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta; 
    }

    function obtener_especies_paginado($pagina = 1, $porPagina = 30) 
    {
        // Calcular el offset
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de registros
        $sqlTotal = "SELECT COUNT(*) as total FROM especie";
        $resultTotal = $this->conexion->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];

        // Consulta paginada con JOIN a inventario
        $consulta = "SELECT e.*, te.tipo, i.nombre as alimento 
                    FROM especie e 
                    INNER JOIN tipo_especie te ON e.fk_tipo_especie = te.pk_tipo_especie 
                    LEFT JOIN inventario i ON e.fk_alimento = i.pk_inventario
                    LIMIT {$porPagina} OFFSET {$offset}";
        
        $respuesta = $this->conexion->query($consulta);
        
        return [
            'datos' => $respuesta,
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }

    function buscar_especies($busqueda, $pagina = 1, $porPagina = 30) 
    {
        $offset = ($pagina - 1) * $porPagina;
        
        // Obtener total de resultados de búsqueda
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM especie e 
                     INNER JOIN tipo_especie te ON e.fk_tipo_especie = te.pk_tipo_especie
                     LEFT JOIN inventario i ON e.fk_alimento = i.pk_inventario
                     WHERE e.nombre LIKE '%{$busqueda}%' 
                     OR e.descripcion LIKE '%{$busqueda}%' 
                     OR e.habitad LIKE '%{$busqueda}%'
                     OR te.tipo LIKE '%{$busqueda}%'
                     OR i.nombre LIKE '%{$busqueda}%'";
        
        $resultTotal = $this->conexion->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];

        // Consulta paginada con búsqueda
        $consulta = "SELECT e.*, te.tipo, i.nombre as alimento 
                    FROM especie e 
                    INNER JOIN tipo_especie te ON e.fk_tipo_especie = te.pk_tipo_especie
                    LEFT JOIN inventario i ON e.fk_alimento = i.pk_inventario
                    WHERE e.nombre LIKE '%{$busqueda}%' 
                    OR e.descripcion LIKE '%{$busqueda}%' 
                    OR e.habitad LIKE '%{$busqueda}%'
                    OR te.tipo LIKE '%{$busqueda}%'
                    OR i.nombre LIKE '%{$busqueda}%'
                    LIMIT {$porPagina} OFFSET {$offset}";

        $respuesta = $this->conexion->query($consulta);
        
        return [
            'datos' => $respuesta,
            'total' => $total,
            'totalPaginas' => ceil($total / $porPagina),
            'paginaActual' => $pagina
        ];
    }
}

// Función para generar los enlaces de paginación
function generarPaginacionEspecies($totalPaginas, $paginaActual, $busqueda = '') {
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