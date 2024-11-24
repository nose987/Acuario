<?php
include '../Class/equipo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $fk_tanque = $_POST['fk_tanque'];

    $equipo = new Equipo();
    
    $registroExitoso = $equipo->insertar($nombre, $estado, $fk_tanque);

    if ($registroExitoso === true) {
        header("Location: ../views/panel.php");
        exit;                               
    } else {
       
        echo $registroExitoso;   
    }
}
?>
