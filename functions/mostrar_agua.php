<?php
include '../Class/conexion.php'; 

class Agua {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conn;
    }

    public function obtener_calidad_agua() {
        $sql = "SELECT * FROM agua"; 
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; 
        }
    }
}
?>
