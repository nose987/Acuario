<?php
include_once("clase_conexion.php");

class Tratamientos
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    // Obtener diagnósticos para el select
    public function obtenerDiagnosticos()
    {
        $sql = "SELECT d.pk_diagnostico, 
                       e.nombre as especie,
                       d.fecha_diagnostico,
                       d.gravedad
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                ORDER BY d.fecha_diagnostico DESC";
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

    // Insertar tratamiento
    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fk_diagnostico = $_POST['fk_diagnostico'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $instrucciones = !empty($_POST['instrucciones']) ? $_POST['instrucciones'] : null;
            $observaciones = !empty($_POST['observaciones']) ? $_POST['observaciones'] : null;
            $fk_persona = $_POST['fk_persona'];

            $sql = "INSERT INTO tratamiento (
                    fk_diagnostico,
                    fecha_inicio,
                    fecha_fin,
                    descripcion,
                    estado,
                    instrucciones,
                    observaciones,
                    fk_persona
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param(
                "issssssi",
                $fk_diagnostico,
                $fecha_inicio,
                $fecha_fin,
                $descripcion,
                $estado,
                $instrucciones,
                $observaciones,
                $fk_persona
            );

            $stmt->execute();
            header("location:../views/registro_tratamiento_especies.php");
            $stmt->close();
            exit();
        }
    }

    public function buscarTratamiento($busqueda) {
        $sql = "SELECT t.fecha_inicio, t.fecha_fin, e.nombre as especie, 
                       t.estado, t.descripcion, t.instrucciones, 
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario, 
                       t.observaciones
                FROM tratamiento t
                INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                INNER JOIN salud_especie s ON d.fk_salud_especie = s.pk_salud_especie
                INNER JOIN especie e ON s.fk_especie = e.pk_especie
                INNER JOIN persona p ON t.fk_persona = p.pk_persona
                WHERE DATE_FORMAT(t.fecha_inicio, '%d/%m/%Y') LIKE ? 
                OR DATE_FORMAT(t.fecha_fin, '%d/%m/%Y') LIKE ?
                OR e.nombre LIKE ?
                OR t.estado LIKE ?
                OR CONCAT(p.nombre, ' ', p.apaterno) LIKE ?";
    
        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("sssss", $param, $param, $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Mostrar tratamientos
    public function mostrar()
    {
        $sql = "SELECT t.fecha_inicio,
                       t.fecha_fin,
                       e.nombre as especie,
                       t.estado,
                       t.descripcion,
                       t.instrucciones,
                       t.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario
                FROM tratamiento t
                INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON t.fk_persona = p.pk_persona
                ORDER BY t.fecha_inicio DESC";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Buscar tratamientos
    public function buscar($busqueda)
    {
        $sql = "SELECT t.fecha_inicio,
                       t.fecha_fin,
                       e.nombre as especie,
                       t.estado,
                       t.descripcion,
                       t.instrucciones,
                       t.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario
                FROM tratamiento t
                INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON t.fk_persona = p.pk_persona
                WHERE e.nombre LIKE ? OR 
                      t.estado LIKE ? OR 
                      t.descripcion LIKE ? OR
                      CONCAT(p.nombre, ' ', p.apaterno) LIKE ?";

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
                     FROM tratamiento t
                     INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                     INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                     INNER JOIN especie e ON se.fk_especie = e.pk_especie
                     INNER JOIN persona p ON t.fk_persona = p.pk_persona";
        $resultTotal = $this->conexion->query($sqlTotal);
        $total = $resultTotal->fetch_assoc()['total'];

        // Obtener los registros de la página actual
        $sql = "SELECT t.fecha_inicio,
                       t.fecha_fin,
                       e.nombre as especie,
                       t.estado,
                       t.descripcion,
                       t.instrucciones,
                       t.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario
                FROM tratamiento t
                INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON t.fk_persona = p.pk_persona
                ORDER BY t.fecha_inicio DESC
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

    public function buscarPaginado($busqueda, $pagina = 1, $porPagina = 30)
    {
        $offset = ($pagina - 1) * $porPagina;

        // Obtener total de resultados de búsqueda
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM tratamiento t
                     INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                     INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                     INNER JOIN especie e ON se.fk_especie = e.pk_especie
                     INNER JOIN persona p ON t.fk_persona = p.pk_persona
                     WHERE e.nombre LIKE ? OR 
                           t.estado LIKE ? OR 
                           t.descripcion LIKE ? OR
                           CONCAT(p.nombre, ' ', p.apaterno) LIKE ?";

        $stmtTotal = $this->conexion->prepare($sqlTotal);
        $param = '%' . $busqueda . '%';
        $stmtTotal->bind_param("ssss", $param, $param, $param, $param);
        $stmtTotal->execute();
        $total = $stmtTotal->get_result()->fetch_assoc()['total'];

        // Obtener resultados paginados
        $sql = "SELECT t.fecha_inicio,
                       t.fecha_fin,
                       e.nombre as especie,
                       t.estado,
                       t.descripcion,
                       t.instrucciones,
                       t.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario
                FROM tratamiento t
                INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON t.fk_persona = p.pk_persona
                WHERE e.nombre LIKE ? OR 
                      t.estado LIKE ? OR 
                      t.descripcion LIKE ? OR
                      CONCAT(p.nombre, ' ', p.apaterno) LIKE ?
                ORDER BY t.fecha_inicio DESC
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
    function generarPaginacionTratamientos($totalPaginas, $paginaActual, $busqueda = '')
{
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
}

// Función independiente para generar la paginación de tratamientos

$tratamientos = new Tratamientos();
$tratamientos->insertar();
