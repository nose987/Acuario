<?php
include_once '../Class/clase_conexion.php'; 

class Equipo {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function mostrar($offset, $limit) {
        $sql = "SELECT * FROM equipo LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function contarTotal() {
        $sql = "SELECT COUNT(*) AS total FROM equipo";
        $resultado = $this->conn->query($sql);
        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            return $fila['total'];
        } else {
            return 0;
        }
    }
    
}
?>
