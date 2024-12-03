<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

require_once '../Class/clases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pk_equipo = isset($_POST['pk_equipo']) ? (int)$_POST['pk_equipo'] : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
    $fk_tanque = isset($_POST['fk_tanque']) ? (int)$_POST['fk_tanque'] : 0;

    // Validate input
    if ($pk_equipo > 0 && !empty($nombre) && !empty($estado) && $fk_tanque > 0) {
        $equipo = new OpcionesFormulario();
        $fecha = date('Y-m-d'); // Use current date

        if ($equipo->actualizar($pk_equipo, $nombre, $estado, $fk_tanque, $fecha)) {
            // Redirect with success message
            header('Location: ../views/tabla_equipo.php?mensaje=Equipo actualizado exitosamente');
            exit();
        } else {
            // Redirect with error message
            header('Location: ../views/editar_equipo.php?id=' . $pk_equipo . '&error=No se pudo actualizar el equipo');
            exit();
        }
    } else {
        // Redirect with validation error
        header('Location: ../views/tabla_equipo.php?error=Datos inválidos');
        exit();
    }
} else {
    // If not a POST request, redirect
    header('Location: ../views/tabla_equipo.php');
    exit();
}