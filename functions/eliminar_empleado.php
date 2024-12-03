<?php
require_once '../Class/clases.php'; // Ruta ajustada según tu proyecto.

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $empleados = new OpcionesFormulario();
    
    if ($empleados->eliminarEmpleado($id)) {
        header("Location: ../views/lista_usuario.php?mensaje=Usuario eliminado exitosamente");
    } else {
        header("Location: ../views/lista_usuario.php?mensaje=Error al eliminar el usuario");
    }
} else {
    header("Location: ../views/lista_usuario.php?mensaje=ID inválido");
}
exit;
?>
