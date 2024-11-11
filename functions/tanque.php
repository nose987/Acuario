<?php
include '../Class/conexion.php';

class Tanque {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conn;
    }
    public function obtener_tanques() {
        $sql = "SELECT * FROM tanque";
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; // Devuelve un array vacío si no hay resultados o si la consulta falla
        }
    }
}
?>
