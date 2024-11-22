<?php
include_once '../Class/conexion.php'; 

class Mantenimiento {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conn;
    }

    public function mostrar_mante() {
        $sql = "SELECT * FROM mantenimiento_equipo"; 
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; 
        }
    }
}
?>
