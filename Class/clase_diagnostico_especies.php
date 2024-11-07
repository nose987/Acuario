<?php
include_once("clase_conexion.php");

class Diagnosticos
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    // Obtener registros de salud para el select
    public function obtenerRegistrosSalud()
    {
        $sql = "SELECT se.pk_salud_especie, 
                       e.nombre as especie,
                       se.fecha_revision,
                       se.estado_general 
                FROM salud_especie se 
                INNER JOIN especie e ON se.fk_especie = e.pk_especie 
                ORDER BY se.fecha_revision DESC";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Obtener personal veterinario
    public function obtenerVeterinarios()
    {
        $sql = "SELECT pk_persona, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombre_completo 
                FROM persona 
                WHERE fk_roles = 1"; // 1 = veterinario
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Insertar diagnóstico
    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fk_salud_especie = $_POST['fk_salud_especie'];
            $fecha_diagnostico = date('Y-m-d H:i:s');
            $descripcion = $_POST['descripcion'];
            $gravedad = $_POST['gravedad'];
            $fk_persona = $_POST['fk_persona'];

            $sql = "INSERT INTO diagnostico (
                    fk_salud_especie,
                    fecha_diagnostico,
                    descripcion,
                    gravedad,
                    fk_persona
                ) VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param(
                "isssi",
                $fk_salud_especie,
                $fecha_diagnostico,
                $descripcion,
                $gravedad,
                $fk_persona
            );

            $stmt->execute();
            header("location:../views/registro_diagnostico_especies.php");
            $stmt->close();
            exit();
        }
    }

    // Mostrar diagnósticos
    public function mostrar()
    {
        $sql = "SELECT d.fecha_diagnostico,
                       e.nombre as especie,
                       se.fecha_revision,
                       d.descripcion,
                       d.gravedad,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario,
                       se.estado_general
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON d.fk_persona = p.pk_persona
                ORDER BY d.fecha_diagnostico DESC";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Buscar diagnósticos
    public function buscar($busqueda) {
        $sql = "SELECT d.fecha_diagnostico,
                       e.nombre as especie,
                       se.fecha_revision,
                       d.descripcion,
                       d.gravedad,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario,
                       se.estado_general
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON d.fk_persona = p.pk_persona
                WHERE e.nombre LIKE ? OR 
                      d.gravedad LIKE ? OR 
                      CONCAT(p.nombre, ' ', p.apaterno) LIKE ? OR
                      se.estado_general LIKE ?";
    
        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("ssss", $param, $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }
}

$diagnosticos = new Diagnosticos();
$diagnosticos->insertar();