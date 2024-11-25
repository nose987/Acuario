<?php
include_once '../Class/clase_conexion.php'; 

class Mantenimiento {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function mostrar_mante() {
        $sql = "SELECT *, e.nombre FROM mantenimiento_equipo m INNER JOIN equipo e ON m.fk_equipo = e.pk_equipo"; 
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; 
        }
    }

    public function contarTotalMantenimiento($busqueda = null) {
        if ($busqueda) {
            $sql = "SELECT COUNT(*) as total FROM mantenimiento_equipo 
                    WHERE fk_equipo LIKE ? 
                    OR fecha LIKE ? 
                    OR tipo_mante LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $param = '%' . $busqueda . '%';
            $stmt->bind_param("sss", $param, $param, $param);
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_assoc();
            return $resultado['total'];
        } else {
            $sql = "SELECT COUNT(*) as total FROM mantenimiento_equipo";
            $resultado = $this->conn->query($sql);
            return $resultado->fetch_assoc()['total'];
        }
    }

    // Método para mostrar los registros con paginación
    public function mostrarMantePaginado($inicio, $registrosPorPagina, $busqueda = null) {
        if ($busqueda) {
            $sql = "SELECT *, e.nombre FROM mantenimiento_equipo m 
                    INNER JOIN equipo e ON m.fk_equipo = e.pk_equipo
                    WHERE m.fk_equipo LIKE ? 
                    OR m.fecha LIKE ? 
                    OR m.tipo_mante LIKE ? 
                    LIMIT ?, ?";
            $stmt = $this->conn->prepare($sql);
            $param = '%' . $busqueda . '%';
            $stmt->bind_param("ssiii", $param, $param, $param, $inicio, $registrosPorPagina);
            $stmt->execute();
            return $stmt->get_result();
        } else {
            $sql = "SELECT *, e.nombre FROM mantenimiento_equipo m 
                    INNER JOIN equipo e ON m.fk_equipo = e.pk_equipo
                    LIMIT ?, ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $inicio, $registrosPorPagina);
            $stmt->execute();
            return $stmt->get_result();
        }
    }


}
?>
