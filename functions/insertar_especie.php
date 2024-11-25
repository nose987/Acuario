<?php
include("../Class/especie.php");
$especie = new Especie();

// Obtener datos del formulario
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$habitad = $_POST["habitad"];
$temperatura = $_POST["temperatura"];
$cuidados = $_POST["cuidados"];
$fk_tipo_especie = $_POST["fk_tipo_especie"];
$fk_alimento = $_POST["fk_alimento"];

// Manejo del archivo
$archivoTmp = $_FILES["img_especie"]["tmp_name"];
$foto = $_FILES["img_especie"]["name"];

// Definir la ruta de almacenamiento
$directorioDestino = "../Storage/";
$nuevoNombreArchivo = time() . "_" . $foto; // Para evitar nombres duplicados

if (move_uploaded_file($archivoTmp, $directorioDestino . $nuevoNombreArchivo)) {
    // Subida exitosa, asignar el nombre del archivo
    $img_especie = $nuevoNombreArchivo;
} else {
    // Manejar el error al subir el archivo
    echo "<script>
        alert('Error al subir la imagen.');
        window.location.href = 'index.php';
    </script>";
    exit();
}

// Insertar en la base de datos
$respuesta = $especie->insertar($nombre, $descripcion, $habitad, $temperatura, $cuidados, $img_especie, $fk_tipo_especie, $fk_alimento);

// Redirigir según el resultado
if ($respuesta) {
    header("Location: ../views/lista_especies.php");
    exit;
} else {
    echo "<script>
        alert('Error al guardar la especie.');
        window.location.href = 'index.php';
    </script>";
}
?>
