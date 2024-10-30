<?php
include_once("clase_conexion.php");

class Inventario
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function categoria(){
        $sql = "SELECT pk_categoria, nombre FROM categoria";
        $result = $this->conexion->query($sql);
        return $result;
    }


    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $stock = $_POST['stock'];
            $descripcion = $_POST['descripcion'];

            $sql = "INSERT INTO inventario (codigo, nombre, stock, descripcion, estutus, alarma, fk_categoria) VALUES (?, ?, ?, ?, 1, 0, ?)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssisi", $codigo, $nombre, $stock, $descripcion, $categoria);
            $stmt->execute();
            header("location:../views/registro_inventario.php");
            $stmt->close();
            exit();

        }
        
    }

    public function mostrar(){
        $sql = "SELECT codigo, nombre,stock, descripcion, fk_categoria as categoria FROM inventario";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function actualizar_stock($codigo, $nuevoStock) {
        if(empty($codigo) || !is_numeric($nuevoStock)) {
            return false;
        }
        
        $sql = "UPDATE inventario SET stock = ? WHERE codigo = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("is", $nuevoStock, $codigo);
        $result = $stmt->execute();
        $stmt->close();
        exit();
        return $result;
    }
    
    

    
}

$inventario = new Inventario();
$inventario->insertar();

