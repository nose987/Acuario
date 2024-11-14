<?php
require_once "../Class/clase_conexion.php";
class mostrarEmpleados{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function mostrar(){
        $sql = "SELECT CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) as nombrecompleto, p.correo, p.fecha_nac, p.telefono, p.genero, p.direccion, r.roles as rol, a.nombre as area FROM roles r INNER JOIN persona p ON r.pk_roles=p.fk_roles INNER JOIN area a on p.fk_area=a.pk_area";

        $result = $this->conexion->query($sql);
        return $result;
    }
}
?>