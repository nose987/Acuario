<?php
include 'class/clases.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $pk_rol = $_POST['rol']; 

    $usuario = new ValidarUsuario(); 
    $registroExitoso = $usuario->registrar($nombre, $correo, $contrasena, $pk_rol);

    if ($registroExitoso) {
       
        header("Location: index.php");
        exit;
    } else {
        
        header("Location: loguin.php");
        exit;
    }
}
?>
