<?php 
require_once("clase_conexion.php");
class Equipo
{
 private $conexion;
    
    function __construct() 
    {
        $this->conexion = Conexion::conectar();
    }

    function insertar($nombre,$estado,$fk_tanque)
    {
        $consulta="INSERT INTO equipo (pk_equipo,nombre,estado,fk_tanque,fecha) VALUES (NULL, '{$nombre}','{$estado}','{$fk_tanque}',NOW() )";
        $respuesta=$this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }

    function mostrar()
    {
        $consulta="SELECT * FROM equipo e inner join tanque t on e.fk_tanque=t.pk_tanque";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }
}

?>