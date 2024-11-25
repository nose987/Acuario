<?php
include '../Class/mantenimiento.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fk_equipo = $_POST['fk_equipo'];
    $tipo_mante = $_POST['tipo_mante'];
    $descripcion = $_POST['descripcion'];
    

    $mantenimiento = new Mantenimiento();
    
    $registroExitoso = $mantenimiento->insertar($fk_equipo,$tipo_mante,$descripcion);

    if ($registroExitoso > 0) {
        header("Location: ../views/tabla_mantenimiento.php");
        exit;                               
    } else {
       
        echo $registroExitoso;   
    } 
}
?>
