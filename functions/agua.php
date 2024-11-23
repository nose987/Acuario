<?php
include_once '../Class/clases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ph = $_POST['ph'];
    $amoniaco = $_POST['amoniaco'];
    $nitrato = $_POST['nitrato'];
    $nitritos = $_POST['nitritos'];
    $fk_tanque = $_POST['fk_tanque'];
    $fecha = $_POST['fecha'];

    $calidadAgua = new CalidadAgua();
    
    $registroExitoso = $calidadAgua->registrarCalidadAgua($ph, $amoniaco, $nitrato, $nitritos, $fk_tanque, $fecha);

    if ($registroExitoso === true) {
        header("Location: ../views/tabla_agua.php");
        exit;                               
    } else {
       
        echo $registroExitoso;   
    } 
}
?>
