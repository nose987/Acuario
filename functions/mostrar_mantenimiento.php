<?php
include_once '../Class/clase_conexion.php'; 

class Mantenimiento {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
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
