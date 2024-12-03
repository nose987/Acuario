<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

include_once('../Class/especie.php');
$especie = new Especie();

// Verificar que se recibió un ID válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ../views/lista_especies.php?error=1');
    exit();
}

$id = $_GET['id'];

// Intentar eliminar la especie
$resultado = $especie->eliminar_especie($id);

if ($resultado) {
    // Éxito
    header('Location: ../views/lista_especies.php?success=1');
} else {
    // Error en la eliminación
    header('Location: ../views/lista_especies.php?error=2');
}
exit();