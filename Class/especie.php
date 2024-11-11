<?php 
class Especie 
{

    
    function __construct() 
    {
        require_once("../acuario/clases/conexion.php");
        $this->conexion=new Conexion();
    }

    function insertar($nombre,$descripcion,$habitad,$temperatura,$cuidados,$img_especie,$fk_tipo_especie,$fk_alimento)
    {
        $consulta="INSERT INTO especie (pk_especie,nombre,descripcion,habitad,temperatura,cuidados,img_especie,fk_tipo_especie,fk_alimento) VALUES (NULL, '{$nombre}','{$descripcion}','{$habitad}','{$temperatura}','{$cuidados}','{$img_especie}','{$fk_tipo_especie}','{$fk_alimento}')";
        $respuesta=$this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }

    function mostrar()
    {
        $consulta="SELECT * FROM especie e inner join tipo_especie te on e.fk_tipo_especie=te.pk_tipo_especie";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }

    function actualizar($nombre,$descripcion,$alimentacion,$habitad,$temperatura,$cuidados,$img_especie,$fk_tipo_especie)
    {
        $consulta="UPDATE especie SET nombre='{$nombre}',descripcion='{$descripcion}',habitad='{$habitad}',temperatura='{$temperatura}',cuidados='{$cuidados}',img_especie='{$img_especie}',fk_tipo_especie='{$fk_tipo_especie}',fk_alimento='{$fk_alimento}'";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta;
    }

    function buscarporid($pk_especie)
    {
        $consulta="SELECT * FROM especie WHERE pk_especie='{$pk_especie}'";
        $respuesta=$this->conexion->query($consulta);
        return $respuesta; 
    }
}

?>