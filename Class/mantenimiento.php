<?php 
require_once("clase_conexion.php");
class Mantenimiento
{

    private $conexion;
    function __construct() 
    {
        $this->conexion = Conexion::conectar();
    }

    function insertar($fk_equipo,$tipo_mante,$descripcion)
    {
        $consulta="INSERT INTO mantenimiento_equipo (pk_mantenimiento_equipo, fk_equipo, fecha, tipo_mante, descripcion) VALUES (NULL, '{$fk_equipo}',NOW(),'{$tipo_mante}','{$descripcion}')";
        $respuesta=$this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }

    function mostrar_mante()
    {
        $consulta="SELECT * FROM mantenimiento_equipo m inner join equipo e on m.fk_equipo=e.pk_equipo";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }
}

?>