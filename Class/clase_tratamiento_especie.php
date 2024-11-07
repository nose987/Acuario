<?php
include_once("clase_conexion.php");

class Tratamientos
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    // Obtener diagnósticos para el select
    public function obtenerDiagnosticos()
    {
        $sql = "SELECT d.pk_diagnostico, 
                       e.nombre as especie,
                       d.fecha_diagnostico,
                       d.gravedad
                FROM diagnostico d
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                ORDER BY d.fecha_diagnostico DESC";
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

    // Insertar tratamiento
    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fk_diagnostico = $_POST['fk_diagnostico'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $instrucciones = !empty($_POST['instrucciones']) ? $_POST['instrucciones'] : null;
            $observaciones = !empty($_POST['observaciones']) ? $_POST['observaciones'] : null;
            $fk_persona = $_POST['fk_persona'];

            $sql = "INSERT INTO tratamiento (
                    fk_diagnostico,
                    fecha_inicio,
                    fecha_fin,
                    descripcion,
                    estado,
                    instrucciones,
                    observaciones,
                    fk_persona
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param(
                "issssssi",
                $fk_diagnostico,
                $fecha_inicio,
                $fecha_fin,
                $descripcion,
                $estado,
                $instrucciones,
                $observaciones,
                $fk_persona
            );

            $stmt->execute();
            header("location:../views/registro_tratamiento_especies.php");
            $stmt->close();
            exit();
        }
    }

    // Mostrar tratamientos
    public function mostrar()
    {
        $sql = "SELECT t.fecha_inicio,
                       t.fecha_fin,
                       e.nombre as especie,
                       t.estado,
                       t.descripcion,
                       t.instrucciones,
                       t.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario
                FROM tratamiento t
                INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON t.fk_persona = p.pk_persona
                ORDER BY t.fecha_inicio DESC";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Buscar tratamientos
    public function buscar($busqueda) {
        $sql = "SELECT t.fecha_inicio,
                       t.fecha_fin,
                       e.nombre as especie,
                       t.estado,
                       t.descripcion,
                       t.instrucciones,
                       t.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as veterinario
                FROM tratamiento t
                INNER JOIN diagnostico d ON t.fk_diagnostico = d.pk_diagnostico
                INNER JOIN salud_especie se ON d.fk_salud_especie = se.pk_salud_especie
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON t.fk_persona = p.pk_persona
                WHERE e.nombre LIKE ? OR 
                      t.estado LIKE ? OR 
                      t.descripcion LIKE ? OR
                      CONCAT(p.nombre, ' ', p.apaterno) LIKE ?";
    
        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("ssss", $param, $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }
}

$tratamientos = new Tratamientos();
$tratamientos->insertar();