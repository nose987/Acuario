<?php
include '../Class/clases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $capacidad = $_POST['capacidad'];
    $temperatura = $_POST['temperatura'];
    $iluminacion = $_POST['iluminacion'];
    $filtracion = $_POST['filtracion'];
    $fk_area = $_POST['fk_area'];  
    $fk_especie = $_POST['fk_especie']; 
    $fecha = $_POST['fecha'];

    $usuario = new Tanque();
    
    $registroExitoso = $usuario->registrar_tanque($capacidad, $temperatura, $iluminacion, $filtracion, $fk_area, $fk_especie, $fecha, 1);

    if ($registroExitoso === true) {
        header("Location: ../views/tabla_tanques.php");
        exit;                               
    } else {
        // Muestra el error devuelto
        echo $registroExitoso;   
    }  
}

?>
