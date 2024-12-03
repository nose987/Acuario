<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

require_once '../Class/clases.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $equipo = new OpcionesFormulario();
    
    if ($equipo->eliminar($id)) {
        // Redirect with success message
        header('Location: ../views/tabla_equipo.php?mensaje=Equipo eliminado exitosamente');
        exit();
    } else {
        // Redirect with error message
        header('Location: ../views/tabla_equipo.php?error=No se pudo eliminar el equipo');
        exit();
    }
} else {
    // Redirect if no ID provided
    header('Location: ../views/tabla_equipo.php');
    exit();
}