<?php
include '../Class/equipo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $fk_tanque = $_POST['fk_tanque'];
    $fecha = $_POST['fecha'];

    $equipo = new Equipo();
    
    $registroExitoso = $equipo->insertar($nombre, $estado, $fk_tanque, $fecha);

    if ($registroExitoso === true) {
        header("Location: ../views/panel.php");
        exit;                               
    } else {
       
        echo $registroExitoso;   
    }
}
?>
