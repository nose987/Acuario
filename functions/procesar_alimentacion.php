<?php
include '../Class/clases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cantidad = $_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $hora = $_POST['hora'];
    $fecha = $_POST['fecha'];
    $fk_area = $_POST['fk_area']; 
    $fk_especie = $_POST['fk_especie']; 
    $fk_inventario = $_POST['fk_inventario'];

    $usuario = new Inventario();
    
    $registroExitoso = $usuario->registrar_alimentacion($cantidad, $descripcion, $hora, $fecha, $fk_area, $fk_especie, $fk_inventario);

    if ($registroExitoso === true) {
        header("Location: ../views/tabla_alimentacion.php");
        exit;                               
    } else {
        // Muestra el error devuelto
        echo $registroExitoso;   
    }  
}

?>