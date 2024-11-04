<?php
include 'class/clases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $capacidad = $_POST['capacidad'];
    $temperatura = $_POST['temperatura'];
    $iluminacion = $_POST['iluminacion'];
    $filtracion = $_POST['filtracion'];
    $fk_area = $_POST['fk_area'];  
    $fk_especie = $_POST['fk_especie']; 
    $fecha = $_POST['fecha'];

    $usuario = new Tanque();
    
    $registroExitoso = $usuario->registrar_tanque($capacidad, $temperatura, $iluminacion, $filtracion, $fk_area, $fk_especie, $fecha);

    if ($registroExitoso === true) {
        header("Location: reg_tanque.html");
        exit;                               
    } else {
        // Muestra el error devuelto
        echo $registroExitoso;   
    }  
}

?>
