<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

include_once('../Class/especie.php');
$especie = new Especie();

// Verificar que el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar datos recibidos
    if (
        !isset($_POST['pk_especie']) || empty($_POST['pk_especie']) ||
        !isset($_POST['nombre']) || empty($_POST['nombre']) ||
        !isset($_POST['descripcion']) || empty($_POST['descripcion']) ||
        !isset($_POST['fk_alimento']) || empty($_POST['fk_alimento']) ||
        !isset($_POST['habitad']) || empty($_POST['habitad']) ||
        !isset($_POST['temperatura']) || empty($_POST['temperatura']) ||
        !isset($_POST['cuidados']) || empty($_POST['cuidados']) ||
        !isset($_POST['fk_tipo_especie']) || empty($_POST['fk_tipo_especie'])
    ) {
        // Redirigir con mensaje de error
        header('Location: ../pages/lista_especies.php?error=1');
        exit();
    }

    // Preparar datos
    $pk_especie = $_POST['pk_especie'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fk_alimento = $_POST['fk_alimento'];
    $habitad = $_POST['habitad'];
    $temperatura = $_POST['temperatura'];
    $cuidados = $_POST['cuidados'];
    $fk_tipo_especie = $_POST['fk_tipo_especie'];

    // Manejar la imagen
    $img_especie = null;
    if (isset($_FILES['img_especie']) && $_FILES['img_especie']['error'] == 0) {
        $img_nombre = time() . '_' . basename($_FILES['img_especie']['name']);
        $img_ruta = '../Storage/' . $img_nombre;
        
        if (move_uploaded_file($_FILES['img_especie']['tmp_name'], $img_ruta)) {
            $img_especie = $img_nombre;
        } else {
            // Error al subir la imagen
            header('Location: ../views/lista_especies.php?error=2');
            exit();
        }
    }

    // Llamar al método de actualización
    $resultado = $especie->actualizar_especie(
        $pk_especie, 
        $nombre, 
        $descripcion, 
        $fk_alimento, 
        $habitad, 
        $temperatura, 
        $cuidados, 
        $img_especie, 
        $fk_tipo_especie
    );

    if ($resultado) {
        // Éxito
        header('Location: ../views/lista_especies.php?success=1');
    } else {
        // Error en la actualización
        header('Location: ../views/lista_especies.php?error=3');
    }
    exit();
} else {
    // Acceso no autorizado
    header('Location: ../views/lista_especies.php');
    exit();
}