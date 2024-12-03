<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

require_once '../functions/tanque.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanque = new Tanque();

    $datos = [
        'pk_tanque' => $_POST['pk_tanque'],
        'capacidad' => $_POST['capacidad'],
        'temperatura' => $_POST['temperatura'],
        'iluminacion' => $_POST['iluminacion'],
        'filtracion' => $_POST['filtracion'],
        'fk_area' => $_POST['fk_area'],
        'fk_especie' => $_POST['fk_especie'],
        'estatus' => $_POST['estatus']
    ];

    $resultado = $tanque->actualizar_tanque($datos);

    if ($resultado) {
        header("Location: ../views/tabla_tanques.php?mensaje=Tanque actualizado exitosamente");
    } else {
        header("Location: editar_tanque.php?id=" . $_POST['pk_tanque'] . "&error=No se pudo actualizar el tanque");
    }
    exit();
} else {
    // Si se intenta acceder directamente sin enviar POST
    header("Location: tabla_tanques.php");
    exit();
}