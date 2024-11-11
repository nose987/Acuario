<?php
include_once("clase_conexion.php");

class DetalleTratamiento
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    // Obtener tratamientos activos para el select
    public function obtenerTratamientos()
    {
        $sql = "SELECT pk_tratamiento, descripcion 
                FROM tratamiento 
                WHERE estado = 'En curso'";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Obtener inventario de medicamentos
    public function obtenerInventario()
    {
        $sql = "SELECT pk_inventario, nombre 
                FROM inventario 
                WHERE fk_categoria = (SELECT pk_categoria FROM categoria WHERE fk_categoria = '3')";
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Obtener personal de aplicación (cuidador o veterinario)
    public function obtenerPersonal()
    {
        $sql = "SELECT pk_persona, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombre_completo 
                FROM persona 
                WHERE fk_roles IN (1, 2)"; // 1 = veterinario, 2 = cuidador
        $result = $this->conexion->query($sql);
        return $result;
    }

    // Insertar detalle de tratamiento
    public function insertar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fk_tratamiento = $_POST['fk_tratamiento'];
            $fk_inventario = $_POST['fk_inventario'];
            $dosis = $_POST['dosis'];
            $frecuencia = $_POST['frecuencia'];
            $fecha_aplicacion = date('Y-m-d H:i:s');
            $notas = $_POST['notas'];
            $fk_persona = $_POST['fk_persona'];

            $sql = "INSERT INTO detalle_tratamiento (
                        fk_tratamiento,
                        fk_inventario,
                        dosis,
                        frecuencia,
                        fecha_aplicacion,
                        notas,
                        fk_persona
                    ) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param(
                "iissssi",
                $fk_tratamiento,
                $fk_inventario,
                $dosis,
                $frecuencia,
                $fecha_aplicacion,
                $notas,
                $fk_persona
            );

            $stmt->execute();
            header("location:../views/registro_detalle_tratamiento.php");
            $stmt->close();
            exit();
        }
    }

    // Mostrar detalles de tratamiento
    public function mostrar()
    {
        $sql = "SELECT dt.fecha_aplicacion,
                       t.descripcion as tratamiento,
                       i.nombre as medicamento,
                       dt.dosis,
                       dt.frecuencia,
                       dt.notas,
                       CONCAT(p.nombre, ' ', p.apaterno) as responsable
                FROM detalle_tratamiento dt
                INNER JOIN tratamiento t ON dt.fk_tratamiento = t.pk_tratamiento
                INNER JOIN inventario i ON dt.fk_inventario = i.pk_inventario
                INNER JOIN persona p ON dt.fk_persona = p.pk_persona
                ORDER BY dt.fecha_aplicacion DESC";
        $result = $this->conexion->query($sql);
        return $result;
    }
}

$detalleTratamiento = new DetalleTratamiento();
$detalleTratamiento->insertar();
