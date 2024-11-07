<?php
include_once("clase_conexion.php");

class SaludEspecies
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    // Método para obtener todas las especies
    public function obtenerEspecies()
    {
        $sql = "SELECT pk_especie, nombre FROM especie";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Método para obtener personal autorizado (cuidadores y veterinarios)
    public function obtenerPersonal()
    {
        $sql = "SELECT pk_persona, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombre_completo 
                FROM persona 
                WHERE fk_roles IN (1, 2)"; // 1=veterinario, 2=cuidador
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Método para insertar registro de salud
    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fk_especie = $_POST['fk_especie'];
            $fecha_revision = $_POST['fecha_revision'];
            $peso = $_POST['peso'] ? $_POST['peso'] : NULL;
            $longitud = $_POST['longitud'] ? $_POST['longitud'] : NULL;
            $temperatura = $_POST['temperatura'] ? $_POST['temperatura'] : NULL;
            $estado_general = $_POST['estado_general'];
            $comportamiento = $_POST['comportamiento'] ? $_POST['comportamiento'] : NULL;
            $sintomas = $_POST['sintomas'] ? $_POST['sintomas'] : NULL;
            $observaciones = $_POST['observaciones'] ? $_POST['observaciones'] : NULL;
            $fk_persona = $_POST['fk_persona'];

            $sql = "INSERT INTO salud_especie (
                    fk_especie, 
                    fecha_revision,
                    peso,
                    longitud,
                    temperatura,
                    estado_general,
                    comportamiento,
                    sintomas,
                    observaciones,
                    fk_persona
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param(
                "isdddssssi",
                $fk_especie,
                $fecha_revision,
                $peso,
                $longitud,
                $temperatura,
                $estado_general,
                $comportamiento,
                $sintomas,
                $observaciones,
                $fk_persona
            );

            $stmt->execute();
            header("location:../views/registro_salud_especies.php");
            $stmt->close();
            exit();
        }
    }

    // Método para mostrar registros de salud
    public function mostrar()
    {
        $sql = "SELECT se.fecha_revision, 
                       e.nombre as especie,
                       se.peso,
                       se.longitud,
                       se.temperatura,
                       se.estado_general,
                       se.comportamiento,
                       se.sintomas,
                       se.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as encargado
                FROM salud_especie se
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON se.fk_persona = p.pk_persona";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Método para buscar registros
    public function buscar($busqueda) {
        $sql = "SELECT se.fecha_revision, 
                       e.nombre as especie,
                       se.peso,
                       se.longitud,
                       se.temperatura,
                       se.estado_general,
                       se.comportamiento,
                       se.sintomas,
                       se.observaciones,
                       CONCAT(p.nombre, ' ', p.apaterno) as encargado
                FROM salud_especie se
                INNER JOIN especie e ON se.fk_especie = e.pk_especie
                INNER JOIN persona p ON se.fk_persona = p.pk_persona
                WHERE e.nombre LIKE ? OR 
                      se.estado_general LIKE ? OR 
                      CONCAT(p.nombre, ' ', p.apaterno) LIKE ?";
    
        $stmt = $this->conexion->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bind_param("sss", $param, $param, $param);
        $stmt->execute();
        return $stmt->get_result();
    }
}

$saludEspecies = new SaludEspecies();
$saludEspecies->insertar();