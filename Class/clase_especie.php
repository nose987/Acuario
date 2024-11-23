<?php

require_once('clase_conexion.php');


class Especie{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar(); 
    }

    public function insertarEspecie() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener datos del formulario
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $alimentacion = $_POST["alimentacion"];
            $habitad = $_POST["habitad"];
            $temperatura = $_POST["temperatura"];
            $cuidados = $_POST["cuidados"];
            $tipo_especie = $_POST["fk_tipo_especie"];

            // Manejar la carga de imagen
            $img_especie = null;
            if(isset($_FILES['img_especie']) && $_FILES['img_especie']['error'] === 0) {
                $directorio_destino = "../uploads/especies/";
                
                // Crear el directorio si no existe
                if (!file_exists($directorio_destino)) {
                    mkdir($directorio_destino, 0777, true);
                }

                // Generar nombre único para la imagen
                $extension = pathinfo($_FILES['img_especie']['name'], PATHINFO_EXTENSION);
                $nombre_archivo = uniqid() . '.' . $extension;
                $ruta_completa = $directorio_destino . $nombre_archivo;

                // Mover el archivo
                if(move_uploaded_file($_FILES['img_especie']['tmp_name'], $ruta_completa)) {
                    $img_especie = $ruta_completa;
                }
            }

            // Preparar la consulta SQL
            $sql = "INSERT INTO especie (nombre, descripcion, habitad, temperatura, cuidados, img_especie, fk_tipo_especie) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Preparar la declaración
            $stmt = $this->conexion->prepare($sql);
            
            if ($stmt) {
                // Vincular parámetros
                $stmt->bind_param("ssssssi", 
                    $nombre,
                    $descripcion,
                    $habitad,
                    $temperatura,
                    $cuidados,
                    $img_especie,
                    $tipo_especie
                );

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    // Redirigir a una página de éxito
                    header("Location: ../Views/formulario_especies.php?mensaje=Especie registrada correctamente");
                    exit();
                } else {
                    // Redirigir con mensaje de error
                    header("Location: ../Views/formulario_especies.php?error=Error al registrar la especie");
                    exit();
                }
            } else {
                // Error en la preparación de la consulta
                header("Location: ../Views/formulario_especies.php?error=Error en la base de datos");
                exit();
            }
        }
    }

}




?>