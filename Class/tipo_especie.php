<?php 
require_once("../acuario/clases/conexion.php");
class Tipo 
{
    function __construct() 
    {
        $this->conexion=new Conexion();
    }

    function insertar($tipo)
    {
        $consulta="INSERT INTO tipo_especie (pk_tipo_especie, tipo) VALUES (NULL, '{$tipo}')";
        $respuesta=$this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }

    function mostrar()
    {
        $consulta="SELECT * FROM tipo_especie";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }

    function actualizar($tipo)
    {
        $consulta="UPDATE tipo_especie SET tipo='{$tipo}'";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }

    function buscarporid($pk_tipo_especie)
    {
        $consulta="SELECT * FROM tipo_especie WHERE pk_tipo_especie='{$pk_tipo_especie}'";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta; 
    }
}

?>