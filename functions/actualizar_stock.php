<?php
include("../Class/clase_conexion.php");
class ActualizarStock {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::conectar();
    }

    public function obtener_stock_actual($codigo) {
        $sql = "SELECT stock FROM inventario WHERE codigo = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        $stmt->close();
        return $fila['stock'];
    }

    public function actualizar_stock($codigo, $nuevoStock) {
        if(empty($codigo) || !is_numeric($nuevoStock)) {
            return false;
        }
        $stockActual = $this->obtener_stock_actual($codigo);
        $stockTotal = $stockActual + $nuevoStock;
        $sql = "UPDATE inventario SET stock = ? WHERE codigo = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("is", $stockTotal, $codigo);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
}

$inventario = new ActualizarStock();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nuevoStock = $_POST['nuevo_stock'];
    $codigo = $_POST['codigo'];
    
    $resultado = $inventario->actualizar_stock($codigo, $nuevoStock);
    
    if($resultado){
        echo "Stock actualizado correctamente";
    } else {
        echo "Error al actualizar el stock";
    }
}
?>