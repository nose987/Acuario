<?php
include_once("clase_conexion.php");

class Inventario
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function categoria()
    {
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
            $fecha = date('Y-m-d H:i:s');

            $sql = "INSERT INTO inventario (codigo, nombre, stock, descripcion, fecha, fk_categoria, estatus ) VALUES (?, ?, ?, ?, ?, ?, 1)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssisdi", $codigo, $nombre, $stock, $descripcion, $fecha, $categoria);
            $stmt->execute();
            header("location:../views/registro_inventario.php");
            $stmt->close();
            exit();
        }
    }

    public function mostrar()
    {
        $sql = "SELECT i.codigo, i.nombre, c.nombre as categoria, i.stock, i.descripcion FROM inventario i INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria ";
        $result = $this->conexion->query($sql);
        return $result;
    }

    public function buscar($busqueda) {
        $sql = "SELECT i.codigo, i.nombre, c.nombre AS categoria, i.stock, i.descripcion 
                FROM inventario i 
                INNER JOIN categoria c ON i.fk_categoria = c.pk_categoria 
                WHERE i.codigo LIKE ? OR i.nombre LIKE ? OR c.nombre LIKE ?";
    
        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("sss", $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }
    
}

$inventario = new Inventario();
$inventario->insertar();
