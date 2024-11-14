<?php
include '../Class/conexion.php';

class Alimentacion {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conn;
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
}
?>