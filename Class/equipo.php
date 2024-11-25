<?php
require_once("clase_conexion.php");
class Equipo
{
    private $conexion;

    function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    function insertar($nombre, $estado, $fk_tanque)
    {
        $consulta = "INSERT INTO equipo (pk_equipo,nombre,estado,fk_tanque,fecha) VALUES (NULL, '{$nombre}','{$estado}','{$fk_tanque}',NOW() )";
        $respuesta = $this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }

    function mostraar(){
        $consulta = "SELECT pk_equipo, nombre FROM equipo";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
    }

    function mostrar($offset, $limit)
    {
        $consulta = "SELECT * FROM equipo e INNER JOIN tanque t ON e.fk_tanque = t.pk_tanque LIMIT {$offset}, {$limit}";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
    }
    function contarTotal()
    {
        $consulta = "SELECT COUNT(*) AS total FROM equipo";
        $respuesta = $this->conexion->query($consulta);
        if ($respuesta) {
            $fila = $respuesta->fetch_assoc();
            return $fila['total'];
        } else {
            return 0;
        }
    }


    public function buscarEquipo($busqueda)
    {
        $sql = "SELECT nombre, estado, fk_tanque, fecha 
                FROM equipo 
                WHERE nombre LIKE ? 
                OR estado LIKE ? 
                OR fk_tanque LIKE ?";

        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("sss", $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }
}
