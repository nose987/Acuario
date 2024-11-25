<?php
require_once("clase_conexion.php");
class Mantenimiento
{

    private $conexion;
    function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    function insertar($fk_equipo, $tipo_mante, $descripcion)
    {
        $consulta = "INSERT INTO mantenimiento_equipo (pk_mantenimiento_equipo, tipo_mante, descripcion, fk_equipo, fecha) VALUES (NULL, '{$tipo_mante}','{$descripcion}','{$fk_equipo}',now())";
        $respuesta = $this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }

    function mostrar_mante()
    {
        $consulta = "SELECT * FROM mantenimiento_equipo m inner join equipo e on m.fk_equipo=e.pk_equipo";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
    }

    public function buscarMantenimiento($busqueda)
    {
        $sql = "SELECT fk_equipo, fecha, tipo_mante, descripcion 
                FROM mantenimiento_equipo 
                
                WHERE fk_equipo LIKE ? 
                OR fecha LIKE ? 
                OR tipo_mante LIKE ?";

        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("sss", $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }


    public function contarTotalMantenimiento($busqueda = null)
    {
        if ($busqueda) {
            $sql = "SELECT COUNT(*) as total FROM mantenimiento_equipo 
                    WHERE fk_equipo LIKE ? 
                    OR fecha LIKE ? 
                    OR tipo_mante LIKE ?";
            $stmt = $this->conexion->prepare($sql);
            $param = '%' . $busqueda . '%';
            $stmt->bind_param("sss", $param, $param, $param);
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_assoc();
            return $resultado['total'];
        } else {
            $sql = "SELECT COUNT(*) as total FROM mantenimiento_equipo";
            $respuesta = $this->conexion->query($sql);
            return $respuesta->fetch_assoc()['total'];
        }
    }

    public function mostrarMantePaginado($inicio, $registrosPorPagina, $busqueda = null) {
        if ($busqueda) {
            $sql = "SELECT * FROM mantenimiento_equipo m 
                    INNER JOIN equipo e ON m.fk_equipo = e.pk_equipo
                    WHERE m.fk_equipo LIKE ? 
                    OR m.fecha LIKE ? 
                    OR m.tipo_mante LIKE ? 
                    LIMIT ?, ?";
            $stmt = $this->conexion->prepare($sql);
            $param = '%' . $busqueda . '%';
            $stmt->bind_param("ssiii", $param, $param, $param, $inicio, $registrosPorPagina);
            $stmt->execute();
            return $stmt->get_result();
        } else {
            $sql = "SELECT * FROM mantenimiento_equipo m 
                    INNER JOIN equipo e ON m.fk_equipo = e.pk_equipo
                    LIMIT ?, ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ii", $inicio, $registrosPorPagina);
            $stmt->execute();
            return $stmt->get_result();
        }
    }
    
}
