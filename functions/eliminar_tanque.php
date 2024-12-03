<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

require_once '../functions/tanque.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $tanque = new Tanque();
    $id = $_GET['id'];

    $resultado = $tanque->eliminar_tanque($id);

    if ($resultado) {
        header("Location: ../views/tabla_tanques.php?mensaje=Tanque eliminado exitosamente");
    } else {
        header("Location: tabla_tanques.php?error=No se pudo eliminar el tanque");
    }
    exit();
} else {
    header("Location: tabla_tanques.php");
    exit();
}