<?php
require_once '../Class/conexion.php';

class Tanque
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->conn;
    }
    public function obtener_tanques()
    {
        $sql = "SELECT 
            t.pk_tanque, 
            t.capacidad, 
            t.temperatura, 
            t.iluminacion, 
            t.filtracion, 
            a.nombre as nombre_area, 
            e.nombre as nombre_especie, 
            t.fecha 
        FROM tanque t
        INNER JOIN area a ON a.pk_area = t.fk_area 
        INNER JOIN especie e ON t.fk_especie = e.pk_especie";
        $resultado = $this->conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; // Devuelve un array vacío si no hay resultados o si la consulta falla
        }
    }
}
